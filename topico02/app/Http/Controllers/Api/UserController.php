<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if(!$request->user()->tokenCan('is-admin'))
            return response()->json(['error'=>'Usuário não tem permissão!!'],401);
        return new UserResourceCollection(User::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {

        try {
            return new UserResource(User::create($request->validated()))
            ->additional(["message"=>"Usuário cadastrado!!"])
            ->response()->setStatusCode(201);
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao cadastrar o usuário!!!", $error, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //Somente usuários alteram o próprio perfil
        //$request->user() tem que ser o mesmo $user
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //Mesma regra do Update, mas deve permitir também o Admin
    }
}
