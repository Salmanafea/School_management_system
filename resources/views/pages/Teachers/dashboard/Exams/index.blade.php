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
                                <a href="{{route('Exams.create')}}" class="btn btn-success btn-sm" role="button"
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
                                        @foreach($exams as $exam)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$exam->name}}</td>
                                            <td>{{$exam->teacher->Name}}</td>
                                            <td>{{$exam->grade->Name}}</td>
                                            <td>{{$exam->classroom->Name_Class}}</td>
                                            <td>{{$exam->section->Name_Section}}</td>

                                                <td>
                                                    <a href="{{route('Exams.edit',$exam->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#delete_exam{{ $exam->id }}" title="حذف"><i
                                                    class="fa fa-trash"></i></button>
                                                    <a href="{{route('Exams.show',$exam->id)}}" class="btn btn-info btn-sm" role="button"
                                                         aria-pressed="true"><i   class="fa fa-binoculars"></i></a>

                                                      <a href="{{route('student.quizze',$exam->id)}}"
                                                       class="btn btn-primary btn-sm" title="عرض الطلاب المختبرين" role="button" aria-pressed="true"><i
                                                            class="fa fa-street-view"></i></a>

                                                </td>
                                            </tr>


                                            <div class="modal fade" id="delete_exam{{$exam->id}}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                               <div class="modal-dialog" role="document">
                                                   <form action="{{route('Exams.destroy',$exam->id)}}" method="post">
                                                       {{method_field('delete')}}
                                                       {{csrf_field()}}
                                                       <div class="modal-content">
                                                           <div class="modal-header">
                                                               <h5 style="font-family: 'Cairo', sans-serif;"
                                                                   class="modal-title" id="exampleModalLabel">حذف اختبار</h5>
                                                               <button type="button" class="close" data-dismiss="modal"
                                                                       aria-label="Close">
                                                                   <span aria-hidden="true">&times;</span>
                                                               </button>
                                                           </div>
                                                           <div class="modal-body">
                                                               <p> {{ trans('My_Classes_trans.Warning_Grade') }} {{$exam->name}}</p>
                                                               <input type="hidden" name="id" value="{{$exam->id}}">
                                                           </div>
                                                           <div class="modal-footer">
                                                               <div class="modal-footer">
                                                                   <button type="button" class="btn btn-secondary"
                                                                           data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                                   <button type="submit"
                                                                           class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </form>
                                               </div>
                                           </div>



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



