@extends('layouts.admin')
@section('title')
    Users
@endsection
@section('graph')
@endsection
@section('content')
    <div class="container-fluid px-4">
        @if(session('status'))
            <x-alert/>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Datatable
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Role</th>
                        <th>Active</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Deleted</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Role</th>
                        <th>Active</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Deleted</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @if($users)
                        @foreach($users as $user)
                            <tr>
                                <td><a href="{{route('users.edit', $user->id)}}">{{$user->id}}</a></td>
                                <td>
                                    <img class="rounded-circle border border-3 border-primary p-1" width="62"
                                         height="62"
                                         src="@if ($user->photo && !Str::startsWith($user->photo->file, 'http'))
            {{ asset('assets/img/users/' . $user->photo->file) }}
         @else
            {{ $user->photo->file ?? 'http://placehold.it/62x62' }}
         @endif"
                                         alt="{{ $user->name }}">


                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge rounded-pill text-bg-primary">
                                            {{$role->name}}
                                        </span>
                                    @endforeach
                                </td>
                                <td>{{$user->is_active == 1 ? 'Active':'Not Active'}}</td>
                                <td>{{$user->created_at->diffForHumans()}}</td>
                                <td>{{$user->updated_at->diffForHumans()}}</td>
                                <td>{{$user->deleted_at ? $user->deleted_at->diffForHumans() :''}}</td>
                                <td>
                                    @if($user->deleted_at != null)
                                        <a class="btn btn-warning" href="{{route('admin.userrestore',$user->id)}}">Restore</a>
                                    @else
                                        {!! Form::open(['method'=>'DELETE','action'=>['\App\Http\Controllers\AdminUsersController@destroy',$user->id]]) !!}
                                        {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


