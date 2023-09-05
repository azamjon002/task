<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UsersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new UserResource(User::with('roles')->get());
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'name'=>'required',
            'password'=>'required',
            'role_id'=>'required',
        ]);
        $id = User::orderBy('id', 'desc')->first()->id;

        $user = User::create([
            'id'=>$id+1,
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
        ]);

        $user->roles()->sync($request->input('role_id', []));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource($user->load(['roles']));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required',
            'password'=>'required',
            'role_id'=>'required',
        ]);
        $user->update([
           'name'=>$request->name,
           'password'=>bcrypt($request->password)
        ]);
        $user->roles()->sync($request->input('role_id', []));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
