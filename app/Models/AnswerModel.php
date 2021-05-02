<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerModel extends Model
{
    use HasFactory;
    protected $table = 'answers';
    protected $primaryKey = "id_answer";
    public $timestamps = true;

    protected $fillable = [
        'label_answer',
        'id_question'
    ];
}
