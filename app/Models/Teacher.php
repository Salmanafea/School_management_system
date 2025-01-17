<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Section;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];
    protected $guarded=[];


        // علاقة بين المعلمين والتخصصات لجلب اسم التخصص
        public function specializations()
        {
            return $this->belongsTo('App\Models\Specialization', 'Specialization_id');
        }

        // علاقة بين المعلمين والانواع لجلب جنس المعلم
        public function genders()
        {
            return $this->belongsTo('App\Models\Gender', 'Gender_id');
        }

// علاقة المعلمين مع الاقسام
public function sections(): BelongsToMany
{
    return $this->belongsToMany('App\Models\Section', 'teacher_section');
}




}
