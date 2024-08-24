<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Section extends Model
{
    use HasTranslations;
    public $translatable = ['Name_Section'];

    protected $fillable=['Name_Section','Grade_id','Class_id'];
    protected $table = 'sections';
    public $timestamps = true;

    public function My_Classs()
    {
        return $this->belongsTo('App\Models\Classroom', 'Class_id');
    }
 // علاقة الاقسام مع المعلمين
 public function teachers(): BelongsToMany
 {
     return $this->belongsToMany('App\Models\Teacher', 'teacher_section');
 }
 public function Grades()
 {
     return $this->belongsTo('App\Models\Grade', 'Grade_id');
 }



}
