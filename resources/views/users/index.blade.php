@extends('layouts.app')

@section('content')

<main class="ms-auto px-4 py-5 w-100" style="max-width: calc(100% - 250px);">
    @if (session('error'))
        <div class="alert alert-danger w-75 mx-auto">
            {{ session('error') }}
        </div>
    @elseif (session('success'))
        <div class="alert alert-success w-75 mx-auto">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-center">
        <div class="card border-success shadow w-100" style="max-width: 1000px;">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">User List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-success">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Created At</th>
                                <th>Role</th>
                                <th colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->role}}</td>
                                    <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-info" >Show</a></td>
                                    <td><a href="{{ route('users.delete', $user->id) }}" class="btn btn-danger" >Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
