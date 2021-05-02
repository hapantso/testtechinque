<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HaveModel extends Model
{
    use HasFactory;
    protected $table = 'have';
    protected $primaryKey = "id_have";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id_answer',
        'id_respondent'
    ];
}
