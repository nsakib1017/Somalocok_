@extends('layouts.app')

@section('content')

<div class="jumbotron-fluid text-center">

    <h2 class="title">Edit the current show</h2>
    <p>Fill in the required fields</p>
</div>

<div class="container-fluid col-md-10">
        {!! Form::open(['action'=>['MoviesController@update',$movie->id],'method'=>'POST','encType'=>'multipart/form-data']) !!}
        <div class="form-group" style="letter-spacing: 2px">
            <B><h3> {{Form::label('title1','Title')}} </h3></B>
         </div>
        <div class="form-group">
            {{Form::text('title',$movie->name,['class'=>'form-control'])}}
        </div>
        <div class="form-group" style="letter-spacing: 2px">
            <B><h3> {{Form::label('title2','Body')}} </h3></B>
        </div>
         <div class=" form-group">
            {{Form::textArea('body',$movie->desc,['id'=>'article-ckeditor1','class'=>'form-control','placeholder'=>'Body'])}}
        </div>
        <div class="form-group" style="letter-spacing: 2px">
            <B><h3> {{Form::label('title3','Summary')}} </h3></B>
        </div>
        <div class=" form-group">
            {{Form::textArea('body-sum',$movie->plot_summary,['id'=>'article-ckeditor2','class'=>'form-control','placeholder'=>'Plot Summary'])}}
        </div>
        <div class="form-group" style="letter-spacing: 2px">
            <B><h3> {{Form::label('title5','Trailer')}} </h3></B>
        </div>
        <div class=" form-group">
            {{Form::text('url','',['class'=>'form-control','placeholder'=>'URL link'])}}
        </div>
        <div class="form-group" style="letter-spacing: 2px">
            <B><h3> {{Form::label('title6','Upload Poster')}} </h3></B>
        </div>
        <div class="form-group form-control-file">
            {{Form::file('poster')}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Save',['class'=>'btn btn-primary',"style"=>"margin-top: 1%"])}}
    {!! Form::close() !!}
    </div>

@endsection