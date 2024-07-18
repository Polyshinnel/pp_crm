<?php

namespace App\Service\Product;

use App\Http\Requests\Product\StoreRequest;
use App\Models\Product;
use App\Models\ProductChar;
use App\Models\ProductImages;
use App\Models\ProductParam;
use App\Models\ProductSiteData;
use App\Models\ProductToCategory;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function store(array $data): array {
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
                    'barcode' => $data['barcode'],
                    'sale_price' => $data['sale_price'],
                ];
                $product = Product::create($productCreateArr);

                $structuredArr = $this->manageData($data, $product);

                foreach ($structuredArr['images'] as $image) {
                    ProductImages::create($image);
                }

                $product->categories()->attach($structuredArr['categories']);
                $product->chars()->attach($structuredArr['chars']);
                $product->params()->attach($structuredArr['params']);
                ProductSiteData::create($structuredArr['site_data']);
                DB::commit();

                return [
                    'message' => 'Product was created',
                    'err' => 'none'
                ];
            }

            return [
                'message' => 'Something went wrong',
                'err' => 'This product already exists'
            ];
        } catch (Exception $exception) {
            DB::rollBack();
            return [
                'message' => 'Something went wrong',
                'err' => $exception->getMessage()
            ];
        }
    }

    public function update(Product $product, array $data): array {
        try {
            DB::beginTransaction();
            $productUpdateArr = [
                'name' => $data['name'],
                'description' => $data['description'],
                'cover' => $data['cover'],
                'brand_id' => $data['brand_id'],
                'sku' => $data['sku'],
                'barcode' => $data['barcode'],
                'sale_price' => $data['sale_price'],
            ];
            $product->update($productUpdateArr);

            $structuredArr = $this->manageData($data, $product);

            //Обновляем картинки
            ProductImages::where(['product_id' => $product->id])->delete();
            foreach ($structuredArr['images'] as $image) {
                ProductImages::create($image);
            }

            $product->chars()->sync($structuredArr['chars']);
            $product->params()->sync($structuredArr['params']);
            $product->categories()->sync($structuredArr['categories']);

            ProductSiteData::where(['product_id' => $product->id])
                ->update(['title' => $data['title'], 'description_short' => $data['description_short']]);

            DB::commit();
            return [
                'message' => 'Product was updated',
                'err' => 'none'
            ];

        } catch (Exception $exception) {
            DB::rollBack();
            return [
                'message' => 'Something went wrong',
                'err' => $exception->getMessage()
            ];
        }
    }

    public function destroy(Product $product) {
        try{
            DB::beginTransaction();
            ProductSiteData::where(['product_id' => $product->id])->delete();
            ProductImages::where(['product_id' => $product->id])->delete();
            $product->chars()->detach();
            $product->params()->detach();
            $product->categories()->detach();
            $product->delete();
            DB::commit();
            return [
                'message' => 'Product was deleted',
                'err' => 'none'
            ];
        } catch (Exception $exception) {
            DB::rollBack();
            return [
                'message' => 'Something went wrong',
                'err' => $exception->getMessage()
            ];
        }
    }

    public function index(): array {
        $productArr = [];
        $products = Product::all();
        if($products) {
            foreach ($products as $product) {
                $productArr[] = $this->getProductInfo($product);
            }
        }
        return $productArr;
    }

    public function show(Product $product): array {
        return $this->getProductInfo($product);
    }

    private function getProductInfo(Product $product): array {
        $productArr = [];
        $productArr['id'] = $product->id;
        $productArr['name'] = $product->name;
        $productArr['description'] = $product->description;
        $productArr['cover'] = $product->cover;
        $productArr['brand_id'] = $product->brand_id;
        $productArr['sku'] = $product->sku;
        $productArr['barcode'] = $product->barcode;
        $productArr['sale_price'] = $product->sale_price;
        $productArr['actual_purchase_price'] = $product->actual_purchase_price;

        $chars = ProductChar::where(['product_id' => $product->id])->get();

        if($chars) {
            foreach ($chars as $char) {
                $productArr['chars'][] = [
                    'char_id' => $char->char_id,
                    'value' => $char->value
                ];
            }
        }


        $params = ProductParam::where(['product_id' => $product->id])->get();
        if($params) {
            foreach ($params as $param) {
                $productArr['params'][] = [
                    'param_id' => $param->param_id,
                    'value' => $param->value
                ];
            }
        }

        $images = ProductImages::where(['product_id' => $product->id])->get();
        if($images) {
            foreach ($images as $image) {
                $productArr['images'][] = [
                    'img' => $image->img,
                    'sort_order' => $image->sort_order
                ];
            }
        }

        $categories = ProductToCategory::where(['product_id' => $product->id])->get();
        if($categories) {
            foreach ($categories as $category) {
                $productArr['categories'][] = [
                    'category_id' => $category->category_id,
                ];
            }
        }

        $productSiteData = ProductSiteData::where(['product_id' => $product->id])->first();
        $productArr['title'] = $productSiteData['title'];
        $productArr['description_short'] = $productSiteData['description_short'];
        $productArr['brand_name'] = $product->brand->name;

        return $productArr;
    }

    private function manageData(array $data,Product $product): array {
        $productId = $product->id;
        $structuredData = [];
        foreach ($data['images'] as $image) {
            $imageArr = [
                'product_id' => $productId,
                'img' => $image['img'],
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
                'param_id' => $param['param_id'],
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
            'description_short' => $data['description_short']
        ];

        return $structuredData;
    }
}
