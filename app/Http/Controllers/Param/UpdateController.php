<?php

namespace App\Http\Controllers\Param;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Patch (
 *     path="/api/params/{param}",
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
    public function __invoke() {

    }
}
