<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Service;
use App\Models\Analyse;
use App\Models\Resultat;
use App\Models\ValeurNormale;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class PatientController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:index-patient|create-patient|edit-patient|delete-patient', ['only' => ['index','store']]);
         $this->middleware('permission:create-patient', ['only' => ['create','store']]);
         $this->middleware('permission:edit-patient', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-patient', ['only' => ['destroy']]);
    }
    public function index()
    {
        $services = Service::all();
        $analyses = Analyse::all();
        $patients = Patient::latest()->paginate(10);

        return view('backend.patients.index-patient', compact('patients', 'services', 'analyses'));
    }

    public function create()
    {
        $services = Service::all();
        $analyses = Analyse::all();
        $valeurNormale=ValeurNormale::all();
        return view('backend.patients.create-patient', compact('services', 'analyses'));
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'nom_patient' => 'required|string',
            'date_of_birth' => 'required|date',
            'num_patient' => 'required|string',
            'analyse_id' => 'required|array', // Assurez-vous qu'analyse_id est un tableau
            'analyse_id.*' => 'exists:analyses,id', // Assurez-vous que chaque ID d'analyse existe dans la table des analyses

        ]);



        // Récupération du dernier numéro de patient pour ce préfixe




        // Création d'une nouvelle instance de Patient
        $patient = new Patient();
        $patient->nom_patient = $request->nom_patient;
        $patient->date_of_birth = $request->input('date_of_birth');
        $patient->num_patient = $request->num_patient;
       $patient->id_service = $request->id_service;


        // Enregistrement du patient
        $patient->save();

        // Associer chaque analyse sélectionnée au patient
        foreach ($request->analyse_id as $analyseId) {
            $patient->analyses()->attach($analyseId);
        }
        // Redirection vers la page d'index des patients avec un message de succès
        return redirect()->route('patients.index')->with('success', 'ajouter avec succès !');
    }
    // Méthode pour afficher la vue des résultats et gérer la soumission des nouveaux résultats
    public function viewResults($id)
    {
        // Récupérer le patient
        $patient = Patient::findOrFail($id);
        // Supposons que vous récupérez le type d'analyse du patient à partir de ses résultats
        $analyse = $patient->analyses->first();

        // Afficher la vue des résultats avec les données du patient et de l'analyse
        return view('backend.patients.view-results', compact('patient', 'analyse'));
    }



public function storeResultat(Request $request, $id)
{
    //dd($request->all());
    // Valider les données du formulaire
    $request->validate([
        'resultat.*' => 'required|string',
    ]);

    // Récupérer le patient
    $patient = Patient::findOrFail($id);

    // Vérifier si $request->resultat est défini et n'est pas null
    if ($request->has('resultat') && $request->resultat !== null) {
        // Parcourir les résultats
        foreach ($request->resultat as $analyseId => $resultat) {
            $resultatModel = new Resultat();
            $resultatModel->resultat = $resultat;
            $resultatModel->analyse_id = $analyseId;
            $patient->resultats()->save($resultatModel);
        }
    }

    // Rediriger l'utilisateur avec un message de succès
    return redirect()->route('patients.index')->with('success', 'Résultats enregistrés avec succès !');

}

public function printResults($id)
{
    // Récupérer le patient avec ses résultats
    $patient = Patient::with('resultats')->findOrFail($id);

        // Retourner la vue d'impression avec les données du patient
        return view('backend.patients.print-results', compact('patient'));
}
public function printResults2($id)
{
    // Récupérer le patient avec ses résultats
    $patient = Patient::with(['resultats.analyse.valeurNormale'])->findOrFail($id);

    // Récupérer toutes les catégories avec leurs analyses associées
    $categories = Category::with(['analyses' => function ($query) {
        // Cette fonction de rappel est utilisée pour charger les analyses de chaque catégorie
        $query->with('valeurNormale'); // Charger les valeurs normales associées à chaque analyse
    }])->get();

    // Retourner la vue d'impression avec les données du patient et les catégories
    return view('backend.patients.print-results2', compact('patient', 'categories'));
}

private function generateUniquePatientNumber()
{
    // Obtenez les deux lettres pour le préfixe
    $prefixLetters = 'sa';

    // Récupérez le nombre total de patients avec ce préfixe
    $totalPatients = Patient::where('prefix', 'like', $prefixLetters . '%')->count();

    // Incrémentez le nombre de patients de 1 pour obtenir le prochain numéro de patient
    $nextPatientNumber = $totalPatients + 1;

    // Formatage du numéro de patient avec des zéros à gauche pour atteindre une longueur de 3 chiffres
    $formattedPatientNumber = str_pad($nextPatientNumber, 3, '0', STR_PAD_LEFT);

    // Concaténez le préfixe et le numéro de patient pour former le numéro de patient complet
    $fullPatientNumber = $prefixLetters . $formattedPatientNumber;

    return $fullPatientNumber;
}





    // Autres méthodes du contrôleur
}
