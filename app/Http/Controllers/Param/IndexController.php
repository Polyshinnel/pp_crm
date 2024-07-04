<?php

namespace App\Http\Controllers\Param;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Get (
 *     path="/api/params",
 *     summary="Список параметров",
 *     tags={"Params"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Response(
 *          response=200,
 *          description="Получить список параметров",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer", example=1),
 *                      @OA\Property(property="name", type="string", example="Length"),
 *                      @OA\Property(property="measure", type="string", example="mm"),
 *                  )
 *              )
 *          )
 *     ),
 * ),
 */
class IndexController extends BaseController
{
    public function __invoke() {

    }
}

