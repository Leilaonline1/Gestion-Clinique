<!-- resources/views/backend/patients/print.blade.php -->

@extends('backend.layouts.app')

@section('content')

<style>
    @media print {
        /* Masquer les éléments qui ne doivent pas être imprimés */
        body * {
            visibility: hidden;
        }
        #printable-content, #printable-content * {
            visibility: visible;
        }
        /* Styles pour le contenu imprimable */
        #printable-content {
            position: absolute;
            left: 0;
            top: 0;
        }
        /* Style de la fiche imprimée */
        .printable-sheet {
            width: 100%;
            padding: 20px;
            background-color: #fff;
            font-family: Arial, sans-serif;
        }
        .printable-sheet h1 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center; /* Centrage du texte */
            font-weight: bold; /* Texte en gras */
            border: 3px solid #000; /* Bordure forte */
            padding: 10px; /* Espace intérieur */
        }
        .printable-sheet table {
            width: 100%;
            border-collapse: collapse;
        }
        .printable-sheet th, .printable-sheet td {
            border-top: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .printable-sheet th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        /* Ajouter une bordure inférieure à chaque ligne sauf à la dernière */
        .printable-sheet tbody tr:not(:last-child) {
            border-bottom: 1px solid #ccc;
        }
        /* Rectangle pour les différentes sections */
        .section-container {
            border: 3px solid #000; /* Bordure forte */
            padding: 20px; /* Espace intérieur */
            margin-bottom: 20px; /* Espace en-dessous */
        }
        /* Style pour le titre "Biochimies" */
        .biochimies-title {
            text-align: center; /* Centrage du texte */
            margin-bottom: 20px; /* Espace en-dessous */
        }
        /* Style pour le bouton d'impression */
        .print-button {
            display: none;
        }
      /* CSS pour la grille */
      /* CSS pour la grille */
  

      /* CSS pour le formulaire de mode de paiement */
      #payment-form {
    margin-top: auto; /* Alignement vertical avec le nom du patient */
}
    /* CSS pour la grille */
.section-container {
    display: grid;
    grid-template-columns: auto auto; /* Deux colonnes, une pour les informations du patient et une pour le numéro de patient et le mode de paiement */
    grid-column-gap: 20px; /* Espacement horizontal entre les colonnes */
}

/* CSS pour le formulaire de mode de paiement */

/* CSS pour le titre "Biochimies" */
.biochimies-title {
    text-align: right; /* Centrage du texte */
    margin-bottom: 20px; /* Espace en-dessous */
}




     }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div id="printable-content" class="printable-sheet">
                        <!-- En-tête -->
                     
                        <!-- Section pour les informations du patient -->
                      
                        <div class="section-container">
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <p><strong><span style="font-size: larger;">CLINIQUE ESSAVA</span></strong></p>

                                    <p><strong>Tél: 36397090-36397090</strong></p>
                                    <p><strong>Nom du patient:</strong> {{ $patient->nom_patient }}</p>
                                    <p><strong>N° Patient:</strong> {{ $patient->prefix }}</p>
                                    <p><strong>Date de naissance:</strong> {{ $patient->date_of_birth }}</p>
                                  
                                </div>
                                <div style="text-align: right;">
                                    <p><strong><span style="font-size: larger;">عيادة الصفا </span></strong></p>

                                    <p><strong> الهاتف:36397090-36397090</strong></p>
                                    <form id="payment-form">
                                        <label for="payment-method">Mode de paiement:</label>
                                        <select name="payment-method" id="payment-method">
                                            <option value="cash">Cash</option>
                                            <option value="card">Carte bancaire</option>
                                            <option value="check">Chèque</option>
                                        </select>
                                    </form>
                                    <p><strong>Numéro de téléphone:</strong> {{ $patient->num_patient }}</p>
                                    <p><strong>Date:</strong> <?php echo date("d/m/Y H:i"); ?></p>
                                </div>
                            </div>
                        </div>
                        <h1>Reçu  وصــل </h1>
                        <!-- Section pour les détails de la biochimie -->
                        <div class="section-container">
                           
                            <table>
                                <thead>
                                    <tr>
                                        <th>Type d'Analyse</th>
                                        <th>Prix</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($patient->analyses as $analyse)
                                    <tr>
                                        <td>{{ $analyse->type_analyse }}</td>
                                        <td>{{ $analyse->prix_analyse }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td><strong>{{ $patient->analyses->sum('prix_analyse') }} MRU</strong></td>
                                    </tr> 
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Bouton pour l'impression -->
                    <button class="print-button" onclick="window.print()">Imprimer</button>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
