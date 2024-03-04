@extends('layouts.admin')
@section('title')
    Edit User
@endsection
@section('cards')
@endsection
@section('charts')
@endsection
@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            @include('layouts.includes.form_error')
            <div class="col-8 img-thumbnail">
                {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminUsersController@update',$user->id],'files'=>true]) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name',$user->name,['class'=>'form-control']) !!}
                    @error('name')
                        <p class="text-danger fs-6">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'E-mail:') !!}
                    {!! Form::text('email',$user->email,['class'=>'form-control']) !!}
                    @error('email')
                    <p class="text-danger fs-6">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('Select roles:(hou de ctl toets ingedrukt om meerdere te selecteren') !!}
                    {!! Form::select('roles[]',$roles,$user->roles->pluck('id')->toArray(),['class'=>'form-control','multiple'=>'multiple']) !!}
                    @error('roles')
                    <p class="text-danger fs-6">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('Select status:') !!}
                    {!! Form::select('is_active',array([1=>'Active',0=>'Not Active']),$user->is_active,['class'=>'form-control']) !!}
                    @error('is_active')
                    <p class="text-danger fs-6">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password:') !!}
                    {!! Form::password('password',['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('photo_id', 'Image:') !!}
                    {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group d-flex justify-content-end">
                    <div class="me-1">
                        {!! Form::submit('Update User',['class'=>'btn btn-warning'])!!}
                        {!! Form::close() !!}
                    </div>
                    <div>
                        {!! Form::open(['method'=>'DELETE','action'=>['App\Http\Controllers\AdminUsersController@destroy',$user->id]]) !!}
                        {{Form::submit('Delete User',['class'=>'btn btn-danger'])}}
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
            <div class="col-4">
                <img class="img-fluid img-thumbnail" src="{{$user->photo ? asset('assets/img/users/' .
                                    $user->photo->file) : 'http://placehold.it/400x400'}}" alt="{{$user->name}}">
            </div>
        </div>


    </div>
@endsection
