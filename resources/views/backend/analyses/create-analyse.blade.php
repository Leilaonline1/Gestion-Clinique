<!-- create-analyse.blade.php -->

@extends('backend.layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Créer une Analyse</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('analyses.store') }}" method="post">
                                @csrf
                              
                                <div class="form-group">
                                    <label>Type Analyse :</label>
                                    <input type="text" name="type_analyse" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Prix de l'Analyse :</label>
                                    <input type="number" name="prix_analyse" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Unités :</label>
                                    <input type="text" name="unites" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Catégorie :</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">Sélectionnez une catégorie</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Valeur Normale :</label>
                                    <input type="text" name="valeur_normale" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Rang :</label>
                                    <textarea name="rang" class="form-control" rows="3"></textarea>
                                </div>
                                
                              
                                <button type="submit" class="btn btn-primary">Créer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

