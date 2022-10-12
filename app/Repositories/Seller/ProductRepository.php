<?php

namespace App\Repositories\Seller;

use App\Models\Attribute;
use App\Models\AttributeProduct;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\BundleProduct;
use App\Models\Category;
use App\Models\Combo;
use App\Models\Manufacturer;
use App\Models\PrioritySetting;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCombo;
use App\Models\ProductImage;
use App\Models\Translations\ProductTranslation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Symfony\Component\VarDumper\Cloner\Data;

//use Your Model

/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Product::class;
    }

    public function index(\Illuminate\Http\Request $request)
    {
        $user_id = Auth()->id();
        $products = Product::query()->where('seller_id',$user_id)->with([
        'seller' => fn($q)=> $q-> select("users.id","users.name"),
        "brand",
        "categories",
        "manufacturer"])->get();
        $brands = Brand::all();
        $manufacturers = Manufacturer::all();

        $categories = categories();
        return view('seller.products.index', compact('products','brands', 'manufacturers', 'categories'));
    }

    public function create_product()
    {
        $categories = categories();
        $brands = Brand::all();
        $manufacturers = Manufacturer::all();
        $combos=Combo::all();
        $pattributes = Attribute::with('childrensRow')->parents()->get();
        $branches=Branch::where('seller_id',Auth::id())->get();
        return view('seller.products.create', compact('categories', 'brands', 'manufacturers', 'pattributes','combos','branches'));
    }

    public function ExcelForm()
    {
        $categories = categories();
        $brands = Brand::all();
        $manufacturers = Manufacturer::all();
        $combos=Combo::all();
        $pattributes = Attribute::with('childrensRow')->parents()->get();
        $branches=Branch::where('seller_id',Auth::id())->get();
        return view('seller.products.importExcelForm', compact('categories', 'brands', 'manufacturers', 'pattributes','combos','branches'));
    }

    public function show($product)
    {
        $get_attributes_value = AttributeProduct::where('product_id',$product->id)->get();;

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
            'get_attributes_value'=> $get_attributes_value,
            'attributes' => $attributes,
            'combos' => $combos
        ];

        return view('seller.products.show')->with($data);
    }

    public function edit($product)
    {
        $categories = categories();

        $brands = Brand::all();
        $manufacturers = Manufacturer::all();
        $attributes = Attribute::all();
        $combos = Combo::all();

        $exist_branch_id=[];
        foreach ($product->branches as $branch) {
            array_push($exist_branch_id,$branch->id);
        }
        $branches=Branch::where('seller_id',Auth::id())->whereNotIn('id',$exist_branch_id)->get();
        $data = [
            'row' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'manufacturers' => $manufacturers,
            'attributes' => $attributes,
            'combos' => $combos,
            'branches'=>$branches
        ];

        return view('seller.products.edit')->with($data);
    }

    public function destroy($product)
    {
        $productTrans = ProductTranslation::where('product_id',  $product->id)->delete();
        $productTrans = ProductTranslation::where('product_id',  $product->id)->delete();
        $product_rel = ProductCategory::where('product_id',  $product->id)->delete();
        $product_attribute = AttributeProduct::where('product_id',  $product->id)->delete();
        $product->branches()->detach();
        ProductImage::where('product_id',$product->id)->delete();
        $product->delete();
        toastr()->success('Product Delete Successfully!');
        return back();
    }

    public function activation($id)
    {
        $product = Product::find($id);
        $product->is_active = $product->is_active ? 0 : 1;
        $product->save();
        return back();
    }

}
