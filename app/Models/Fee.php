<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasTranslations;
    use HasFactory;

    public $translatable = ['title'];
    protected $fillable=['title','amount','Grade_id','Classroom_id','year','description','Fee_type'];

    public function grade(){
        return $this->belongsTo('App\Models\Grade','Grade_id');

    }

    public function classroom(){
        return $this->belongsTo('App\Models\classroom','Classroom_id');

    }
}
