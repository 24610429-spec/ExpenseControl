<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gasto extends Model
{
    use HasFactory;

    protected $fillable = [
        'concepto',
        'cantidad',
        'fecha',
        'descripcion',
        'categoria_id'
    ];

    protected function casts(): array
    {
        return [
            'cantidad' => 'decimal:2',
            'fecha' => 'date'
        ];
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
