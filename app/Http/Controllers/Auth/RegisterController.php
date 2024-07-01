<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request) {
        $data = $request->validated();
        $errFlag = 0;
        if(
            !isset($data['name']) ||
            !isset($data['second_name']) ||
            !isset($data['email']) ||
            !isset($data['password'])
        )
        {
            $errFlag = 1;
        }
        if($errFlag < 1) {
            $createArr = [
                'name' => $data['name'],
                'second_name' => $data['second_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ];

            try {
                User::create($createArr);
                return response()->json(
                    [
                        'message' => 'user was created',
                        'err' => 'none'
                    ]
                );
            } catch (Exception $exception) {
                return response()->json(
                    [
                        'message' => 'something went wrong',
                        'err' => $exception->getMessage()
                    ], 500
                );
            }
        }
        return response()->json([
            'message' => 'something went wrong',
            'err' => 'data is invalid'
        ], 400);
    }
}
