<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats des Analyses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 80%;
            padding: 20px;
            border: 2px solid #000;
            border-radius: 10px;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            padding: 10px;
            border-bottom: 2px solid #000;
        }
        .patient-info {
            margin-bottom: 20px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }
        .patient-info p {
            margin: 5px 0;
        }
        .results-heading {
            margin-bottom: 10px;
            font-weight: bold;
            text-decoration: underline;
        }
        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .results-table th, .results-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .results-table th {
            background-color: #f2f2f2;
        }
        .print-button {
            text-align: center;
            margin-top: 20px;
        }
        .print-button button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        @media print {
            .print-button {
                display: none; /* Masquer le bouton lors de l'impression */
            }
        }
        .signature {
            text-align: right;
            margin-top: 20px; /* Ajoutez un espacement entre le tableau et la signature */
        }
        .signature img {
            max-width: 200px; /* Ajustez la taille de l'image selon vos besoins */
            height: auto;
        }
        .resultat-gras {
            font-weight: bold;
        }
        .results-table td.rang {
            white-space: pre-wrap; /* Cette propriété permettra au texte de revenir à la ligne en fonction des espaces et des sauts de ligne */
        }
        @media print {
            .results-table td.rang {
                white-space: pre-wrap;
                page-break-inside: auto; /* Permet le saut de ligne à l'intérieur des cellules du tableau lors de l'impression */
            }
            .results-table pre {
                margin: 0; /* Réinitialise les marges par défaut */
                white-space: pre-wrap; /* Permet le retour à la ligne */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Entête -->
        <div class="header">
            <h1>Résultats des Analyses</h1>
        </div>
        <!-- Informations du patient -->
        <div class="patient-info">
            <div>
                <p>Patient: {{ $patient->nom_patient }}</p>
                <p>N° Patient: {{ $patient->prefix }}</p>
                <p>Date: <?php echo date("d/m/Y H:i"); ?></p>
            </div>
            <div>
                <p>Date de naissance: {{ $patient->date_of_birth }}</p>
                <p>Numéro de téléphone: {{ $patient->num_patient }}</p>
                @if($patient->analyses->isNotEmpty())
            <p>Code Analyse: {{ $patient->analyses->first()->code_analyse }}</p>
        @endif
            </div>
        </div>
        <!-- Tableau des détails des analyses -->
        <div class="results-heading"></div>
        @foreach($categories as $category)
            <!-- Vérifier si la catégorie a des analyses pour le patient sélectionné -->
            @php
                $analysesForCategory = $category->analyses->filter(function ($analyse) use ($patient) {
                    return $patient->resultats->pluck('analyse_id')->contains($analyse->id);
                });
            @endphp
            @if($analysesForCategory->isNotEmpty())
                <!-- Titre de la catégorie -->
                <div class="results-heading">{{ $category->name }}:</div>
                <table class="results-table">
                    <thead>
                        <tr>
                            <th>Type Analyse</th>
                            <th>Résultat</th>
                            <th>Unités</th>
                            <th class="rang">Valeurs Normales</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($analysesForCategory as $analyse)
                            <tr>
                                <td>{{ $analyse->type_analyse }}</td>
                                @php
                                    $resultatValue = null;
                                    $isWithinInterval = false;
                                    foreach($patient->resultats as $resultat) {
                                        if($resultat->analyse_id === $analyse->id) {
                                            $resultatValue = $resultat->resultat;
                                            // Extrayez les valeurs min et max de la chaîne "x-y"
                                            list($valeurNormaleMin, $valeurNormaleMax) = explode('-', $analyse->valeurNormale->valeur);
                                            // Convertissez les valeurs en nombres si nécessaire
                                            $valeurNormaleMin = intval($valeurNormaleMin);
                                            $valeurNormaleMax = intval($valeurNormaleMax);
                                            // Vérifiez si le résultat se situe dans l'intervalle spécifié
                                            $isWithinInterval = ($resultatValue >= $valeurNormaleMin && $resultatValue <= $valeurNormaleMax);
                                            break; // On arrête la boucle une fois qu'on a trouvé le résultat correspondant à l'analyse
                                        }
                                    }
                                @endphp
                                @if($isWithinInterval)
                                    <td>{{ $resultatValue }}</td>
                                @else
                                    <td class="resultat-gras">{{ $resultatValue }}</td>
                                @endif
                                <td>{{ $analyse->unites }}</td>
                                <td><pre>{{ $analyse->valeurNormale->rang }}</pre></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endforeach
        <!-- Bouton pour imprimer la page -->
        <div class="print-button">
            <button onclick="window.print()">Imprimer</button>
        </div>
        <!-- Signature du biologiste -->
        <div class="signature">
            <img src="chemin/vers/votre/image/signature_biologiste.png" alt="Biologiste">
        </div>
    </div>
</body>
</html>
