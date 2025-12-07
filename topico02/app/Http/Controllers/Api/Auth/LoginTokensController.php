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
            $ability = $user->is_admin ? ['is-admin'] : [];
            $token = $user->createToken($user->email, $ability)->plainTextToken;
            return response()->json(compact('token', 'user'));
        } catch (Exception $error) {
            return $this->errorHandler(
                $error->getMessage(),
                $error,
                401
            );
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response()->json(['Usuário desconectado!'], 200);
    }

    public function refresh(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        $token = $user->createToken($user->email)->plainTextToken;
        return compact(['user', 'token']);
    }
}
