<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @OA\Get (
 *     path="/api/products/{product}",
 *     summary="Единичная запись",
 *     tags={"Products"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(description="Id товара", in="path", name="product", required=true, example=1),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Получить список товаров",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example=1),
 *              @OA\Property(property="name", type="string", example="Название товара"),
 *              @OA\Property(property="description", type="string", example="Описание товара"),
 *              @OA\Property(property="cover", type="string", example="/test.jpg"),
 *              @OA\Property(property="brand_id", type="integer", example=1),
 *              @OA\Property(property="sku", type="string", example="asd123"),
 *              @OA\Property(property="barcode", type="string", example="asd123"),
 *              @OA\Property(property="sale_price", type="string", example="100.00"),
 *              @OA\Property(property="actual_purchase_price", type="string", example="100.00"),
 *              @OA\Property(
 *                  property="images",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="img", type="string", example="test.jpg"),
 *                          @OA\Property(property="sort_order", type="integer", example=1),
 *                      )
 *                   ),
 *               @OA\Property(
 *                  property="categories",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="category_id", type="integer", example=1),
 *                  )
 *               ),
 *               @OA\Property(
 *                  property="chars",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="char_id", type="integer", example=1),
 *                      @OA\Property(property="value", type="string", example="value"),
 *                  )
 *               ),
 *               @OA\Property(
 *                  property="params",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="param_id", type="integer", example=1),
 *                      @OA\Property(property="value", type="string", example="value"),
 *                  )
 *               ),
 *               @OA\Property(property="title", type="string", example="PP | Тестовый товар"),
 *               @OA\Property(property="description_short", type="string", example="Купите лучший тестовый товар!"),
 *          )
 *     ),
 * )
 */


class ShowController extends BaseController
{
    public function __invoke(Product $product) {
        $result = $this->service->show($product);
        return response()->json($result, 200);
    }
}
