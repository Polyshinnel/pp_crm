<?php

namespace App\Http\Controllers\Param;

use App\Http\Controllers\Controller;
use App\Models\Param;
use Illuminate\Http\Request;

/**
 * @OA\Get (
 *     path="/api/param/{param}",
 *     summary="Единичная запись",
 *     tags={"Params"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(description="Id параметра", in="path", name="param", required=true, example=1),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Получить параметр",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example=1),
 *              @OA\Property(property="name", type="string", example="Width"),
 *              @OA\Property(property="measure", type="string", example="mm"),
 *          )
 *     ),
 * ),
 */
class ShowController extends BaseController
{
    public function __invoke(Param $param) {
        $result = $param->toArray();
        return response()->json($result, 200);
    }
}
