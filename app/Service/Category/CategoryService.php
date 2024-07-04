<?php

namespace App\Service\Category;

use App\Models\Category;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function index(): Collection {
        return Category::all();
    }

    public function store(array $data): array{
        $category = Category::where(['name' => $data['name']])->first();
        if(!$category) {
            try {
                $category = Category::create($data);
                return [
                    'message' => 'category was created',
                    'err' => 'none'
                ];
            } catch (Exception $exception) {
                return [
                    'message' => 'Something went wrong',
                    'err' => $exception->getMessage()
                ];
            }
        }
        return [
            'message' => 'Something went wrong',
            'err' => 'This category already exists'
        ];
    }

    public function update(Category $category, array $data): array {
        try{
            $category->update($data);
            return [
                'message' => 'category was updated',
                'err' => 'none'
            ];
        } catch (Exception $exception) {
            return [
                'message' => 'Something went wrong',
                'err' => $exception->getMessage()
            ];
        }
    }

    public function destroy(Category $category): array {
        try{
            $category->delete();
            return [
                'message' => 'category was deleted',
                'err' => 'none'
            ];
        } catch (Exception $exception) {
            return [
                'message' => 'Something went wrong',
                'err' => $exception->getMessage()
            ];
        }
    }
}
