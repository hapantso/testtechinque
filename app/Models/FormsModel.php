<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormsModel extends Model
{
    use HasFactory;
    protected $table = 'forms';
    protected $primaryKey = "id_form";
    public $timestamps = true;

    protected $fillable = [
        'form_page_number',
        'title'
    ];
}
