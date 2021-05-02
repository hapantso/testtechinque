<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsModel extends Model
{
    use HasFactory;
    protected $table = 'questions';
    protected $primaryKey = "id_question";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'label_question',
        'type',
        'id_form_page'
    ];
}
