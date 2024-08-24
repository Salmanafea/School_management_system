<!DOCTYPE html>
<html lang="">
@section('title')
{{trans('main_trans.Main_title')}}
@stop
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @include('layouts.head')
    @livewireStyles

</head>

<body style="font-family: 'Cairo', sans-serif">

    <div class="wrapper" style="font-family: 'Cairo', sans-serif">

        <!--=================================
 preloader -->

 <div id="pre-loader">
     <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
 </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title" >
                <div class="row">
                    <div class="col-sm-6" >
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">{{trans('Teacher_trans.Welcome_To ')}} : {{auth()->user()->name}}  </h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- widgets -->
            <div class="row" >
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{trans('main_trans.Number_of_students')}} </p>
                                    <h4>{{\App\Models\Student::count()}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('Students.index')}}" target="_blank"><span class="text-danger">عرض البيانات</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fas fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{trans('main_trans.Number_of_teachers')}} </p>
                                    <h4>{{\App\Models\Teacher::count()}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('Teachers.index')}}" target="_blank"><span class="text-danger">عرض البيانات</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-user-tie highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{trans('main_trans.Number_of_parents')}}  </p>
                                    <h4>{{\App\Models\My_Parent::count()}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('add_parent')}}" target="_blank"><span class="text-danger">عرض البيانات</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fas fa-chalkboard highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{trans('main_trans.Number_of_classes')}}  </p>
                                    <h4>{{\App\Models\Section::count()}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('Sections.index')}}" target="_blank"><span class="text-danger">عرض البيانات</span></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Orders Status widgets-->


            <div class="row">

                <div  style="height: 400px;" class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="tab nav-border" style="position: relative;">
                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block w-100">
                                        <h5 style="font-family: 'Cairo', sans-serif" class="card-title">{{trans('main_trans.Latest_operations_on_the_system')}}   </h5>
                                    </div>
                                    <div class="d-block d-md-flex nav-tabs-custom">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link active show" id="students-tab" data-toggle="tab"
                                                   href="#students" role="tab" aria-controls="students"
                                                   aria-selected="true"> الطلاب</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="teachers-tab" data-toggle="tab" href="#teachers"
                                                   role="tab" aria-controls="teachers" aria-selected="false">{{trans('main_trans.Teachers')}}
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="parents-tab" data-toggle="tab" href="#parents"
                                                   role="tab" aria-controls="parents" aria-selected="false">{{trans('main_trans.Parents')}}
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="fee_invoices-tab" data-toggle="tab" href="#fee_invoices"
                                                   role="tab" aria-controls="fee_invoices" aria-selected="false">{{trans('main_trans.Invoices')}}
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">


                                                    {{--students Table--}}
                                                    <div class="tab-pane fade active show" id="students" role="tabpanel" aria-labelledby="students-tab">
                                                        <div class="table-responsive mt-15">
                                                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                                                <thead>
                                                                <tr  class="table-info text-danger">
                                                                    <th>#</th>
                                                                    <th>{{trans('Students_trans.name')}}</th>
                                                                    <th>{{trans('Students_trans.email')}}</th>
                                                                    <th>{{trans('Students_trans.gender')}}</th>
                                                                    <th>{{trans('Students_trans.Grade')}}</th>
                                                                    <th>{{trans('Students_trans.classrooms')}}</th>
                                                                    <th>{{trans('Students_trans.section')}}</th>
                                                                    <th>{{trans('main_trans.Date_added')}}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @forelse(\App\Models\Student::latest()->take(5)->get() as $student)
                                                                    <tr>
                                                                        <td>{{$loop->iteration}}</td>
                                                                        <td>{{$student->name}}</td>
                                                                        <td>{{$student->email}}</td>
                                                                        <td>{{$student->gender->Name}}</td>
                                                                        <td>{{$student->grade->Name}}</td>
                                                                        <td>{{$student->classroom->Name_Class}}</td>
                                                                        <td>{{$student->section->Name_Section}}</td>
                                                                        <td class="text-success">{{$student->created_at}}</td>
                                                                        @empty
                                                                            <td class="alert-danger" colspan="8">{{trans('main_trans.There_is_no_data')}} </td>
                                                                    </tr>
                                                                @endforelse
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                    {{--teachers Table--}}
                                    <div class="tab-pane fade" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                <tr  class="table-info text-danger">
                                                    <th>#</th>
                                                    <th> {{trans('Teacher_trans.Name_Teacher')}}</th>
                                                    <th>{{trans('Teacher_trans.Gender')}}</th>
                                                    <th>{{trans('Teacher_trans.Joining_Date')}}</th>
                                                    <th>{{trans('Teacher_trans.specialization')}}</th>
                                                    <th>{{trans('main_trans.Date_added')}}</th>
                                                </tr>
                                                </thead>

                                                @forelse(\App\Models\Teacher::latest()->take(5)->get() as $teacher)
                                                    <tbody>
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$teacher->Name}}</td>
                                                        <td>{{$teacher->genders->Name}}</td>
                                                        <td>{{$teacher->Joining_Date}}</td>
                                                        <td>{{$teacher->specializations->Name}}</td>
                                                        <td class="text-success">{{$teacher->created_at}}</td>
                                                        @empty
                                                            <td class="alert-danger" colspan="8">{{trans('main_trans.There_is_no_data')}} </td>
                                                    </tr>
                                                    </tbody>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>

                                            {{--parents Table--}}
                                            <div class="tab-pane fade" id="parents" role="tabpanel" aria-labelledby="parents-tab">
                                                <div class="table-responsive mt-15">
                                                    <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                                        <thead>
                                                        <tr  class="table-info text-danger">
                                                            <th>#</th>
                                                            <th>{{ trans('Parent_trans.Guardian_s_name') }}</th>
                                                            <th>{{ trans('Parent_trans.Email') }}</th>
                                                            <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
                                                            <th>{{ trans('Parent_trans.Phone_Father') }}</th>
                                                            <th>{{trans('main_trans.Date_added')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @forelse(\App\Models\My_Parent::latest()->take(5)->get() as $parent)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$parent->Name_Father}}</td>
                                                                <td>{{$parent->Email}}</td>
                                                                <td>{{$parent->National_ID_Father}}</td>
                                                                <td>{{$parent->Phone_Father}}</td>
                                                                <td class="text-success">{{$parent->created_at}}</td>
                                                                @empty
                                                                    <td class="alert-danger" colspan="8">{{trans('main_trans.There_is_no_data')}}  </td>
                                                            </tr>
                                                        @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>



                                                        {{--sections Table--}}
                                                        <div class="tab-pane fade" id="fee_invoices" role="tabpanel" aria-labelledby="fee_invoices-tab">
                                                            <div class="table-responsive mt-15">
                                                                <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                                                    <thead>
                                                                    <tr  class="table-info text-danger">
                                                                        <th>#</th>
                                                                        <th>{{trans('Sections_trans.Invoice_date')}} </th>
                                                                        <th>{{trans('Students_trans.name')}}</th>
                                                                    <th>{{trans('Students_trans.Grade')}}</th>
                                                                    <th>{{trans('Students_trans.classrooms')}}</th>
                                                                    <th>{{trans('Students_trans.section')}}</th>
                                                                    <th>{{trans('Students_trans.Type_of_fees')}}</th>
                                                                    <th>{{trans('Students_trans.the_amount')}}</th>
                                                                        <th>{{trans('main_trans.Date_added')}}</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @forelse(\App\Models\Fee_invoice::latest()->take(10)->get() as $section)
                                                                        <tr>
                                                                            <td>{{$loop->iteration}}</td>
                                                                            <td>{{$section->invoice_date}}</td>
                                                                            {{-- <td>{{$section->My_classs->Name_Class}}</td> --}}
                                                                            <td>{{ optional($section->My_classs)->Name_Class }}</td>
                                                                            <td class="text-success">{{$section->created_at}}</td>
                                                                        </tr>
                                                                    @empty
                                                                        <tr>
                                                                            <td class="alert-danger" colspan="9">{{trans('main_trans.There_is_no_data')}}  </td>
                                                                        </tr>
                                                                    @endforelse
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <livewire:calendar />

            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')
     @livewireScripts
    {{-- @stack('scripts') --}}

</body>

</html>
