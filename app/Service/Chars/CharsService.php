<?php

namespace App\Service\Chars;

use App\Models\Char;
use Exception;

class CharsService
{
    public function index(): array {
        return Char::all()->toArray();
    }

    public function store(array $data): array {
        try{
            $brand = Char::firstOrCreate(['name' => $data['name']], $data);
            if($brand->wasRecentlyCreated) {
                return [
                    'message' => 'Char was created',
                    'err' => 'none'
                ];
            }
            return [
                'message' => 'Something went wrong',
                'err' => 'This char already exists'
            ];
        } catch (Exception $exception) {
            return [
                'message' => 'Something went wrong',
                'err' => $exception->getMessage()
            ];
        }
    }

    public function update(Char $char, array $data): array {
        try{
            $char->update($data);
            return [
                'message' => 'Char was updated',
                'err' => 'none'
            ];
        } catch (Exception $exception) {
            return [
                'message' => 'Something went wrong',
                'err' => $exception->getMessage()
            ];
        }
    }

    public function destroy(Char $char): array {
        try {
            $char->delete();
            return [
                'message' => 'Char was deleted',
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
