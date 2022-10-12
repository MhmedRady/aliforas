<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductBranch;
use App\Models\ProductImage;
use App\Models\Translations\ProductTranslation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\ProductCategory;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class ProductsImportSheet implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    use RemembersRowNumber, SkipsFailures;
    use Importable;
    private $rows = 0;

    public $category_id;
    public $branch_id;
    public $brand_id;
    public $manufacturer_id;

    public function __construct($category_id, $brand_id, $manufacturer_id, $branch_id)
    {
        $this->category_id = $category_id;
        $this->branch_id = $branch_id;
        $this->brand_id = $brand_id;
        $this->manufacturer_id = $manufacturer_id;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {

        if (count($row) == 0) return NULL;
        if (!isset($row['arabic_name']) || !$row['arabic_name']) return NULL;
        if (!isset($row['english_name']) || !$row['english_name']) return NULL;


        $rules_validation = [];
        $product_trans_en = null;
        $product_trans_ar = ProductTranslation::whereName($row['arabic_name'])
            ->whereLocale('ar')
            ->first();
        $product = new Product();


        $product_trans_en = ProductTranslation::whereName($row['english_name'])
            ->whereLocale('en')
            ->first();

        if ($product_trans_ar) {
            $product = $product_trans_ar->product;
        }

        if ($product_trans_en) {
            $product = $product_trans_en->product;
        }

        if (!$product) {
            $product = new Product();
        }

        //dd($row[17].','.$row[19].','.$row[21]);
        /* $category_id            = Category::where('code',$this->category_id)->first()->id;
        $brand_id               = Brand::where('code',$this->brand_id)->first()->id; */
        //dd('hg');

        $category_id = $this->category_id;
        $branch_id = $this->branch_id;
        $manufacturer_id = $this->manufacturer_id;
        $brand_id = $this->brand_id;

        try {
            $product->item_id = $row['item_id'];
            $product->barcode = $row['barcode'];
        } catch (\Exception $exception) {
            # dd($product);
        }

        $product->brand_id = $brand_id;
        $product->manufacturer_id = $manufacturer_id;

//        try {

            $product->minimum_stock = isset($row['minimum_stock']) && $row['minimum_stock'] > 0 ? $row['minimum_stock'] : 1;
            $product->stock = isset($row['stock']) && $row['stock'] > 0 ? $row['stock'] : 1;
            $product->price = isset($row['price']) && $row['price'] > 0 ? $row['price'] : 1;

            $product->is_active = isset($row['is_active']) && $row['is_active'] !== 0 ? 1 : 0;
            $product->seller_id = auth()->id();
            $product->is_point = isset($row['is_point']) && $row['is_point'] > 0 ? $row['is_point'] : 0;
            $product->save();

            $product_category = new ProductCategory;
            $product_category->product_id = $product->id;
            $product_category->category_id = $category_id;
            $product_category->save();

            $product_branch = new ProductBranch;

            $product_branch->branch_id = $branch_id;
            $product_branch->product_id = $product->id;
            $product_branch->quantity = isset($row['stock']) && $row['stock'] > 0 ? $row['stock'] : 1;
            $product_branch->save();

//        } catch (\Exception $e) {
//            return "product error";
//        }
//
        if (!$product_trans_ar) {
            $product_trans_ar = new ProductTranslation();
        }
//
        $product_trans_ar->locale = 'ar';
        $product_trans_ar->product_id = $product->id;
        $product_trans_ar->name = $row['arabic_name'];
        $product_trans_ar->slug = isset($row['arabic_name']) ? $this->_getSlug($row['arabic_name']) : '';
        $product_trans_ar->description = $row['arabic_description'] ? $row['arabic_description'] : '';
//
        try {
            $product_trans_ar->save();
        } catch (\Exception $exception) {
            dd($exception);
        }

        if (!$product_trans_en) {
            $product_trans_en = new ProductTranslation();
        }

        $product_trans_en->locale = 'en';
        $product_trans_en->product_id = $product->id;
        $product_trans_en->name = $row['english_name'];
        $product_trans_en->slug = isset($row['english_name']) ? $this->_getSlug($row['english_name']) : '';
        $product_trans_en->description = $row['english_description'] ? $row['english_description'] : '';

        try {
            $product_trans_en->save();
        } catch (\Exception $exception) {
            # dd($row);
        }

        if ($row['images'] != '') {
            $images = explode(',', $row['images']);
            if (is_array($images)) {
                foreach ($images as $image) {

                    if (strpos($image, 'http') !== false || strpos($image, 'https') !== false) {
                        $image = $image;
                    }

                    $product_image = new ProductImage;
                    $product_image->product_id = $product->id;
                    $product_image->image = $image;
                    $product_image->save();
                }
            } else {
                $product_image = new ProductImage;
                $product_image->product_id = $product->id;
                $product_image->image = $row['images'];
                $product_image->save();
            }
        }

        if (count($rules_validation)) {
            session()->flash('rules_validation', $rules_validation);
            return NULL;
        }

    }

    public function _getSlug($name)
    {
        return trim(str_replace(" ", "-", $name));
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            'arabic_name' => 'required|string',
            '*.arabic_name' => 'required|string',

            'arabic_description' => 'required|string',
            '*.arabic_description' => 'required|string',

            'english_name' => 'required|string',
            '*.english_name' => 'required|string',

            'english_description' => 'required|string',
            '*.english_description' => 'required|string',

            'price' => 'required|numeric|min:1',
            '*.price' => 'required|numeric|min:1',

            'stock' => 'required|numeric|min:1',
            '*.stock' => 'required|numeric|min:1',

            'minimum_stock' => 'nullable|numeric|min:1',
            '*.minimum_stock' => 'nullable|numeric|min:1',

            'barcode' => 'nullable|numeric',
            '*.barcode' => 'nullable|numeric',

            'is_point' => 'nullable|numeric',
            '*.is_point' => 'nullable|numeric',

            'item_id' => 'nullable|numeric',
            '*.item_id' => 'nullable|numeric',

            'is_active' => 'required|in:1,0',
            '*.is_active' => 'required|in:1,0',
        ];
    }
//
//    public function headings() : array
//    {
//        return ['arabic_name', 'english_name'];
//    }

}
