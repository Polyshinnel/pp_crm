<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @OA\Delete (
 *     path="/api/products/{product}",
 *     summary="Удаление записи",
 *     tags={"Products"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(description="Id товара", in="path", name="product", required=true, example=1),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Товар удален",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="product was deleted"),
 *              @OA\Property(property="err", type="string", example="none"),
 *          )
 *     ),
 * ),
 */
class DestroyController extends BaseController
{
    public function __invoke(Product $product) {
        $result = $this->service->destroy($product);
        if($result['err'] != 'none') {
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }
}
