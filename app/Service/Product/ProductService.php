<?php

namespace App\Service\Product;

use App\Http\Requests\Product\StoreRequest;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductSiteData;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function store(StoreRequest $data): array {
        try {
            $searchProduct = Product::where(['sku' => $data['sku'], 'name' => $data['name']])->first();

            if(!$searchProduct) {
                DB::beginTransaction();
                $productCreateArr = [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'cover' => $data['cover'],
                    'brand_id' => $data['brand_id'],
                    'sku' => $data['sku'],
                    'sale_price' => $data['sale_price'],
                ];
                $product = Product::create($productCreateArr);

                $structuredArr = $this->manageData($data, $product);

                foreach ($structuredArr['images'] as $image) {
                    ProductImages::create($image);
                }

                $product->category()->attach($structuredArr['categories']);
                $product->chars()->attach($structuredArr['chars']);
                $product->params()->params($structuredArr['params']);
                ProductSiteData::create($structuredArr['site_data']);
                DB::commit();

                return [
                    'message' => 'Product was created',
                    'err' => 'none'
                ];
            }

            return [
                'message' => 'Something went wrong',
                'err' => 'This brand already exists'
            ];
        } catch (Exception $exception) {
            DB::rollBack();
            return [
                'message' => 'Something went wrong',
                'err' => $exception->getMessage()
            ];
        }
    }

    private function manageData(StoreRequest $data,Product $product): array {
        $productId = $product->id;
        $structuredData = [];
        foreach ($data['images'] as $image) {
            $imageArr = [
                'product_id' => $productId,
                'img' => $image['path'],
                'sort_order' => $image['sort_order']
            ];
            $structuredData['images'][] = $imageArr;
        }

        foreach ($data['chars'] as $char) {
            $charArr = [
                'product_id' => $productId,
                'char_id' => $char['char_id'],
                'value' => $char['value']
            ];

            $structuredData['chars'][] = $charArr;
        }

        foreach ($data['params'] as $param) {
            $paramArr = [
                'product_id' => $productId,
                '$param' => $param['$param'],
                'value' => $param['value']
            ];

            $structuredData['params'][] = $paramArr;
        }

        foreach ($data['categories'] as $category) {
            $categoryArr = [
                'product_id' => $productId,
                'category_id' => $category['category_id']
            ];

            $structuredData['categories'][] = $categoryArr;
        }

        $structuredData['site_data'] = [
            'product_id' => $productId,
            'title' => $data['title'],
            'description' => $data['description_short']
        ];

        return $structuredData;
    }
}
