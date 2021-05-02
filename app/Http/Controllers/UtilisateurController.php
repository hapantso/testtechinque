<?php

namespace App\Http\Controllers;

use App\Models\AnswerModel;
use App\Models\HaveModel;
use App\Models\QuestionsModel;
use App\Models\RespondentsModel;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function index()
    {
        $respondents = RespondentsModel::all();
        foreach ($respondents as $respondent) {
            $respondent->reponse = HaveModel::where('id_respondent', $respondent->id_respondent)->get();
            foreach ($respondent->reponse as $value) {
                $value->label_answer = AnswerModel::find($value->id_answer)->label_answer;
                $value->label_question = QuestionsModel::find(AnswerModel::find($value->id_answer)->id_question)->label_question;
            }
        }
        return view('pages.admin.respondent', ['respondents' => $respondents]);
    }
}
