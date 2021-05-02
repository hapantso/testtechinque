@extends('layout.admin')

@section('container')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item active"><a href="#">Formulaire de questionnaire</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <th>Question</th>
                    <th>Type</th>
                    <th>Reponse</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            <td>{{ $question->label_question }}</td>
                            <td>{{ $question->type }}</td>
                            <td>
                                <ul>
                                    @foreach ($question->answer as $answer)
                                        <li>{{ $answer->label_answer }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="{{ route('modifier_question', $question->id_question) }}" class="badge badge-primary p-2 mr-2">Modifier</a>
                                <a href="{{ route('supprimer_question', $question->id_question) }}" class="badge badge-danger p-2">Supprimer</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection