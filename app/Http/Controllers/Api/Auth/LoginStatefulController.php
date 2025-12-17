<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginStatefulController extends LoginController
{
    public function login(LoginRequest $request): JsonResource | JsonResponse
    {
        try {
            $credentials = $request->validated();
            // dd($credentials);
            //[email,password]
            $user = $this->authenticate($credentials);
            if (!$user)
                throw new Exception("Dados inválidos!");
            return new UserResource($user)
                ->additional(["message" => "Logado via sessão!!"]);
        } catch (Exception $error) {
            return $this->errorHandler(
                $error->getMessage(),
                $error,
                401
            );
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $user =  Auth::guard('web')->user();
        if (!$user)
            return response()->json(["message" => "Não autenticado!"], 401);
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(["message" => "Sessão encerrada!!!"]);
    }
}
