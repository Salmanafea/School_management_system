<?php

namespace App\Repository;

interface TeacherRepositoryInterface{

    // get all Teachers
    public function getAllTeachers();

    // Getspecialization
    public function Getspecialization();
    // GetGender
    public function GetGender();
      // StoreTeachers
      public function StoreTeachers($request);
      // editTeachers
      public function editTeachers($id);
      //deleteTeacher
      public function DeleteTeacher($request);


}
