@extends('backend.layouts.app')

@section('content')

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Toutes les Analyses</h3>
                        </div>
                        <div class="card-body">
                            <div class="pull-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('analyses.create') }}">Ajouter</a>
                                <br><hr>
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>N° analyse</th>
                                        <th>Prix de l'Analyse</th>
                                        <th>Type de l'Analyse</th>
                                        <th>Actions</th> <!-- Colonne pour les actions -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($analyses as $key => $analyse)
                                    <tr>
                                        <td>{{ $analyse->code_analyse}}</td>
                                        <td>{{ $analyse->prix_analyse }}</td>
                                        <td>{{ $analyse->type_analyse }}</td>
                                        <td> <!-- Cellule pour les actions -->
                                            <a href="{{ route('analyses.show', $analyse->id) }}" class="btn btn-sm btn-info" title="Détails"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="{{ route('analyses.edit', $analyse->id) }}" class="btn btn-sm btn-warning" title="Modifier"><i class="fas fa-edit"></i></a>
                                            @can('delete-analyse')
                                            <form action="{{ route('analyses.destroy', $analyse->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                            @endcan
                                            <a href="{{ route('analyse.print', $analyse->id) }}" class="btn btn-sm btn-success" title="Imprimer"><i class="fa fa-print" aria-hidden="true"></i></a>
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
