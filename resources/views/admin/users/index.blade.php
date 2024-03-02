@extends('layouts.admin')
@section('title')
    Users
@endsection
@section('cards')
@endsection
@section('charts')
@endsection
@section('content')
    <div class="container-fluid px-4">
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
                    </tr>
                    </tfoot>
                    <tbody>
                    @if($users)
                        @foreach($users as $user)
                            <tr>
                                <td><a href="{{route('users.edit', $user->id)}}">{{$user->id}}</a></td>
                                <td>
                                    <img class="rounded-circle border border-3 border-primary p-1" width="62" height="62" src="{{ $user->photo ?  asset('assets/img/users/' .
                                    $user->photo->file): 'http://placehold.it/62x62'}}" alt="{{$user->name}}">
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
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


