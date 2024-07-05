<?php

namespace App\Http\Controllers\Param;

use App\Http\Controllers\Controller;
use App\Http\Requests\Param\StoreRequest;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *     path="/api/param",
 *     summary="Создание параметра",
 *     tags={"Params"},
 *     security={{ "bearerAuth": {} }},
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
 *          description="Параметр создан",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Param was created"),
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
