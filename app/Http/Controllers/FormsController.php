<?php

namespace App\Http\Controllers;

use App\Models\FormsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormsController extends Controller
{
    public function index()
    {
        $forms = FormsModel::all();
        return view('pages.admin.form', ['forms' => $forms]);
    }
    public function save(Request $request)
    {
        $form = FormsModel::create($request->only('title'));
        return redirect(route('questionnaire', $form->id_form));
    }
    public function liste()
    {
        $forms = FormsModel::all();
        return view('pages.admin.listeForm', ['forms' => $forms]);
    }
    public function delete($id_form)
    {
        FormsModel::find($id_form)->delete();
        return back();
    }
}
