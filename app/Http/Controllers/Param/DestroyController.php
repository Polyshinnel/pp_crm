<?php

namespace App\Http\Controllers\Param;

use App\Http\Controllers\Controller;
use App\Models\Param;
use Illuminate\Http\Request;

/**
 * @OA\Delete (
 *     path="/api/param/{param}",
 *     summary="Удаление записи",
 *     tags={"Params"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(description="Id параметра", in="path", name="param", required=true, example=1),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Параметр удален",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Param was deleted"),
 *              @OA\Property(property="err", type="string", example="none"),
 *          )
 *     ),
 * ),
 */
class DestroyController extends BaseController
{
    public function __invoke(Param $param) {
        $result = $this->service->destroy($param);
        if($result['err'] != 'none') {
            return response()->json($result, 500);
        }

        return response()->json($result, 200);
    }
}
