<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $_products = Product::get();

        $products = [];
        foreach ($_products as $product) {

            $products[] = [
                /* $product->id, */

                $product->translate('ar')? $product->translate('ar')->name: '',
                $product->translate('en')? $product->translate('en')->name: '',

                $product->translate('ar')? $product->translate('ar')->description: '',
                $product->translate('en')? $product->translate('en')->description: '',

                $product->price,

                $product->categories && isset($product->categories[0]) ? $product->categories[0]->translate('ar')->name ?? '' : '',
                $product->categories && isset($product->categories[0]) ? $product->categories[0]->translate('en')->name ?? '' : '',

                $product->brand ? $product->brand->translate('ar')->name : '',
                $product->brand ? $product->brand->translate('en')->name : '',

                $product->barcode,

                $product->is_active ? 1 : 0,

            ];
        }
        return collect($products);
    }

    public function headings(): array
    {
        return [
            /* '# ID', */
            'Name',
            'Name En',

            'Description ar',
            'Description en',

            'price',

            'category ar',
            'category en',

            'brand ar',
            'brand en',

            'barcode',

            'is active',

        ];
    }
}
