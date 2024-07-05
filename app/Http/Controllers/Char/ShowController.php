<?php

namespace App\Http\Controllers\Char;

use App\Http\Controllers\Controller;
use App\Models\Char;
use Illuminate\Http\Request;

/**
 * @OA\Get (
 *     path="/api/chars/{char}",
 *     summary="Единичная запись",
 *     tags={"Chars"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(description="Id характеристики", in="path", name="char", required=true, example=1),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Получить характеристику",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example=1),
 *              @OA\Property(property="name", type="string", example="Color"),
 *          )
 *     ),
 * ),
 */
class ShowController extends BaseController
{
    public function __invoke(Char $char) {
        $result = $char->toArray();
        return response()->json($result, 200);
    }
}
