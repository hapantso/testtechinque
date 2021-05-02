<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPagesModel extends Model
{
    use HasFactory;
    protected $table = 'form_pages';
    protected $primaryKey = "id_form_page";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'form_page_number',
        'id_form'
    ];
}
