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
                                <td>{{$user->id}}</td>
                                <td>{{$user->photo_id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role_id ? $user->role->name :'Users without role'}}</td>
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

