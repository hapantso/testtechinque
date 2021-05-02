<?php

namespace App\Http\Controllers;

use App\Models\AnswerModel;
use App\Models\FormPagesModel;
use App\Models\FormsModel;
use App\Models\HaveModel;
use App\Models\QuestionsModel;
use App\Models\RespondentsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isNan;

class IndexController extends Controller
{
    public function index()
    {
        $form = FormsModel::all();
        return view('pages.front.index', ['forms' => $form]);
    }

    public function repondre($id_form)
    {
        if(Session::get('id_respondats')){

        }else{
            $data = array(
                'id_form' => $id_form,
                'status' => 0
            );
            $respondants = RespondentsModel::create($data);
            Session::put('id_respondats', $respondants->id_respondent);
        }
        $formPages = FormPagesModel::where('id_form', $id_form)->get();
        $questions = QuestionsModel::where('id_form_page', $formPages[0]->id_form_page)->get();
        foreach ($questions as $question) {
            $question->answer = AnswerModel::where('id_question', $question->id_question)->get();
        }
        $form = FormsModel::find($id_form);
        $response = array(
            'form' => $form,
            'formPages' => $formPages,
            'questions' => $questions
        );
        return view('pages.front.repondre', $response);
    }

    public function insert(Request $request)
    {
        $data = $request->input();
        unset($data['_token']);
        foreach ($data as $key => $value) {
            if(is_array($value)){
                for ($i=0; $i < count($value); $i++) { 
                    HaveModel::create(array(
                        'id_answer' => $value[$i],
                        'id_respondent' => Session::get('id_respondats')
                    ));
                }
            }else{
                HaveModel::create(array(
                    'id_answer' => $value,
                    'id_respondent' => Session::get('id_respondats')
                ));
            }
        }
        $respondants = RespondentsModel::find(Session::get('id_respondats'));
        $respondants->status = 1;
        $respondants->save();
        Session::remove('id_respondats');
        return redirect('/');
    }

    public function getQuestionnaire(Request $request)
    {
        $id_form = $request->id_form;
        $form = FormPagesModel::find($id_form);
        $formPages = FormPagesModel::where('id_form', $form->id_form)->get();
        $questions = QuestionsModel::where('id_form_page',$id_form)->get();
        foreach ($questions as $question) {
            $question->answer = AnswerModel::where('id_question', $question->id_question)->get();
        }
        echo json_encode(array(
            'formPages' => $formPages,
            'question' => $questions
        ));
    }
    public function getPagination(Request $request)
    {
        $id_form = $request->id_form;
        $form = FormPagesModel::find($id_form);
        $formPages = FormPagesModel::where('id_form', $form->id_form)->get();
        echo json_encode($formPages);
    }
}
