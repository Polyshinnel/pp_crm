<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *     path="/api/categories",
 *     summary="Создание категории",
 *     tags={"Categories"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="name", type="string", example="Название категории"),
 *                      @OA\Property(property="description", type="string", example="Описание категории"),
 *                      @OA\Property(property="parent_id", type="integer", example=0),
 *                      @OA\Property(property="status", type="boolean", example=True),
 *                  )
 *              }
 *          )
 *     ),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Категория добавлена",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="category was created"),
 *              @OA\Property(property="err", type="string", example="none"),
 *          )
 *     ),
 * ),
 */
class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request) {
        $data = $request->validated();
        $result = $this->service->store($data);
        if($result['err'] != 'none') {
            return response()->json($result, 500);
        }

        return response()->json($result, 200);
    }
}
