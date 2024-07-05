<?php

namespace App\Http\Controllers\Char;

use App\Http\Controllers\Controller;
use App\Http\Requests\Char\StoreRequest;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *     path="/api/chars",
 *     summary="Создание характеристики",
 *     tags={"Chars"},
 *     security={{ "bearerAuth": {} }},
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
 *          description="Характеристика создана",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Char was created"),
 *              @OA\Property(property="err", type="string", example="none"),
 *          )
 *     ),
 * ),
 */
class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->service->store($data);
        if($result['err'] != 'none') {
            return response()->json($result, 500);
        }

        return response()->json($result, 200);
    }
}
