<?php

namespace App\Http\Requests;

use App\Models\Produto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class ProdutoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return Gate::authorize('update',[Produto::class, 'update'])->allowed();
        // return Gate::allows('update',[Produto::class,'update']);
        return $this->user()->can('update',Produto::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                "nome" =>        "nullable | string",
                "preco" =>       ["nullable", "numeric", "min:1.99"],
                "qtd_estoque" => "nullable | integer | min:2",
                "descricao" =>  ["nullable", 'string', "max:500"],
                "importado" =>   "nullable | boolean"
            ];
    }
}
