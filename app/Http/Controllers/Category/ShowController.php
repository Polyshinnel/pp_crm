<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

/**
 * @OA\Get (
 *     path="/api/categories/{category}",
 *     summary="Единичная запись",
 *     tags={"Categories"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(description="Id категоии", in="path", name="category", required=true, example=1),
 *
 *     @OA\Response(
 *          response=200,
 *          description="Получить категорию",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  @OA\Property(property="id", type="integer", example=1),
 *                  @OA\Property(property="name", type="string", example="Название категории"),
 *                  @OA\Property(property="description", type="string", example="Описание категории"),
 *                  @OA\Property(property="parent_id", type="integer", example="0"),
 *                  @OA\Property(property="status", type="boolean", example=True),
 *              )
 *          )
 *     ),
 * ),
 */

class ShowController extends Controller
{
    public function __invoke(Category $category) {
        $category = $category->toArray();
        return response()->json(['data' => $category], 200);
    }
}
