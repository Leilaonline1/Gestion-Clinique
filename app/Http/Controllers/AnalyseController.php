<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analyse;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class AnalyseController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:index-analyse|create-analyse|edit-analyse|delete-analyse', ['only' => ['index','store']]);
         $this->middleware('permission:create-analyse', ['only' => ['create','store']]);
         $this->middleware('permission:edit-analyse', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-analyse', ['only' => ['destroy']]);
    }
    public function index()
    {
        $analyses = Analyse::latest()->paginate(10);
        return view('backend.analyses.index-analyse', compact('analyses'));
    }

    public function create()
    {
        // Récupérer toutes les catégories disponibles
        $categories = Category::all();

        // Passer les catégories à la vue
        return view('backend.analyses.create-analyse', compact('categories'));
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'type_analyse' => 'required|string|max:255',
            'prix_analyse' => 'required|numeric',
            'unites' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'valeur_normale' => 'required|string|max:255',
            'rang' => 'nullable|string|max:255',
        ]);

        // Récupérer la catégorie correspondante
        $category = Category::where('name', $validatedData['category_id'])->first();

        // Créer l'analyse et l'associer à la catégorie
        $analyse = Analyse::create([
            'type_analyse' => $validatedData['type_analyse'],
            'prix_analyse' => $validatedData['prix_analyse'],
            'unites' => $validatedData['unites'],
            'category_id' => $validatedData['category_id'],// Associer l'analyse à la catégorie
        ]);

        // Ajouter la valeur normale associée
        $analyse->valeurNormale()->create([
            'valeur' => $validatedData['valeur_normale'],
            'rang' => $validatedData['rang'],
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('analyses.index')->with('success', 'Analyse crée avec succès.');
    }


    // Les autres méthodes du contrôleur vont ici...
}
