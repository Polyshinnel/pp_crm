<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;

/**
 * @OA\Get (
 *     path="/api/categories",
 *     summary="Список категорий",
 *     tags={"Categories"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Response(
 *          response=200,
 *          description="Получить список категорий",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer", example=1),
 *                      @OA\Property(property="name", type="string", example="Название категории"),
 *                      @OA\Property(property="description", type="string", example="Описание категории"),
 *                      @OA\Property(property="parent_id", type="integer", example=0),
 *                      @OA\Property(property="status", type="boolean", example=True),
 *                      @OA\Property(property="children", type="array", @OA\Items()),
 *                  )
 *              )
 *          )
 *     ),
 * ),
 */

class IndexController extends BaseController
{
    public function __invoke() {
        $categories = $this->service->index()->toArray();
        $format_categories = [];
        foreach ($categories as $category) {
            unset($category['created_at'],$category['updated_at']);
            $format_categories[] = $category;
        }
        $helper = new HelperController();
        $three = $helper->buildTree($format_categories,0);
        return response()->json($three, 200);
    }
}
