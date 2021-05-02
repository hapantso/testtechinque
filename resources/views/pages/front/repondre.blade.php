@extends('layout.front')

@section('container')
    <div class="container my-4">
        <h3 class="text-center">{{ $form->title }}</h3>
        <form action="{{ route('insert_response') }}" method="POST" id="formQuestion">
            @csrf
            @foreach ($questions as $question)
            <div class="card mx-auto my-2 {{ $question->id_form_page }}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">{{ $question->label_question }}</label>
                        @if ($question->type == "QCM")
                            @foreach ($question->answer as $answer)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="{{ $question->id_question }}[]" id="{{ $answer->id_answer }}" value="{{ $answer->id_answer }}">
                                <label class="form-check-label" for="{{ $answer->id_answer }}">{{ $answer->label_answer }}</label>
                            </div>
                            @endforeach
                        @else
                            @foreach ($question->answer as $answer)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="{{ $question->id_question }}" id="{{ $answer->id_answer }}" value="{{ $answer->id_answer }}">
                                <label class="form-check-label" for="{{ $answer->id_answer }}">{{ $answer->label_answer }}</label>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </form>

        <nav aria-label="...">
            <ul class="pagination">
                @if (count($formPages) == 1)
                    <button type="button" class="btn btn-primary" onclick="submit()">Valider</button>
                @else
                    @foreach ($formPages as $formPage)
                        <li class="page-item" aria-current="page">
                            <a class="page-link" href="#" onclick="getQuestionnaire('{{ $questions[0]->id_form_page }}', '{{ $formPage->id_form_page }}')">{{ $formPage->form_page_number }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </nav>
    </div>
@endsection

@section('script')
    <script>
        function getPagination(id_form){
            $.ajax({
                url : '{{ route("getPagination") }}',
                type : 'POST',
                data : {
                    _token : '{{ csrf_token() }}',
                    id_form : id_form
                },
                dataType : 'json',
                success: function(formPages){
                    var pagination = "";
                    formPages.forEach(element => {
                        pagination += '<li class="page-item" aria-current="page">'+
                        '<a class="page-link" href="#" onclick=\'getQuestionnaire("'+id_form+'", "'+element.id_form_page+'")\'>'+element.form_page_number+'</a>'+
                    '</li>';
                    });
                    $(".pagination").html(pagination);
                }
            })
        }

        function getQuestionnaire(id_question, id_form) {
            if(id_question == id_form){

            }else{
                if($('div').hasClass(id_form)){
                    $("."+id_question).css({
                        'display' : 'none'
                    });
                    $("."+id_form).css({
                        'display' : 'block'
                    });
                    getPagination(id_form);
                }else{
                    $.ajax({
                        url : '{{ route("getQuestionnaire") }}',
                        type : 'POST',
                        data : {
                            _token : '{{ csrf_token() }}',
                            id_form : id_form
                        },
                        dataType : 'json',
                        success: function(response){
                            var text = '';
                            var pagination = '';
                            response.question.forEach(element => {
                                text += '<div class="card mx-auto my-2 '+element.id_form_page+'">'+
                                    '<div class="card-body">'+
                                        '<div class="form-group">'+
                                        '<label for="">'+element.label_question+'</label>';
                                if(element.type == 'QCM'){
                                    element.answer.forEach(key => {
                                        text += '<div class="form-check">'+
                                                '<input class="form-check-input" type="checkbox" name="'+key.id_question+'[]" id="'+key.id_answer+'" value="'+key.id_answer+'">'+
                                                '<label class="form-check-label" for="'+key.id_answer+'">'+key.label_answer+'</label>'+
                                            '</div>';
                                    });
                                }else{
                                    element.answer.forEach(key => {
                                        text += '<div class="form-check">'+
                                                '<input class="form-check-input" type="radio" name="'+key.id_question+'" id="'+key.id_answer+'" value="'+key.id_answer+'">'+
                                                '<label class="form-check-label" for="'+key.id_answer+'">'+key.label_answer+'</label>'+
                                            '</div>';
                                    });
                                }
                                text +='</div>'+
                                '</div>'+
                                '</div>';
                            });
                            text += '<button type="button" class="btn btn-primary submit my-2" onclick="submit()">Valider</button>';
                            $("#formQuestion").append(text);
                            $("."+id_question).css({
                                'display' : 'none'
                            });
                            response.formPages.forEach(element => {
                                pagination += '<li class="page-item" aria-current="page">'+
                                '<a class="page-link" href="#" onclick=\'getQuestionnaire("'+id_form+'", "'+element.id_form_page+'")\'>'+element.form_page_number+'</a>'+
                            '</li>';
                            });
                            $(".pagination").html(pagination);
                        }
                    })
                }
            }
        }
    </script>
@endsection