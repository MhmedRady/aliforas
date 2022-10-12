<?php

namespace App\Http\Controllers\Admin;

use App\Models\Translations\BranchTranslation;
use Toaster;
use Exception;
use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Combo;
use App\Models\Product;
use App\Models\Category;
use App\Models\Language;
use App\Models\Priority;
use App\Models\Attribute;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Manufacturer;
use App\Models\OrderProduct;
use App\Models\ProductCombo;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\BundleProduct;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\PrioritySetting;
use App\Models\ProductCategory;
use App\Models\AttributeProduct;
use App\Models\AttributeCategory;
use Illuminate\Support\Facades\DB;
use App\Models\PriceQuoteOrderItem;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;
use phpDocumentor\Reflection\Types\False_;
use App\Models\Translations\BrandTranslation;
use App\Models\Translations\ProductTranslation;
use App\Models\Translations\CategoryTranslation;
use App\Models\Translations\ManufacturerTranslation;

class ProductsController extends Controller
{
    private const ProductView = 'admin.content.products.';
    public function __construct()
    {
        /* $this->middleware('permission:view_product');
        $this->middleware('permission:create_product', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_product', ['only' => ['destroy']]); */

        $this->languages = Language::all();
        view()->share('languages', $this->languages);
    }

    /**
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */

            $DataTables = Product::query();
            return $this->ajaxProductTable($DataTables);

            //->addColumn('logo_thumb', '@isset($logo_thumb)<img src="{{$logo_thumb}}" style="width: 64px;" class="thumbnail" alt="">@endisset')->rawColumns(['logo_thumb'])
        }

        return view(self::ProductView.'index');
    }

    public function export()
    {
        return Excel::download(new ProductsExport(), 'products.xlsx');
    }

    public function importShow()
    {
        $categories = categories();
        $brands = Brand::all();
        $manufacturers = Manufacturer::all();

        return view(self::ProductView.'import', compact('categories', 'brands', 'manufacturers'));
    }

    public function findone($id)
    {
        return Product::find($id);
    }

    public function data($kind = '')
    {
        $isOrder = \request()->get('order');

        if ($isOrder) {
            $query = Product::query();
        } else {
            $query = Product::query()->orderBy('id', 'desc')->limit(10);
        }

        $query->select('products.*', 'product_translations.name');

        $query->leftJoin('product_translations', 'products.id', 'product_translations.product_id');
        $query->where('product_translations.locale', 'ar');
        $query->where('products.is_bundle', false);
        $query->where('products.is_combo', false);

        if ($kind != '' || $kind = \request()->get('kind')) {
            if ($kind == 'on_sale') {
                $query->where('on_sale', 1);
            }
            if ($kind == 'is_hot') {
                $query->where('is_hot', 1);
            }
            if ($kind == 'is_combo') {
                $combo_ids = ProductCombo::pluck('product_id')->toArray();

                $query->whereIn('products.id', $combo_ids);
            }
        }

        if (\request()->get('brand')) {
            $query->where('brand_id', \request()->get('brand'));
        }

        if (\request()->get('manufacturer')) {
            $query->where('manufacturer_id', \request()->get('manufacturer'));
        }

        if (\request()->get('category')) {
            $query
                ->join('product_categories', 'product_categories.product_id', 'products.id')
                ->where('category_id', \request()->get('category'));
        }

        return datatables()->of($query)
            ->editColumn('product_translations.name', function (Product $product) {
                return $product->name . '<br />' . ($product->categories[0]->name ?? '');
            })
            ->editColumn('brand_manufacturer', function (Product $product) {
                return ($product->brand->name ?? '') . '<br />' . ($product->manufacturer->name ?? '');
            })
            ->editColumn('is_active', function (Product $product) {
                return $product->is_active ? '<span class="label label-info">Active</span>' : '<span class="label label-danger">Inactive</span>';
            })
            ->editColumn('item_no', function (Product $product) {
                return $product->item_id;
            })
            ->addColumn('price', function (Product $product) {
                if ($product->on_sale == 1) {
                    return $product->before_price;
                } elseif ($product->is_hot == 1) {
                    return $product->price;
                } else {
                    return $product->price;
                }
            })
            ->addColumn('discount', function (Product $product) {
                if ($product->on_sale == 1 || $product->is_hot == 1) {
                    if ($product->on_sale == 1) {
                        return "Price After: " . $product->price;
                    }
                    if ($product->is_hot == 1) {
                        return "Price Before: " . $product->hot_price . " - " . "(Starts " . $product->hot_starts_at . " - " . "Ends " . $product->hot_ends_at . ")";
                    }
                } else {
                    return "No Discount";
                }
                return $product->on_sale == 1 ? '<span class="label label-info">Active</span>' : '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('hot_price', function (Product $product) {
                return $product->hot_price;
            })
            ->addColumn('before_price', function (Product $product) {
                return $product->before_price;
            })
            ->addColumn('stock', function (Product $product) {
                return $product->stock;
            })
            ->addColumn('options', function (Product $product) {
                $back = "";
                $back .= '<a href="' . route('admin.products.show', $product->id) . '" class="btn waves-effect waves-light btn-outline-warning" title="edit">Show</a>';
                $back .= '&nbsp;<a href="' . route('admin.products.attribute.index', $product->id) . '" class="btn waves-effect waves-light btn-outline-success" title="inactive">Attribute</a>&nbsp;';
                $back .= '&nbsp;<a href="' . route('admin.products.edit', $product->id) . '" class="btn waves-effect waves-light btn-outline-info" title="edit">Edit</a>&nbsp;';
                $back .= Form::open(['url' => route('admin.products.destroy', $product->id), 'class' => 'd-inline', 'onclick' => 'return confirm("Are you sure?")']);
                if ($product->on_sale == 1 || $product->is_hot == 1) {
                    $back .= '&nbsp;<a href="' . route('admin.products.enddeal', $product->id) . '" class="btn waves-effect waves-light btn-outline-info" title="End Deal">End Deal</a>&nbsp;';
                }
                if ($product->is_active == 0) {
                    $back .= '&nbsp;<a href="' . route('admin.products.active', $product->id) . '" class="btn waves-effect waves-light btn-outline-success" title="active">Activate</a>&nbsp;';
                } else {
                    $back .= '&nbsp;<a href="' . route('admin.products.active', $product->id) . '" class="btn waves-effect waves-light btn-outline-danger" title="inactive">InActivate</a>&nbsp;';
                }
                $back .= method_field('DELETE');
                $back .= Form::submit('Delete', ['class' => 'btn btn-outline-danger sa-warning']);
                $back .= Form::close();

                return $back;
            })
            ->rawColumns(['options', 'brand_manufacturer', 'product_translations.name', 'is_active'])
            ->make(true);
    }

    public function activation($id)
    {
        $product = Product::find($id);
        $product->is_active ? $product->is_active = 0 : $product->is_active = 1;
        $product->save();
        return back();
    }

    public function create(Request $request)
    {
        $categories = categories();

        $brands = Brand::all();
        $manufacturers = Manufacturer::all();
        $combos = Combo::all();
        $attributes = Attribute::whereNotNull('group_id')->get();
        $issale = $request->is_on_sale ?? null;
        $ishot = $request->is_hot ?? null;

        return view(self::ProductView.'create.create', compact('issale', 'ishot', 'categories', 'brands', 'manufacturers', 'attributes', 'combos'));
//        return view(self::ProductView.'_create', compact('issale', 'ishot', 'categories', 'brands', 'manufacturers', 'pattributes', 'combos'));
    }

    public function getProductAttributes(Request $request, Product $product)
    {
        $id = $request->input('id');
        $attributes = $product::with('attributes')->find($id)
            ->attributes
            ->pluck('name', 'id')
            ->unique();
        return view('admin.content.attributes.product_attributes')->with(compact('attributes'));
    }

    public function getProductAttributesAjax(Request $request, Product $product)
    {
        $ids = $request->input('ids');
        $attributesIds = AttributeCategory::where('category_id', $ids)->pluck('attribute_id')->toArray();
        //dd($attributesIds);
        $attributes = Attribute::whereNotNull('group_id')->get();

        //dd($attributes);
        return view('admin.content.attributes.product_attributes')->with(compact('attributes'));
    }

    public function getCurrentProductAttributesAjax(Request $request, Product $product)
    {
        $ids = $request->input('ids');
        $attributesIds = AttributeCategory::where('category_id', $ids)->pluck('attribute_id')->toArray();
        //dd($attributesIds);
        $attributes = Attribute::whereIn('id', $attributesIds)->get();

        //dd($attributes);
        return view('admin.content.attributes.current_product_attributes')->with(compact('attributes'));
    }

    public function getCategoryParents($id, $ids = [])
    {
        $category = Category::find($id);
        if ($category->parent_id) {
            $ids[] = $category->parent_id;
            return $this->getCategoryParents($category->parent_id, $ids);
        }
        return $ids;
    }


    public function getAttributeGroup($id, $ids = [])
    {
        $attr = Attribute::query()->find($id);
        if ($attr->group_id) {
            $ids[] = $attr->group_id;
            return $this->getAttributeGroup($attr->group_id, $ids);
        }
        return $ids;
    }

    public function setProductAttributes($request, $product)
    {
        if (isset($request->productAttributes)) {
            $productAttributes = [];
//                AttributeProduct::query()->where('product_id', $product->id)->delete();
            foreach ($request->productAttributes as $attr) {
                if (isset($attr['attribute_id'])) {
                    $attrType = Attribute::query()->find($attr['attribute_id']);
                    if ($attrType) {
                        $attrGroup = $this->getAttributeGroup($attr['attribute_id'], [(int)$attr['attribute_id']]);
                        foreach ($attrGroup as $attribute) {
//                            $newAttr = new AttributeProduct();
//                            $newAttr->attribute_id = $attribute;
//                            $newAttr->product_id = $product->id;
//                            $newAttr->quantity = $attr['quantity']??1;
//                            $newAttr->price = $attr['price']??1;
//                            $newAttr->save();
                            $newAttr = [
                                'attribute_id' => $attribute,
                                'product_id' => $product->id,
                                'quantity' => $attr['quantity']??1,
                                'price' => $attr['price']??1,
                            ];
                            array_push($productAttributes, $newAttr);
                        }
                    }
                }
            }
            $product->attributes()->sync($productAttributes);
//            return $productAttributes;
        }
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $data['is_point']        = $request->get('point') == "on" ? 1 : 0;
            $data['is_hot']          = $request->get('is_hot') == "on" ? 1 : 0;
            $data['on_sale']         = $request->get('on_sale') == "on" ? 1 : 0;
            $data['is_active']       =  $request->has('is_active') == "on" ? 1 : 0;
            $data['return_allowed']  = $request->get('return_allowed') == "on" ? 1 : 0;
            $data['sale_ends_at']    = $request->get('sale_ends_at') ? Carbon::createFromFormat('Y/m/d H:i:s', $request->get('sale_ends_at'))->toDateTimeString() : null;

            $givingDefaults = ['return_duration', 'stock', 'before_price', 'hot_price', 'price'];
            foreach ($givingDefaults as $default) {
                $data[$default] =  $request->get($default) ?? 0;
            }

            if ($data['on_sale']) {
                $data['price'] = $data['before_price'];
                $data['before_price'] = $request->get('price');
            }

            if ($request->is_hot) {
                $data['price'] = $request->hot_price;
                $data['hot_price'] = $request->get('price');
                if ($request->get('hot_starts_at')) {
                    $data['hot_starts_at'] = Carbon::createFromFormat('Y/m/d H:i', $request->get('hot_starts_at'))->toDateTimeString() ?? null;
                }
                if ($data['hot_ends_at']) {
                    $data['hot_ends_at'] = Carbon::createFromFormat('Y/m/d H:i', $request->get('hot_ends_at'))->toDateTimeString() ?? null;
                }
            }

            // dd('fd', $data);
            $filteredData = Arr::except($data, ['images', 'description', 'name']);
            $product = Product::create($filteredData);

            if ($request->combo_id) {
                foreach ($request->combo_id as $combo_id) {
                    ProductCombo::create([
                        'product_id' => $product->id,
                        'combo_id' => $combo_id,
                    ]);
                }
            }

            $gallery = [];
            if (\request()->hasFile('images')) {
                foreach (\request()->file('images') as $x => $image) {
                    if ($image->isValid()) {
                        $gallery[] = [
                            'image' => upload_product_file($image),
                            'thumb' => $request->input('thumbnail.' . $x),
                        ];
                    }
                }
            }

            $thumb = null;
            foreach ($gallery as $item) {
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $item['image'];
                $productImage->save();

                if (!$thumb || $item['thumb']) {
                    $thumb = $productImage->image;
                }
            }

            $product->thumbnail = $thumb;
            $product->save();

            $categoryParents = $this->getCategoryParents($request->get('category_id'), [(int)$request->get('category_id')]);

            ProductCategory::where('product_id', $product->id)->delete();

            foreach ($categoryParents as $cat) {
                ProductCategory::insert([
                    'product_id' => $product->id,
                    'category_id' => $cat,
                ]);
            }
//        $unique_id = uniqid($product->id);
            foreach ($this->languages as $local) {
                $productTrans = new ProductTranslation();
                $productTrans->product_id = $product->id;
                $productTrans->name = $request->input('name.' . $local->locale);
                $productTrans->slug = \Str::slug($request->input('name.' . $local->locale), '_')."_{$product->id}";
                $productTrans->description = $request->input('description.' . $local->locale);
                $productTrans->meta_title = $request->input('meta_title.' . $local->locale);
                $productTrans->meta_keywords = $request->input('meta_keywords.' . $local->locale);
                $productTrans->meta_description = $request->input('meta_description.' . $local->locale);
                $productTrans->locale = $local->locale;
                $productTrans->save();
            }

            $this->setProductAttributes($request, $product);

            DB::commit();
            $logPayload = ['msg' => 'Product Added', 'model_id' => $product->id, 'user_id' => auth()->id()];
            logToDatabase($logPayload);
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

        session()->flash('success');
        return redirect()->route('admin.products.index')->with(['success'=>'New product Created Successfully']);
    }

    /*********************/

    public function show(Product $product)
    {

        $get_attributes_value = AttributeProduct::where('product_id', $product->id)->get();
        $categories = categories();
        $brands = Brand::all();
        $manufacturers = Manufacturer::all();
        $attributes = Attribute::all();
        $combos = Combo::all();
        $data = [
            'row' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'manufacturers' => $manufacturers,
            'get_attributes_value' => $get_attributes_value,
            'attributes' => $attributes,
            'combos' => $combos
        ];

        return view(self::ProductView.'show')->with($data);
    }


    public function edit(Product $product)
    {
        $categories = categories();

        $brands = Brand::all();
        $manufacturers = Manufacturer::all();
        $attributes = Attribute::whereNotNull('group_id')->get();
        $combos = Combo::all();
//        return $product->attributesProduct()->first()->attribute;
        $data = [
            'row' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'manufacturers' => $manufacturers,
            'attributes' => $attributes,
            'combos' => $combos
        ];

        return view(self::ProductView.'edit.index')->with($data);
//        return view(self::ProductView.'edit')->with($data);
    }

    public function import()
    {
        Excel::import(new ProductsImport, request()->file('file'));
        return redirect('/big-boss/products');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name.*' => 'required',
            'description.*' => 'required',
            'images.*' => 'required|mimes:jpeg,PNG,JPG,JPEG,jpg,png|max:10000'
        ]);

        try {
            DB::beginTransaction();

            $product->is_active = $request->has('is_active') ? 1 : 0;
            $product->is_point = $request->get('point') == "on" ? 1 : 0;
            $product->brand_id = $request->get('brand_id');
            $product->manufacturer_id = $request->get('manufacturer_id');
            $product->show_for = $request->get('show_for');
            $product->return_allowed = $request->get('return_allowed') == "on" ? 1 : 0;
            $product->return_duration = $request->get('return_duration') ?? 0;
            $product->price = $request->get('price');
            $product->stock = $request->get('stock') ?? 0;
            $product->minimum_stock = $request->get('minimum_stock');
            $product->on_sale = $request->get('on_sale') == "on" ? 1 : 0;
            $product->is_hot = $request->get('is_hot') == "on" ? 1 : 0;
            $product->before_price = $request->get('before_price') ?? 0;
            $product->hot_price = $request->get('hot_price') ?? 0;
            $product->reward_points = $request->get('reward_points');

            if ($request->input('sale_ends_at')) {
                $product->sale_ends_at = Carbon::createFromFormat('Y/m/d H:i:s', $request->input('sale_ends_at'))->toDateTimeString();
            } else {
                $product->sale_ends_at = null;
            }

//        if ($product->on_sale) {
//            if (PrioritySetting::first()->enable == 1) {
//                $order_id = Priority::where('name', 'on_sale')->first()->order_id;
//                if (!priority($order_id, $product->id)) {
//                    $sub_product = Product::find($product->id);
//                    session()->flash('has_not_Priority', 'You canot add this offer "On Sale" has priority low with product "' . $sub_product->{'name:en'} . '"');
//                    return back();
//                }
//            }
//            $sub_product = Product::find($product->id);
//            $sub_product->is_hot = 0;
//            $sub_product->coupons()->sync([]);
//            $sub_product->promotions()->sync([]);
//            $sub_product->save();
//            BundleProduct::where('product_id', $product->id)->delete();
//            ProductCombo::where('product_id', $product->id)->delete();
//            $product->price = $product->before_price;
//            $product->before_price = $request->get('price');
//        }

//        if ($product->is_hot) {
//            // $product->price     = $product->hot_price;
//            // $product->hot_price = $request->get('price');
//            if (PrioritySetting::first()->enable == 1) {
//                $order_id = Priority::where('name', 'hot')->first()->order_id;
//                if (!priority($order_id, $product->id)) {
//                    $sub_product = Product::find($product->id);
//                    session()->flash('has_not_Priority', 'You canot add this offer "Hot" has priority low with product "' . $sub_product->{'name:en'} . '"');
//                    return back();
//
//
//                }
//            }
//
//            if ($request->get('hot_starts_at'))
//                $product->hot_starts_at = $request->get('hot_starts_at');
//            if ($request->get('hot_ends_at'))
//                $product->hot_ends_at = $request->get('hot_ends_at');
//
//            $sub_product = Product::find($product->id);
//            $sub_product->on_sale = 0;
//            $sub_product->coupons()->sync([]);
//            $sub_product->promotions()->sync([]);
//            $sub_product->save();
//            BundleProduct::where('product_id', $product->id)->delete();
//            ProductCombo::where('product_id', $product->id)->delete();
//        }

            $product->barcode = $request->get('barcode');
            $product->item_id = $request->get('item_id');
            $product->axapta_code = $request->get('axapta_code');
            $product->weight = $request->get('weight');
            $product->length = $request->get('length');
            $product->width = $request->get('width');
            $product->height = $request->get('height');
            $product->save();
            //dd($product->getComboIdsAttribute());
            if ($request->combo_id) {
                ProductCombo::where('product_id', $product->id)->delete();
                foreach ($request->combo_id as $combo_id) {
                    ProductCombo::create([
                        'product_id' => $product->id,
                        'combo_id' => $combo_id,
                    ]);
                }
            }

            $gallery = [];
            $gids = [];
            if ($request->has('images~')) {
                $gids = array_values($request->get('images~'));
            }

            if (\request()->hasFile('images')) {
                foreach (\request()->file('images') as $x => $image) {
                    if ($image->isValid()) {
                        $gallery[] = [
                            'image' => upload_product_file($image),
                            'thumb' => $request->input('thumbnail.' . $x),
                        ];
                    }
                }
            }

            ProductImage::where('product_id', $product->id)->whereNotIn('id', $gids)->delete();

            $thumb = null;
            foreach ($gallery as $item) {
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $item['image'];
                $productImage->save();

                if (!$thumb || $item['thumb']) {
                    $thumb = $productImage->image;
                }
            }

            $product->thumbnail = $thumb;
            $product->save();

            ProductCategory::where('product_id', $product->id)->delete();
            $categoryParents = $this->getCategoryParents($request->get('category_id'), [(int)$request->get('category_id')]);

            foreach ($categoryParents as $cat) {
                ProductCategory::insert([
                    'product_id' => $product->id,
                    'category_id' => $cat,
                ]);
            }

            foreach ($this->languages as $local) {
                $productTrans = ProductTranslation::where([
                    'product_id' => $product->id,
                    'locale' => $local->locale,
                ])->first();
                if (!$productTrans) {
                    $productTrans = new ProductTranslation();
                }
                $productTrans->product_id = $product->id;
                $productTrans->name = $request->input('name.' . $local->locale);
                $productTrans->slug = \Str::slug($request->input('name.' . $local->locale), '_') . "_{$product->id}";
                $productTrans->description = $request->input('description.' . $local->locale);
                $productTrans->meta_title = $request->input('meta_title.' . $local->locale);
                $productTrans->meta_keywords = $request->input('meta_keywords.' . $local->locale);
                $productTrans->meta_description = $request->input('meta_description.' . $local->locale);
                $productTrans->locale = $local->locale;
                $productTrans->save();
            }

            $this->setProductAttributes($request, $product);

//            $attributes = [];
//
//            if (isset($request->productAttributes))
//            {
//                foreach ($request->productAttributes as $attr)
//                {
//                    if (isset($attr['attribute_id']))
//                    {
//                        $attrType = Attribute::query()->find($attr['attribute_id']);
//                        if ($attrType)
//                        {
//                            array_push($attributes, [
//                                'attribute_id' => $attr['attribute_id'],
//                                'price' => $attr['price']??1,
//                                'quantity' => $attr['quantity']??1,
//                                'product_id' => $product->id,
//                            ]);
//                        }
//                    }
//                }
//            }
//
            ////            if (count($attributes))
            ////            {
//                $product->attributes()->sync($attributes);
//            }
            //dd($product->id);
            $logPayload = ['msg' => 'Product Added', 'model_id' => $product->id, 'user_id' => auth()->id()];
            logToDatabase($logPayload);
            # assign options to product

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.products.index')->with(['error'=>'Error While Updating Product Data Try again later !']);
        }
        session()->flash('success');
        return redirect()->route('admin.products.index')->with(['success'=>'Product Data Updated Successfully']);
    }

    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();
            if (OrderProduct::query()->where('product_id', $product->id)->count() > 0 || PriceQuoteOrderItem::query()->where('product_id', $product->id)->count() > 0) {
                return response()->json(['error' => 'can\'t delete this product is used in order!'], 401);
            }
            ProductTranslation::where('product_id', $product->id)->delete();
            ProductCategory::where('product_id', $product->id)->delete();
            AttributeProduct::where('product_id', $product->id)->delete();
            ProductImage::query()->where('product_id', $product->id)->delete();
            ProductCombo::query()->where('product_id', $product->id)->delete();
            //$product->branches()->detach();
            $product->delete();
            DB::commit();
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function enddeal(Product $product, $id)
    {
        $product = Product::find($id);
        $product->on_sale = 0;
        $product->is_hot = 0;
        $product->price = $product->before_price;
        $product->before_price = 0;
        $product->save();
        session()->flash('success');
        return back();
    }

    /*
        On Sale - Hot - Compo
    */
    // On Sale
    public function onSale(Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */

            $DataTables = Product::query()->where('on_sale', 1);
            return $this->ajaxProductTable($DataTables);

            //->addColumn('logo_thumb', '@isset($logo_thumb)<img src="{{$logo_thumb}}" style="width: 64px;" class="thumbnail" alt="">@endisset')->rawColumns(['logo_thumb'])
        }
        return view(self::ProductView.'onsale');
//        $user_id = Auth()->id();
//        $products = Product::query()->where('on_sale', 1)->with('seller')->get();
//        $brands = Brand::all();
//        $manufacturers = Manufacturer::all();
//        $categories = categories();
//
//        return view(self::ProductView.'onsale', compact('products', 'brands', 'manufacturers', 'categories'));
    }

    public function onHot(Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            /** @var EloquentDataTable $DataTables */

            $DataTables = Product::query()->where('is_hot', 1);
            return $this->ajaxProductTable($DataTables);

            //->addColumn('logo_thumb', '@isset($logo_thumb)<img src="{{$logo_thumb}}" style="width: 64px;" class="thumbnail" alt="">@endisset')->rawColumns(['logo_thumb'])
        }

        return view(self::ProductView.'hot');

//        $user_id = Auth()->id();
//        $products = Product::query()->where('is_hot', 1)->with('seller')->get();
//
//        $brands = Brand::all();
//        $manufacturers = Manufacturer::all();
//        $categories = categories();
//
//        return view(self::ProductView.'hot', compact('products', 'brands', 'manufacturers', 'categories'));
    }

    // Combo Products
    public function comboProducts()
    {
        $brands = Brand::all();
        $manufacturers = Manufacturer::all();

        $categories = categories();

        return view(self::ProductView.'combo', compact('brands', 'manufacturers', 'categories'));
    }

    public function attribute_index(Product $product)
    {
//        return $product->attributes;
        return view('admin/products/attributes', [
            'attributes' => Attribute::whereNotNull('group_id')->get(),
            'product' => $product
        ]);
        return $product;
    }

    public function attribute_store(Product $product, Request $request)
    {
        $file = $request->file('file');
        if ($file) {
            $filename = 'pai_' . str_random(5) . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/products/');
            $file->move($destinationPath, $filename);
            $attribute_images[] = $filename;
            $product_attribute_image = json_encode($attribute_images);
        }

        if (isset($product_attribute_image)) {
            $attributesValues[] = ['quantity' => $request->qte, 'price' => $request->price, 'code' => $request->code, 'picture' => $product_attribute_image, 'attribute_id' => $request->attribute_id];
        } else {
            $attributesValues[] = ['quantity' => $request->qte, 'price' => $request->price, 'code' => $request->code, 'attribute_id' => $request->attribute_id];
        }

        //dd($attributesValues);
        $product->attributes()->attach($attributesValues);
        // toastr()->success('attribute created');
        session()->flash('success');
        return back();
    }

    public function attribute_delete(Product $product, Attribute $attribute)
    {
        $product->attributes()->detach($attribute);
        // toastr()->success('attribute created');
        session()->flash('success');
        return back();
    }

    public function attribute_update(Product $product, Attribute $attribute, Request $request)
    {
        $file = $request->file('file');
        if ($file) {
            $filename = 'pai_' . str_random(5) . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/products/');
            $file->move($destinationPath, $filename);
            $attribute_images[] = $filename;
            $product_attribute_image = json_encode($attribute_images);
        }

        if (isset($product_attribute_image)) {
            $attributesValues[] = ['quantity' => $request->qte, 'price' => $request->price, 'code' => $request->code, 'picture' => $product_attribute_image];
        } else {
            $attributesValues[] = ['quantity' => $request->qte, 'price' => $request->price, 'code' => $request->code];
        }

        //dd($attributesValues);
        $product->attributes()->updateExistingPivot($attribute->id, $attributesValues[0]);
//        $product->attributes()->attach($attributesValues);
        // toastr()->success('attribute updated');
        session()->flash('success');
        return back();
    }

    private function ajaxProductTable($ProductDataTable)
    {

//        $DataTables = DataTables::of($ProductDataTable->with([
//            'seller', 'categories', 'brand', 'manufacturer'
//        ])->orderByDesc('id'));

        $DataTables = DataTables::of($ProductDataTable->with([
                'seller', 'categories', 'brand', 'manufacturer','images'
            ])->orderByDesc('id'));

        return created_at_filter($DataTables)
            ->filterColumn('name', function ($q, $word) {
                return $q->whereHas('translations', function ($q) use ($word) {
                    $q->where('name', 'like', [(config('datatables.search.smart') === true?'%':'') . "$word%"]);
                });
            })
            ->filterColumn('image', function ($q, $word) {
                return $q->whereHas('translations', function ($q) use ($word) {
                    $q->where('name', 'like', [(config('datatables.search.smart') === true?'%':'') . "$word%"]);
                });
            })
            ->filterColumn('brand_title', function ($q, $word) {
                $word = strtolower($word);
                $availableTrans = BrandTranslation::where('name', 'like', "%$word%")->pluck('brand_id')->toArray();
                $q->whereHas('brand', fn ($query) => $query->whereIn('brand_id', $availableTrans));
            })
            ->filterColumn('branch_title', function ($q, $word) {
                $word = strtolower($word);
                $availableTrans = BranchTranslation::where('name', 'like', "%$word%")->pluck('branch_id')->toArray();
                $q->whereHas('branch', fn ($query) => $query->whereIn('branch_id', $availableTrans));
            })
            ->filterColumn('category_title', function ($q, $word) {
                $word = strtolower($word);
                $availableTrans = CategoryTranslation::where('name', 'like', "%$word%")->pluck('category_id')->toArray();
                $q->whereHas('categories', fn ($query) => $query->whereIn('category_id', $availableTrans));
            })
            ->filterColumn('manufacturer_title', function ($q, $word) {
                $word = strtolower($word);
                $availableTrans = ManufacturerTranslation::where('name', 'like', "%$word%")->pluck('manufacturer_id')->toArray();
                $q->whereHas('manufacturer', fn ($query) => $query->whereIn('manufacturer_id', $availableTrans));
            })
            ->filterColumn('status', function ($q, $word) {
                $status = null;
                if (Str::startsWith('a', $word) || Str::startsWith('ac', $word) || Str::startsWith('act', $word) || Str::startsWith('acti', $word) || Str::startsWith('activ', $word) || Str::startsWith('active', $word)) {
                    $status = 1;
                }
                if (Str::startsWith('i', $word) || Str::startsWith('in', $word) || Str::startsWith('ina', $word) || Str::startsWith('inac', $word) || Str::startsWith('inact', $word) || Str::startsWith('inacti', $word) || Str::startsWith('inactiv', $word) || Str::startsWith('inactive', $word)) {
                    $status = 0;
                }
                $q->where('is_active', $status);
            })
            ->editColumn('created_at', function (Product $product) {
                return optional($product->created_at)->toDayDateTimeString();
            })->addColumn('update_url', function (Product $product) {
                return route('admin.products.edit', $product);
            })
            ->addColumn('delete_url', function (Product $product) {
                return route('admin.products.destroy', $product);
            })
            ->addColumn('image', function (Product $product) {
                return (isset($product->image) ?
                    '<img src="'.($product->image->image_url(250, 250)).'"
                    style="width: 64px;" class="thumbnail">':'');
            })
            ->addColumn('actions', function (Product $product) {
                return [
                    [
                        'url' => route('admin.products.active', $product),
                        'icon' => $product->is_active ? 'x-circle' : 'check-circle',
                    ],
                    ['url' => route('admin.products.show', $product), 'icon' => 'eye'],
                ];
            })
            ->addColumn('category_title', function (Product $product) {
                return optional($product->categories->first())->name;
            })
            ->addColumn('brand_title', function (Product $product) {
                return optional($product->brand)->name;
            })
            ->addColumn('branch_title', function (Product $product) {
                return optional($product->branch->first())->name?? '-';
            })
            ->editColumn('manufacturer_title', function (Product $product) {
                return optional($product->manufacturer)->name;
            })
            ->editColumn('status', function (Product $product) {
                return $product->is_active ?
                    '<label class="badge rounded-pill bg-success">Active</label>' :
                    '<label class="badge rounded-pill bg-danger">InActive</label>';
            })->only([
                'id', 'name','image', 'category_title', 'brand_title', 'manufacturer_title', 'branch_title', 'status',
                'actions', 'created_at', 'update_url', 'delete_url',
            ])->rawColumns(['status','image'])->make(true);
    }

    public function attributeBeforeDelete($id)
    {
        $att = AttributeProduct::query()->find($id);
        if ($att) {
            $attrOrder = OrderProduct::query()->where('attribute_id', $id)->count();
            if ($attrOrder) {
                return response()->json(['test'=>false,'msg'=>"Sorry We Can't Delete This Product Attribute Because it Used With {$attrOrder} Order!"]);
            } else {
                return response()->json(['test'=>true]);
            }
        }
    }
}
