<?php

namespace App\Http\Controllers\Char;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Get (
 *     path="/api/chars",
 *     summary="Список характеристик",
 *     tags={"Chars"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Response(
 *          response=200,
 *          description="Получить список характеристик",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer", example=1),
 *                      @OA\Property(property="name", type="string", example="Color"),
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
