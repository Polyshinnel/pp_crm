<?php

namespace App\Http\Controllers\Char;

use App\Http\Controllers\Controller;
use App\Models\Char;
use Illuminate\Http\Request;

/**
 * @OA\Delete (
 *     path="/api/chars/{char}",
 *     summary="Удаление записи",
 *     tags={"Chars"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(description="Id характеристики", in="path", name="char", required=true, example=1),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Характеристика удалена",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Char was deleted"),
 *              @OA\Property(property="err", type="string", example="none"),
 *          )
 *     ),
 * ),
 */
class DestroyController extends BaseController
{
    public function __invoke(Char $char) {
        $result = $this->service->destroy($char);
        if($result['err'] != 'none') {
            return response()->json($result, 500);
        }

        return response()->json($result, 200);
    }
}
