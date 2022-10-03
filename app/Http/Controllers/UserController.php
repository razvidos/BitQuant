<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();
        return new JsonResponse($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::create($validated);
        return new JsonResponse('User created successfully with id ' . $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $user = User::find($id);
        if (is_null($user)) {
            return new JsonResponse('User not found');
        }
        return new JsonResponse($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request, int $id): JsonResponse
    {
        $user = User::find($id);
        if (is_null($user)) {
            return new JsonResponse('User not found');
        }
        $validated = $request->validated();

        if (empty($validated)) {
            return new JsonResponse('Nothing to change');
        }

        $user->update($validated);
        return new JsonResponse('User was change successfully with id ' . $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $user = User::find($id);
        if (is_null($user)) {
            return new JsonResponse('User not found');
        }
        $user->delete();
        return new JsonResponse('User was deleted successfully');
    }
}
