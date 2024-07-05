<?php

namespace App\Http\Controllers\Param;

use App\Http\Controllers\Controller;
use App\Http\Requests\Param\UpdateRequest;
use App\Models\Param;
use Illuminate\Http\Request;

/**
 * @OA\Patch (
 *     path="/api/param/{param}",
 *     summary="Обновление параметра",
 *     tags={"Params"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(description="Id характеристики", in="path", name="param", required=true, example=1),
 *
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="name", type="string", example="Width"),
 *                      @OA\Property(property="measure", type="string", example="mm"),
 *                  )
 *              }
 *          )
 *     ),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Параметр обновлен",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Param was updated"),
 *              @OA\Property(property="err", type="string", example="none"),
 *          )
 *     ),
 * ),
 */
class UpdateController extends BaseController
{
    public function __invoke(Param $param, UpdateRequest $request) {
        $data = $request->validated();
        $result = $this->service->update($param, $data);
        if($result['err'] != 'none') {
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }
}
