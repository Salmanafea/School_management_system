<?php

namespace App\Repository;

interface StudentRepositoryInterface{
    //Get Student
  public function Get_Student();

    // Get Add Form Student
    public function Create_Student();
    //show
    public function Show_Student($id);

    // Get classrooms
     public function Get_classrooms($id);

    // //Get Sections
     public function Get_Sections($id);

   //Store_Sections
  public function Store_Student($request);
     //Edit Student
     public function Edit_Student($id);
     //Update Student
     public function Update_Student($request);
     //Delete Student
     public function Delete_Student($request);
     //Upload_attachement
     public function Upload_attachement($request);
     //Download_attachment
    public function  Download_attachment($studentsname,$filename);
    //Delete_attachement
    public function Delete_attachment($request);


}
