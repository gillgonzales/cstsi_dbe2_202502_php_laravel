<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    use HasFactory, \Znck\Eloquent\Traits\BelongsToThrough;

    // protected $tablem = 'products';

    // protected $primaryKey = 'id_prod';

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'qtd_estoque',
        'importado',
        'fornecedor_id'
    ];

    public function fornecedor(){
        return $this->belongsTo(Fornecedor::class);
    }

    public function regiao(){
        return $this->belongsToThrough(
            Regiao::class,
            [
                Estado::class,
                Fornecedor::class
            ],
            foreignKeyLookup: [
                Regiao::class=>'regiao_id',
                Fornecedor::class=>'fornecedor_id'
            ]
        );
    }

    public function promocoes()
    {
        return $this->belongsToMany(Promocao::class)
                ->withPivot('desconto');
    }
}
