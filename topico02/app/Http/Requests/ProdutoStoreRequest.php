<?php

namespace App\Http\Requests;

use App\Models\Produto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class ProdutoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        // return Gate::forUser($this->user())->allows('create',Produto::class);
        // return Gate::authorize('create',Produto::class)->allowed();
        // return $this->user()->can('create',Produto::class);
        // return Gate::allows('create',Produto::class);
        // return Gate::allows('superuser');

        return $this->user()->can('create',Produto::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                "nome" =>        "required | string",
                "preco" =>       ["required", "numeric", "min:1.99"],
                "qtd_estoque" => "required | integer | min:2",
                "descricao" =>  ["required", 'string', "max:500"],
                "importado" =>   "nullable | boolean",
                "imagem" => "nullable | image",
                "video" => "nullable | url",
                "fornecedor_id" => "required | integer"
            ];
    }

    public function prepareForValidation() : void {
        $this->merge([
            "importado" =>$this->has('importado')
        ]);
    }

    public function messages()
    {
        return [
            "qtd_estoque.required" => "A quantidade de produtos em estoque é obrigatória.",
            "qtd_estoque.min" => "O estoque só aceita o cadastro de dois ou mais produtos."
        ];
    }
}
