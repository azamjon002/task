@extends('master')
@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <form class="card" action="{{route('admin.tasks.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    <h4 class="card-title">Create task</h4>
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
                            <textarea type="text" rows="10" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description" ></textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-group">
                            <select class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                                <option value="">Choose a user</option>
                                @foreach($users as $id => $user)
                                    <option value="{{$id}}">{{$user}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
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
