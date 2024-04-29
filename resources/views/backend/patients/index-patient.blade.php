@extends('backend.layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tous les Patients</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <div class="pull-right">
                                    <a class="btn btn-primary btn-sm" href="{{ route('patients.create') }}">Ajouter</a>
                                    <br> <hr>
                                </div>
                                <thead>
                                    <tr>
                                        <th>Prefix</th>
                                        <th>Nom du Patient</th>
                                        <th>Type analyse</th>
                                        <th>Prix analyse</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($patients as $key => $patient)
                                    <tr>
                                        <td>{{ $patient->prefix }}</td> 
                                        <td>{{ $patient->nom_patient }}</td>
                                        <td>
                                            <!-- Afficher les types d'analyse du patient -->
                                            @foreach($patient->analyses as $analyse)
                                                {{ $analyse->type_analyse }}
                                                @if(!$loop->last)
                                                    <br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <!-- Afficher les prix des analyses du patient -->
                                            @foreach($patient->analyses as $analyse)
                                                {{ $analyse->prix_analyse }}
                                                @if(!$loop->last)
                                                    <br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <!-- Calculer et afficher le total -->
                                            {{ $patient->analyses->sum('prix_analyse') }}
                                        </td>
                                        <td>
                                            <!-- Lien pour voir les résultats du patient -->
                                            <form action="{{ route('patients.view-results', $patient->id) }}" method="GET" style="display: inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> </button>
                                            </form>
                                            <a href="{{ route('patients.print-results', $patient->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-dollar-sign"></i> </a>

                                            <!-- Bouton pour imprimer les résultats -->
                                            <a href="{{ route('patients.print-results2', $patient->id) }}" class="btn btn-primary"><i class="fas fa-print"></i>  </a>


                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
