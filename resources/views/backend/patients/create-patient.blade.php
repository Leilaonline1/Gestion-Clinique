@extends('backend.layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ajouter un Patient</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('patients.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="nom_patient">Nom du Patient</label>
                                    <input type="text" name="nom_patient" class="form-control" placeholder="Nom du Patient" required>
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date de Naissance</label>
                                    <input type="date" name="date_of_birth" class="form-control" required>
                                </div>
                               
                                <div class="form-group">
                                    <label for="num_patient">Numéro du Patient</label>
                                    <input type="text" name="num_patient" class="form-control" placeholder="Numéro du Patient" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_service">Service</label>
                                    <select name="id_service" class="form-control" required>
                                        <option value="">Sélectionnez un service</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->nom_service }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="analyse_id">Analyse(s)</label>
                                    <select name="analyse_id[]" class="form-control" multiple>
                                        <option value="">Sélectionnez une ou plusieurs analyses</option>
                                        @foreach($analyses as $analyse)
                                            <option value="{{ $analyse->id }}">{{ $analyse->type_analyse }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
