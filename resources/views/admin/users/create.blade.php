@extends('layouts.admin')
@section('title')
    Create User
@endsection
@section('graph')
@endsection
@section('content')
    <div class="container-fluid px-4">
        {!! Form::open(['method'=>'POST', 'action'=>'App\Http\Controllers\AdminUsersController@store','files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'E-mail:') !!}
            {!! Form::text('email',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Select roles:(hou de ctl toets ingedrukt om meerdere te selecteren') !!}
            {!! Form::select('roles[]',$roles,null,['class'=>'form-control','multiple'=>'multiple']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Select status:') !!}
            {!! Form::select('is_active',array([1=>'Active',0=>'Not Active']),0,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password',['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id', 'Image:') !!}
            {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create User',['class'=>'btn btn-primary'])!!}
        </div>
        {!! Form::close() !!}
        @include('partials.form_error')
    </div>
@endsection
