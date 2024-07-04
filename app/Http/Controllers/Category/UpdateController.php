<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

/**
 * @OA\Patch (
 *     path="/api/categories/{category}",
 *     summary="Обновление записи",
 *     tags={"Categories"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(description="Id категори", in="path", name="category", required=true, example=1),
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
 *          description="Категория обновлена",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="category was updated"),
 *              @OA\Property(property="err", type="string", example="none"),
 *          )
 *     ),
 * ),
 */
class UpdateController extends BaseController
{
    public function __invoke(Category $category, UpdateRequest $request) {
        $data = $request->validated();
        $result = $this->service->update($category, $data);
        if($result['err'] != 'none') {
            return response()->json($result, 500);
        }

        return response()->json($result, 200);
    }
}
