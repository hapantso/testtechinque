@extends('layout.admin')

@section('container')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item"><a href="{{ route('form') }}">Formulaire de questionnaire</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Liste</a></li>
        </ol>
    </nav>

    <a href="{{ route('add_form') }}" class="btn btn-primary my-3">Ajouter un formulaire de questionnaire</a>

    <div class="row">
        @foreach ($forms as $form)
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">{{ $form->title }}</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('questionnaire', $form->id_form) }}" class="btn btn-info m-2">Ajouter des questionnaires</a>
                        <a href="{{ route('liste_questionnaire', $form->id_form) }}" class="btn btn-primary m-2">Modifier des questionnaires</a>
                        <a href="{{ route('delete',  $form->id_form) }}" class="btn btn-danger m-2">Supprimer</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection