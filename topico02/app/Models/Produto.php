<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    use HasFactory;

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
}
