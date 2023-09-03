@extends('master')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Users Table</h4>
                        <a href="{{route('admin.users.create')}}" class="btn btn-info">Create User</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>T/r</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        @forelse($user->roles as $role)
                                            <label class="badge @if($role->id == 1) badge-primary @elseif($role->id == 2) badge-success @else badge-danger @endif">{{$role->name}}</label>
                                        @empty

                                        @endforelse
                                    </td>
                                    <td>{{$user->created_at ? $user->created_at->format('Y-m-d') :'' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <span class="text-danger text-center">Data not found</span>
                                    </td>
                                </tr>
                            @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
