<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespondentsModel extends Model
{
    use HasFactory;
    protected $table = 'respondents';
    protected $primaryKey = "id_respondent";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'status',
        'id_form'
    ];
}
