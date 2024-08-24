<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Student extends Authenticatable
{
    use SoftDeletes;
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded =[];

public function gender()
{
    return $this->belongsTo('App\Models\Gender', 'gender_id');
}


public function grade()
{
    return $this->belongsTo('App\Models\Grade', 'Grade_id');
}

public function classroom()
{
    return $this->belongsTo('App\Models\Classroom', 'Classroom_id');
}

public function section()
{
    return $this->belongsTo('App\Models\Section','section_id');
}
public function Nationality(){

    return $this->belongsTo('App\Models\Nationalitie','nationalitie_id');

}
public function My_Parent(){
    return $this->belongsTo('App\Models\My_Parent','parent_id');
}

public function images(): MorphMany
{
    return $this->morphMany(Image::class, 'imageable');
}

public function student_account(){
    return $this->hasMany('App\Models\StudentAccount','student_id');
}

public function attendance(){
    return $this->hasMany('App\Models\Attendance','student_id');
}

}
