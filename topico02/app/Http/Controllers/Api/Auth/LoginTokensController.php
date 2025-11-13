<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\LoginRequest;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginTokensController extends LoginController
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->validated();
            $user = $this->authenticate($credentials);
            if (!$user) throw new Exception("Dados inválidos!");
            $ability = $user->is_admin?['is-admin']:[];
            $token = $user->createToken($user->email,$ability)->plainTextToken;
            return response()->json(compact('token','user'));
        } catch (Exception $error) {
            return $this->errorHandler(
                $error->getMessage(),
                $error,
                401
            );
        }
    }
}
