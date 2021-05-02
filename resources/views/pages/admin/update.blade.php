@extends('layout.admin')

@section('container')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item active"><a href="#">Questionnaire</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('update_question', $question->id_question) }}" method="post">
                @csrf
                <div class="questions">
                    <div class="question">
                        <div class="form-group">
                            <label for="">Type de question</label>
                            <select name="type" id="type" class="form-control">
                                <option value="QCM" @if ($question->type == 'QCM')
                                    selected
                                @endif>Mutliple</option>
                                <option value="QCS"@if ($question->type == 'QCS')
                                    selected
                                @endif>Simple</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Question</label>
                            <input type="text" class="form-control" name="question" id="question" value="{{ $question->label_question }}">
                        </div>
                        <div id="reponse">
                            @foreach ($question->answer as $key => $answer)
                                @if ($key == 0)
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label for="">Reponse</label>
                                                <input type="text" class="form-control" name="answer[]" id="answer" value="{{ $answer->label_answer }}">
                                            </div>
                                        </div>
                                        <div class="col-2 mt-2rem">
                                            <button type="button" class="btn btn-info add-answer"><i class='bx bxs-plus-circle'></i></button>
                                        </div>
                                    </div>
                                @else
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label for="">Reponse</label>
                                            <input type="text" class="form-control" name="answer[]" id="answer" value="{{ $answer->label_answer }}">
                                        </div>
                                    </div>
                                    <div class="col-2 mt-2rem">
                                        <button type="button" class="btn btn-info remove-answer">
                                            <i class="bx bx-window-close"></i>
                                        </button>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function addAnswer() {
            return '<div class="row"><div class="col-10"><div class="form-group"> <label for="">Reponse</label><input type="text" class="form-control" name="answer[]" id="question"></div></div>'+
            '<div class="col-2 mt-2rem">'+
                '<button type="button" class="btn btn-info remove-answer"><i class="bx bx-window-close"></i></button>'+
            '</div></div>';
        }
        $("body").delegate('.add-answer', 'click', function(){
            $("#reponse").append(addAnswer());
        });
        $("body").delegate('.remove-answer', 'click', function(){
            $(this).parent('.col-2').parent('.row').remove();
        });
    </script>
@endsection()