<?php

namespace App\Service\Brand;

use App\Models\Brand;
use Exception;
use Illuminate\Support\Facades\DB;

class BrandService
{
    public function index(): array {
        return Brand::all()->toArray();
    }

    public function store(array $data): array {
        try{
            $brand = Brand::firstOrCreate(['name' => $data['name']], $data);
            if($brand->wasRecentlyCreated) {
                return [
                    'message' => 'brand was created',
                    'err' => 'none'
                ];
            }
            return [
                'message' => 'Something went wrong',
                'err' => 'This brand already exists'
            ];
        } catch (Exception $exception) {
            return [
                'message' => 'Something went wrong',
                'err' => $exception->getMessage()
            ];
        }
    }

    public function update(Brand $brand, array $data): array {
        try{
            $brand->update($data);
            return [
                'message' => 'brand was updated',
                'err' => 'none'
            ];
        } catch (Exception $exception) {
            return [
                'message' => 'Something went wrong',
                'err' => $exception->getMessage()
            ];
        }
    }

    public function destroy(Brand $brand): array {
        try {
            $brand->delete();
            return [
                'message' => 'brand was deleted',
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
