<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\StoreRequest;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *     path="/api/brands",
 *     summary="Создание бренда",
 *     tags={"Brands"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="name", type="string", example="Bramox"),
 *                      @OA\Property(property="img", type="string", example="test.jpg"),
 *                      @OA\Property(property="active", type="boolean", example=True),
 *                  )
 *              }
 *          )
 *     ),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Бренд добавлен",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Brand was created"),
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
        if(empty($data['img'])) {
            $data['img'] = '/common/default-brand.svg';
        }
        $result = $this->service->store($data);
        if($result['err'] != 'none') {
            return response()->json($result, 500);
        }

        return response()->json($result, 200);
    }
}
