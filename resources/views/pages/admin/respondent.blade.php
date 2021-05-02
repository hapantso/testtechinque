@extends('layout.admin')

@section('container')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item"><a href="{{ route('form') }}">Utilisateurs</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Réponses</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($respondents as $respondent)
                        <tr>
                            <td>{{ date('d-m-Y H:i:s', strtotime($respondent->created_at)) }}</td>
                            <td>
                                @if ($respondent->status == 0)
                                Non répondu
                                @else
                                Répondu
                                @endif
                            </td>
                            <td>
                                <ul>
                                    @foreach ($respondent->reponse as $reponse)
                                        <li>{{ $reponse->label_question }} : {{ $reponse->label_answer }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection