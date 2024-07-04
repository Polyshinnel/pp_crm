<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

/**
 * @OA\Delete (
 *     path="/api/categories/{category}",
 *     summary="Удаление записи",
 *     tags={"Categories"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(description="Id категории", in="path", name="category", required=true, example=1),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Категория удалена",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="category was deleted"),
 *              @OA\Property(property="err", type="string", example="none"),
 *          )
 *     ),
 * ),
 */

class DestroyController extends BaseController
{
    public function __invoke(Category $category) {
        $result = $this->service->destroy($category);
        if($result['err'] != 'none') {
            return response()->json($result, 500);
        }

        return response()->json($result, 200);
    }
}
