@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('Students_trans.School_fees_adjustment')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('Students_trans.School_fees_adjustment')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{route('Fees.update','test')}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('Students_trans.name_ar')}}  </label>
                                <input type="text" value="{{$Fee->getTranslation('title','ar')}}" name="title_ar" class="form-control">
                                <input type="hidden" value="{{$Fee->id}}" name="id" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4"> {{trans("Students_trans.name_en")}}</label>
                                <input type="text" value="{{$Fee->getTranslation('title','en')}}" name="title_en" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('Students_trans.the_amount')}}</label>
                                <input type="number" value="{{$Fee->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">{{trans("Students_trans.Grade")}} </label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    @foreach($Grades as $Grade)
                                        <option value="{{ $Grade->id }}" {{$Grade->id == $Fee->Grade_id ? 'selected' : ""}}>{{ $Grade->Name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{trans('main_trans.classes')}} </label>
                                <select class="custom-select mr-sm-2" name="Classroom_id">
                                    <option value="{{$Fee->Classroom_id}}">{{$Fee->classroom->Name_Class}}</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{trans('Students_trans.academic_year')}} </label>
                                <select class="custom-select mr-sm-2" name="year">
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" {{$year == $Fee->year ? 'selected' : ' '}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        {{-- </div>
                            <div class="form-group col">
                                <label for="inputZip">{{ trans('Students_trans.Type_of_fees') }}</label>
                                <select class="custom-select mr-sm-2" name="Fee_type">
                                    @foreach ($feeTypes as $type)
                                        <option value="{{ $type->Fee_type }}" {{ $Fee->Fee_type == $type->Fee_type ? 'selected' : '' }}>
                                            {{ $type->Fee_type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}


                        <div class="form-group">
                            <label for="inputAddress">{{trans('Students_trans.comments')}}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                      rows="4">{{$Fee->description}}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{trans('Students_trans.submit')}}</button>

                    </form>

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
