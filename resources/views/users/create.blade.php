@extends('master')
@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <form class="card" action="{{route('admin.users.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    <h4 class="card-title">Create users</h4>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Username" aria-label="Username">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" aria-label="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <select class="form-control @error('role_id') is-invalid @enderror" name="role_id">
                                <option value="">Choose role</option>
                                @foreach($roles as $id => $role)
                                    <option value="{{$id}}">{{$role}}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
