@extends('layouts.app')
@section('content')
    <div class="row mt-3">
        <div class="col-lg-4 offset-lg-4 shadow-lg p-3 mb-5 bg-white rounded">
            @if(session('status'))
               <x-alert></x-alert>
                <a href="/" class="btn btn-dark">Home</a>
            @endif
            <h1 class="text-left fs-4">Contactformulier</h1>
            <form action="{{action('App\Http\Controllers\ContactController@store')}}" method="POST">
                @csrf
                @method('POST')
                <div class="form-floating mb-3">
                    <input type="text" name="name" type="text" class="form-control" placeholder="Name">
                    <label for="">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" type="text" class="form-control" placeholder="E-mail">
                    <label for="">E-mail</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="message" class="form-control" placeholder="leave a comment" style="height:180px"></textarea>
                    <label for="">Comments</label>
                </div>
                <button type="submit" class="btn btn-dark d-flex justify-content-end">SUBMIT</button>
            </form>
        </div>
    </div>
@endsection
