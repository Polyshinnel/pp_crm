<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

/**
 * @OA\Get (
 *     path="/api/brands/{brand}",
 *     summary="Единичная запись",
 *     tags={"Brands"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(description="Id бренда", in="path", name="brand", required=true, example=1),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Получить бренд",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example=1),
 *              @OA\Property(property="name", type="string", example="Deva"),
 *              @OA\Property(property="img", type="string", example="test.jpg"),
 *              @OA\Property(property="active", type="boolean", example=True),
 *          )
 *     ),
 * ),
 */
class ShowController extends Controller
{
    public function __invoke(Brand $brand) {
        $result = $brand->toArray();
        return response()->json($result, 200);
    }
}
