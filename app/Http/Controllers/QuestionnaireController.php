<?php

namespace App\Http\Controllers;

use App\Models\AnswerModel;
use App\Models\FormPagesModel;
use App\Models\FormsModel;
use App\Models\QuestionsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionnaireController extends Controller
{
    public function index($id_form)
    {
        $form = FormsModel::find($id_form);
        return view('pages.admin.questionnaire', ['form' => $form]);
    }

    public function save(Request $request)
    {
        $formPageNumber = FormPagesModel::where('id_form', $request->id_form)->max('form_page_number');
        ($formPageNumber == null) ? 1 : $formPageNumber+1;
        if($formPageNumber == null){
            $formPageNumber = 1;
            $formPage = new FormPagesModel;
            $formPage->id_form = $request->id_form;
            $formPage->form_page_number = $formPageNumber;
            $formPage->save();
        }else{
            $nombreQuestion = QuestionsModel::where('id_form_page', FormPagesModel::where('form_page_number', $formPageNumber)->first()->id_form_page)->count();
            if($nombreQuestion == 2){
                $formPageNumber++;
                $formPage = new FormPagesModel;
                $formPage->id_form = $request->id_form;
                $formPage->form_page_number = $formPageNumber;
                $formPage->save();
            }else{
                $formPage = FormPagesModel::where('form_page_number', $formPageNumber)->first();
            }
        }
        if($formPage->id_form_page != null){
            $question = new QuestionsModel;
            $question->label_question = $request->question;
            $question->type = $request->type;
            $question->id_form_page = $formPage->id_form_page;
            $question->save();
            if($question->id_question != null){
                foreach ($request->answer as $value) {
                    $answer = new AnswerModel;
                    $answer->label_answer = $value;
                    $answer->id_question = $question->id_question;
                    $answer->save();
                }
            }
        }
        return back();
    }
    public function liste($id_form)
    {
        
        $question = DB::select("SELECT questions.* FROM questions, form_pages WHERE (questions.id_form_page = form_pages.id_form_page) AND (form_pages.id_form = $id_form)");
        foreach ($question as $value) {
            $value->answer = AnswerModel::where('id_question', $value->id_question)->get();
        }
        return view('pages.admin.listeQuestionnaire', ['questions' => $question]);
    }

    public function modifier($id_question)
    {
        $question = QuestionsModel::find($id_question);
        $question->answer = AnswerModel::where('id_question', $id_question)->get();
        return view('pages.admin.update', ['question' => $question]);
    }

    public function update($id_question, Request $request)
    {
        $question = QuestionsModel::find($id_question);
        $question->label_question = $request->question;
        $question->type = $request->type;
        $question->save();
        AnswerModel::where('id_question', $id_question)->delete();
        foreach ($request->answer as $value) {
            $answer = new AnswerModel;
            $answer->label_answer = $value;
            $answer->id_question = $id_question;
            $answer->save();
        }
        $id_form = FormPagesModel::find($question->id_form_page)->id_form;
        return redirect(route('liste_questionnaire', $id_form));
    }
    public function delete($id_question)
    {
        QuestionsModel::find($id_question)->delete();
        return back();
    }
}
