<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Analyse extends Model
{
    use HasFactory;
    protected $table = 'analyses';
    protected $fillable = [
       
       
        'type_analyse',
        'prix_analyse',
        'unites',
        'category_id',
        'code_analyse',
       
    ];

   
    public function patients()
    {
        return $this->belongsToMany(Patient::class);
    }
  
    public function valeurNormale()
    {
        return $this->hasOne(ValeurNormale::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    protected static function boot()
    {
        parent::boot();
        
        // Écouter l'événement "creating" pour remplir automatiquement le champ "code_analyse"
        static::creating(function ($analyse) {
            $lastTwoDigitsOfYear = now()->format('y'); // Deux derniers chiffres de l'année courante
            $day = now()->format('d'); // Jour actuel
            $latestAnalyse = self::latest()->first(); // Récupérer la dernière analyse enregistrée
            if ($latestAnalyse) {
                $lastCode = substr($latestAnalyse->code_analyse, -3); // Extraire les trois derniers chiffres du dernier code
                $nextCodeNumber = intval($lastCode) + 1; // Incrémenter le nombre de 1
                $code = $day . $lastTwoDigitsOfYear . str_pad($nextCodeNumber, 3, '0', STR_PAD_LEFT); // Concaténer les éléments pour former le code
            } else {
                // Si c'est la première analyse, commencez à partir de 001
                $code = $day . $lastTwoDigitsOfYear . '001';
            }
            $analyse->code_analyse = $code;
        });
    }
    

}
