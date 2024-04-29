<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients';
    protected $fillable = [
        'nom_patient',
        'id_service',
        'analyse_id',
        'prefix',
        'date_of_birth',
    ];

            public function consultations()
            {
                return $this->hasMany(Consultation::class, 'id_patient');
            }

            
            public function service(){
                return $this->belongsTo(Service::class,'id_service');
            }
            public function analyses()
            {
                return $this->belongsToMany(Analyse::class);
            }

            public function soins(){
                return $this->hasMany(Soins::class, 'id_patient');
            }

        
          
            public function resultats()
            {
                return $this->hasMany(Resultat::class, 'patient_id');
            }
            protected static function boot()
            {
                parent::boot();
            
                // Écouter l'événement "creating" pour remplir automatiquement le champ "prefix"
                static::creating(function ($patient) {
                    $prefix = now()->format('ymd');
            
                    // Récupérer le nombre total de patients avec ce préfixe
                    $totalPatients = self::where('prefix', 'like', $prefix . '%')->count();
            
                    // Incrémenter le nombre de patients de 1 pour obtenir le prochain numéro de patient
                    $nextPatientNumber = $totalPatients + 1;
            
                    // Formatage du numéro de patient avec des zéros à gauche pour atteindre une longueur de 3 chiffres
                    $formattedPatientNumber = str_pad($nextPatientNumber, 4, '0', STR_PAD_LEFT);
            
                    // Concaténation du préfixe et du numéro de patient pour former le numéro de patient complet
                    $patient->prefix = $prefix . $formattedPatientNumber;
                });
            }
            
}
