@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.List_of_tests')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{trans('main_trans.List_of_tests')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('quizzes.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('main_trans.Add_a_new_test')}} </a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('main_trans.Test_name')}} </th>
                                            <th>{{trans('main_trans.The_name_of_the_teacher')}} </th>
                                            <th>{{trans('main_trans.Educational_level')}} </th>
                                            <th>{{trans('main_trans.Classroom')}} </th>
                                            <th>{{trans('main_trans.Section')}} </th>
                                            <th>{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quizz)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$quizz->name}}</td>
                                            <td>{{$quizz->teacher->Name}}</td>
                                            <td>{{$quizz->grade->Name}}</td>
                                            <td>{{$quizz->classroom->Name_Class}}</td>
                                            <td>{{$quizz->section->Name_Section}}</td>

                                                <td>
                                                    <a href="{{route('quizzes.edit',$quizz->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#delete_exam{{ $quizz->id }}" title="حذف"><i
                                                    class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>


                                         @include('pages.Quizzes.Delete')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
