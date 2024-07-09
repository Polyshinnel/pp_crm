<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *     path="/api/products",
 *     summary="Создание товара",
 *     tags={"Products"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="name", type="string", example="Название товара"),
 *                      @OA\Property(property="description", type="string", example="Описание товара"),
 *                      @OA\Property(property="cover", type="string", example="test.jpg"),
 *                      @OA\Property(property="brand_id", type="integer", example="1"),
 *                      @OA\Property(property="sku", type="string", example="123321"),
 *                      @OA\Property(property="barcode", type="string", example="123321"),
 *                      @OA\Property(property="sale_price", type="string", example="100.00"),
 *                      @OA\Property(property="title", type="string", example="PP | Тестовый товар"),
 *                      @OA\Property(property="description_short", type="string", example="Купите лучший тестовый товар!"),
 *                      @OA\Property(
 *                          property="images",
 *                          type="array",
 *                          @OA\Items(
 *                              @OA\Property(property="img", type="string", example="test.jpg"),
 *                              @OA\Property(property="sort_order", type="integer", example=1),
 *                          )
 *                      ),
 *                      @OA\Property(
 *                          property="categories",
 *                          type="array",
 *                          @OA\Items(
 *                              @OA\Property(property="category_id", type="integer", example=1),
 *                          )
 *                      ),
 *                      @OA\Property(
 *                          property="chars",
 *                          type="array",
 *                          @OA\Items(
 *                              @OA\Property(property="char_id", type="integer", example=1),
 *                              @OA\Property(property="value", type="string", example="value"),
 *                          )
 *                      ),
 *                      @OA\Property(
 *                          property="params",
 *                          type="array",
 *                          @OA\Items(
 *                              @OA\Property(property="param_id", type="integer", example=1),
 *                              @OA\Property(property="value", type="string", example="value"),
 *                          )
 *                      ),
 *                  )
 *              }
 *          )
 *     ),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Товар добавлен",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="product was created"),
 *              @OA\Property(property="err", type="string", example="none"),
 *          )
 *     ),
 * ),
 */

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request) {
        $data = $request->validated();
        $result = $this->service->store($data);
        if($result['err'] != 'none') {
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }
}
