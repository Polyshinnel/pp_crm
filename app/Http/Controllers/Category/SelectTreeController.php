<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;

/**
 * @OA\Get (
 *     path="/api/categories/selectTree",
 *     summary="Список категорий Select",
 *     tags={"Categories"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Response(
 *          response=200,
 *          description="Получить список категорий Select",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer", example=1),
 *                      @OA\Property(property="value", type="integer", example=1),
 *                      @OA\Property(property="label", type="string", example="Название категории"),
 *                      @OA\Property(property="parent_id", type="integer", example=0),
 *                      @OA\Property(property="children", type="array", @OA\Items()),
 *                  )
 *              )
 *          )
 *     ),
 * ),
 */

class SelectTreeController extends BaseController
{
    public function __invoke() {
        $categories = $this->service->index();
        $format_categories = [];
        foreach ($categories as $category) {
            $format_categories[] = [
                'id' => $category->id,
                'value' => $category->id,
                'label' => $category->name,
                'parent_id' => $category->parent_id
            ];
        }
        $helper = new HelperController();
        $three = $helper->buildTree($format_categories, 0);
        return response()->json($three, 200);
    }
}
