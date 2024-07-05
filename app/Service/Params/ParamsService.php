<?php

namespace App\Service\Params;

use App\Models\Param;
use Exception;

class ParamsService
{
    public function index(): array {
        return Param::all()->toArray();
    }

    public function store(array $data): array {
        try{
            $brand = Param::firstOrCreate(['name' => $data['name']], $data);
            if($brand->wasRecentlyCreated) {
                return [
                    'message' => 'Param was created',
                    'err' => 'none'
                ];
            }
            return [
                'message' => 'Something went wrong',
                'err' => 'This param already exists'
            ];
        } catch (Exception $exception) {
            return [
                'message' => 'Something went wrong',
                'err' => $exception->getMessage()
            ];
        }
    }

    public function update(Param $param, array $data): array {
        try{
            $param->update($data);
            return [
                'message' => 'Param was updated',
                'err' => 'none'
            ];
        } catch (Exception $exception) {
            return [
                'message' => 'Something went wrong',
                'err' => $exception->getMessage()
            ];
        }
    }

    public function destroy(Param $param): array {
        try {
            $param->delete();
            return [
                'message' => 'Param was deleted',
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
