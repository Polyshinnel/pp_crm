<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\UpdateRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

/**
 * @OA\Patch (
 *     path="/api/brands/{brand}",
 *     summary="Обновление бренда",
 *     tags={"Brands"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(description="Id бренда", in="path", name="brand", required=true, example=1),
 *
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="name", type="string", example="Deva"),
 *                      @OA\Property(property="img", type="string", example="test.jpg"),
 *                      @OA\Property(property="active", type="boolean", example=True),
 *                  )
 *              }
 *          )
 *     ),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Бренд обновлен",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="brand was updated"),
 *              @OA\Property(property="err", type="string", example="none"),
 *          )
 *     ),
 * ),
 */
class UpdateController extends BaseController
{
    public function __invoke(Brand $brand, UpdateRequest $request) {
        $data = $request->validated();
        $result = $this->service->update($brand, $data);
        if($result['err'] != 'none') {
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }
}
