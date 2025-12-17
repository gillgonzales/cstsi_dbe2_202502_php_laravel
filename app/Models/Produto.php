<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Znck\Eloquent\Relations\BelongsToThrough;

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

    public function fornecedor(): BelongsTo
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function regiao(): BelongsToThrough
    {
        return $this->belongsToThrough(
            Regiao::class,
            [
                Estado::class,
                Fornecedor::class
            ],
            foreignKeyLookup: [
                Regiao::class => 'regiao_id',
                Fornecedor::class => 'fornecedor_id'
            ]
        );
    }

    public function promocoes():BelongsToMany
    {
        return $this->belongsToMany(Promocao::class)
            ->withPivot('desconto');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }
}
