<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;

class CheckUser extends Controller
{
    public function __invoke(AuthRequest $request) {
        $data = $request->validated();
        $email = $data['email'] ?? '';
        if($email) {
            $user = User::where(['email' => $email])->first();
            if(!$user) {
                return response()->json(['message' => 'something went wrong', 'err' => 'The user with this email does not exist'], 403);
            }
            $activeUser = $user->verified;
            if(!$activeUser) {
                return response()->json(['message' => 'something went wrong', 'err' => 'The user is inactive'], 403);
            }
            return response()->json(['message' => 'Access is allowed', 'err' => 'none'], 200);
        }
        return response()->json(['message' => 'data is invalid', 'err' => 'email field cant be empty'], 400);
    }
}
