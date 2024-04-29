<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

           ' Gestion des utilisateurs',
           'Les utilisateurs',
           'Les roles',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

           'Gestion des patients',
           'Les patiens',
           'Ajouter patient',
           'show-patient',
           'index-patient',
           'create-patient',
           'edit-patient',
           'delete-patient',

           'Gestion des medecins',
           'Les medecins',
           'Ajouter medecin',
           'show-medecin',
           'index-medecin',
           'create-medecin',
           'edit-medecin',
           'delete-medecin',

           'Gestion des services',
           'Les services',
           'Ajouter une service',
           'index-service',
           'create-service',
           'edit-service',
           'delete-service',
           'show-service',

           ' Gestion des specialistes',
           'Les specialistes',
           'Ajouter un specialiste',
            'index-specialiste',
            'create-specialiste',
            'edit-specialiste',
            'delete-specialiste',
            'show-specialiste',

           ' Gestion des consultations',
           'Les consultations',
           'Ajouter une consultation',
           'Statistiques des consultations',
            'index-consultation',
            'create-consultation',
            'edit-consultation',
            'delete-consultation',
            'show-consultation',
            'stats-consultation',
            'print-consultation',

            'index-type',
            'create-type',
            'edit-type',
            'delete-type',
            'show-type',

            'Gestion des soins',
            'Ajouter soins',
            'Les soins',
            'Statistiques des soins',
            'index-soins',
            'create-soins',
            'edit-soins',
            'delete-soins',
            'show-soins',
            'stats-soins',
            'print-soins',

            'Analyses',
            'Les analyses',
            'Ajouter analyse',
            'Statistiques des analyses',
            'edit-analyse',
            'delete-analyse',
            'show-analyse',
            'stats-analyse',
            'print-analyse',
            'index-analyse',
            'create-analyse',


            'Laboratoires',
            'Examens',
            'Resultats',
            'index-examen',
            'create-examen',
            'edit-examen',
            'delete-examen',
            'show-examen',
            'stats-examen',
            'print-examen',

            'Interventions',
            'Les interventions',
            'Statistiques des interventions',
            'index-intervention',
            'create-intervention',
            'edit-intervention',
            'delete-intervention',
            'show-intervention',
            'stats-intervention',
            'print-intervention',







         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
     }
}

