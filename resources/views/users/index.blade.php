@extends('layouts.app')

@section('content')

    <section class="px-4 py-5 w-100" style="max-width: calc(100% - 250px);">
        @if (session('error'))
            <div class="alert alert-danger w-75 mx-auto">
                {{ session('error') }}
            </div>
        @elseif (session('success'))
            <div class="alert alert-success w-75 mx-auto">
                {{ session('success') }}
            </div>
        @endif

        <div class="bands-container d-flex justify-content-center">
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
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td><a href="{{ route('users.show', $user->id) }}"
                                                class="btn btn-info">&#128221;</a></td>
                                        <td><button
                                            data-user-id="{{ $user->id }}"
                                            data-action="{{ route('users.delete', $user->id) }}"
                                            class="btn btn-danger openDeleteModal"
                                            >Delete</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- DELETE MODAL --}}
        <div class="modal fade" id="deleteUserModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form method="POST" id="deleteUserForm">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
