<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValeurNormale extends Model
{
    use HasFactory;
    protected $table = 'valeurs_normales';

    protected $fillable = [
        'analyse_id',
        'categorie',
        'valeur',
        'rang',
    ];
    public function analyse()
    {
        return $this->belongsTo(Analyse::class);
    }
}
