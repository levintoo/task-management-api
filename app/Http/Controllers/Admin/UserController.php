<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Admin\UserQueryRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use App\Services\UserQuery;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserQueryRequest $request)
    {
        $users = UserQuery::apply($request)->paginate(10);

        return UserResource::collection($users)->additional([
            'meta' => [
                'filters' => $request->only(['search', 'field', 'direction']),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->noContent();
    }
}
