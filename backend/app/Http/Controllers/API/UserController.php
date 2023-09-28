<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use Essa\APIToolKit\Api\ApiResponse;

class UserController extends Controller
{
    use ApiResponse;

    public function __construct()
    {

    }

    public function index(): AnonymousResourceCollection
    {
        $users = User::useFilters()->dynamicPaginate();

        return UserResource::collection($users);
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return $this->responseCreated('User created successfully', new UserResource($user));
    }

    public function show(User $user): JsonResponse
    {
        return $this->responseSuccess(null, new UserResource($user));
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user->update($request->validated());

        return $this->responseSuccess('User updated Successfully', new UserResource($user));
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return $this->responseDeleted();
    }

}
