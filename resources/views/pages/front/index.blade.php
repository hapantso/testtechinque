@extends('layout.front')

@section('container')
    <div class="container-fluid my-4">
        <h3 class="text-center">Choisissez une serie de question</h3>
        <div class="row">
            @foreach ($forms as $form)
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ $form->title }}</div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('respondants', $form->id_form) }}" class="btn btn-info m-2">Répondre</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection