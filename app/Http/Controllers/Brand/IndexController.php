<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Get (
 *     path="/api/brands",
 *     summary="Список брендов",
 *     tags={"Brands"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Response(
 *          response=200,
 *          description="Получить список брендов",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer", example=1),
 *                      @OA\Property(property="name", type="string", example="Deva"),
 *                      @OA\Property(property="img", type="string", example="test.png"),
 *                      @OA\Property(property="active", type="boolean", example=True),
 *                  )
 *              )
 *          )
 *     ),
 * ),
 */
class IndexController extends BaseController
{
    public function __invoke()
    {
        $brands = $this->service->index();

        return response()->json(['data' => $brands], 200);
    }
}
