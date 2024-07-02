<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

/**
 * @OA\Delete (
 *     path="/api/brands/{brand}",
 *     summary="Удаление записи",
 *     tags={"Brands"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(description="Id бренда", in="path", name="brand", required=true, example=1),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Бренд удален",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Brand was deleted"),
 *              @OA\Property(property="err", type="string", example="none"),
 *          )
 *     ),
 * ),
 */
class DestroyController extends BaseController
{
    public function __invoke(Brand $brand) {
        $result = $this->service->destroy($brand);
        if($result['err'] != 'none') {
            return response()->json($result, 500);
        }

        return response()->json($result, 200);
    }
}
