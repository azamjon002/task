@extends('master')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Tasks Table</h4>
                        @can('task_create')
                            <a href="{{route('admin.tasks.create')}}" class="btn btn-info">Create Task</a>
                        @endcan
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>T/r</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tasks as $task)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$task->name}}</td>
                                    <td>
                                        {{$task->description}}
                                    </td>
                                    <td>{{$task->user->name }}</td>
                                    <td>
                                        @can('task_edit')
                                            <a href="{{route('admin.tasks.edit', $task->id)}}">
                                                <span class="badge badge-info">Edit</span>
                                            </a>
                                        @endcan


                                            @can('task_delete')
                                                <form class="d-inline-flex" onclick="confirm('Ishonchingiz komilmi?')" action="{{route('admin.tasks.destroy', $task->id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="badge badge-danger">Delete</button>
                                                </form>
                                            @endcan


                                    </td>
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
