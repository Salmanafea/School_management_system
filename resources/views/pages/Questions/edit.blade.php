@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{trans('Students_trans.Edit_question')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.Edit_question')}} :<span class="text-danger">{{$question->title}}</span>
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route('questions.update','test') }}" method="post" autocomplete="off">
                                @method('PUT')
                                @csrf

                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{trans('Students_trans.Question_name_in_Arabic')}} </label>
                                        <input type="text" name="title_ar" value='{{$question->gettranslation('title','ar')}}' id="input-name" class="form-control" autofocus>
                                        <input type="hidden" name="id" value="{{$question->id}}">
                                    </div>

                                    <div class="col">
                                        <label for="title">{{trans('Students_trans.Question_name_in_English')}} </label>
                                        <input type="text" name="title_en" id="input-name"value='{{$question->gettranslation('title','en')}}' class="form-control"autofocus>
                                    </div>
                                </div>
                                <br>




                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Students_trans.the_answers')}}</label>
                                        <textarea name="answer" class="form-control" id="exampleFormControlTextarea1"
                                                  rows="4">{{$question->answer}}</textarea>
                                    </div>
                                </div>
                                <br>


                                <div class="form-row">
                                    <div class="col">
                                        <label for="title"> {{trans('Students_trans.The_correct_answer')}}</label>
                                        <input type="text" name="right_answer" id="input-name"
                                               class="form-control form-control-alternative" value={{$question->right_answer}} autofocus>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('Students_trans.Test_name')}}  : <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="quizze_id">
                                                <option selected disabled>{{trans('Students_trans.Select_the_test_name')}}  ...</option>
                                                @foreach($quizzes as $quizze)
                                                    <option value="{{ $quizze->id }}"{{$quizze->id==$question->quizze_id?"selected":""}}>{{ $quizze->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('Students_trans.Class')}}  : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="score" >
                                                <option selected disabled> {{trans("Students_trans.Select_the_grade")}} ...</option>
                                                <option value="5"{{$question->score==5?"selected":""}}>5</option>
                                                <option value="10" {{$question->score==10?"selected":""}}>10</option>
                                                <option value="15" {{$question->score==15?"selected":""}}>15</option>
                                                <option value="20" {{$question->score==20?"selected":""}}>20</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('main_trans.saving_data')}} </button>
                            </form>
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
