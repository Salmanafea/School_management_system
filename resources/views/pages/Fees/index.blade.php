@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.study_fees')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.study_fees')}}
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
                                <a href="{{route('Fees.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('main_trans.Add_tuition_fees')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class='alert-success'>
                                            <th>#</th>
                                            <th>{{trans('Students_trans.Name')}}</th>
                                            <th>{{trans('Students_trans.the_amount')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.academic_year')}}</th>
                                            <th>{{trans('Students_trans.comments')}}</th>
                                            <th>{{trans('Students_trans.Processes')}}</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Fees as $Fee)
                                            <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$Fee->title}}</td>
                                            <td>{{ number_format($Fee->amount, 2) }}</td>
                                            <td>{{$Fee->grade->Name}}</td>
                                            <td>{{$Fee->classroom->Name_Class}}</td>
                                            <td>{{$Fee->year}}</td>
                                            <td>{{$Fee->description}}</td>


                                                <td>
                                                    <a href="{{route('Fees.edit',$Fee->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee{{ $Fee->id }}" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                    <a href="#" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="far fa-eye"></i></a>


                                                </td>
                                            </tr>
                                            @include('pages.Fees.Delete')

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
