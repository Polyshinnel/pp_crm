<?php

namespace App\Http\Controllers\Char;

use App\Http\Controllers\Controller;
use App\Http\Requests\Char\UpdateRequest;
use App\Models\Char;
use Illuminate\Http\Request;

/**
 * @OA\Patch (
 *     path="/api/chars/{char}",
 *     summary="Обновление характеристики",
 *     tags={"Chars"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(description="Id характеристики", in="path", name="char", required=true, example=1),
 *
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="name", type="string", example="Color"),
 *                  )
 *              }
 *          )
 *     ),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Характеристика обновлена",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Char was updated"),
 *              @OA\Property(property="err", type="string", example="none"),
 *          )
 *     ),
 * ),
 */

class UpdateController extends BaseController
{
    public function __invoke(Char $char, UpdateRequest $request) {
        $data = $request->validated();
        $result = $this->service->update($char, $data);
        if($result['err'] != 'none') {
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }
}
