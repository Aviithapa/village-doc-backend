<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiResponser;
use App\Http\Requests\User\AdminUserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\Role;
use App\Services\User\UserCreator;
use App\Services\User\UserGetter;
use App\Services\User\UserUpdater;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    use ApiResponser;

    public function index(Request $request, UserGetter $userGetter)
    {
        return UserResource::collection($userGetter->getPaginatedList($request));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.pages.user.create', compact('roles'));
    }


    public function store(AdminUserCreateRequest $request, UserCreator $userCreator)
    {

        $data = $request->all();
        return $userCreator->store($data);
    }

    public function edit($id)
    {
        // $this->authorize('edit', $this->userRepository->getModel());
        // $user = $this->userRepository->findById($id);
        // $roles = Role::all();
        // return view('admin.pages.user.edit', compact('user', 'roles'));
    }

    public function show(UserGetter $userGetter, $id)
    {
        return $userGetter->show($id);
    }

    public function destroy(UserUpdater $userUpdater, $id)
    {
        return $userUpdater->delete($id);
    }

    public function update(UserUpdateRequest $userUpdateRequest, $id)
    {
        // $this->authorize('update', $this->userRepository->getModel());
        // $data = $userUpdateRequest->all();
        // try {
        //     $role = Role::where('name', $data['role'])->first();
        //     $user = $this->userRepository->update($data, $id);
        //     if ($user == false) {
        //         session()->flash('danger', 'Oops! Something went wrong.');
        //         return redirect()->back()->withInput();
        //     }
        //     $user->roles()->sync([$role->id]);
        //     session()->flash('success', 'Account has been updated successfully.');
        //     return redirect()->route('dashboard.user.index');
        // } catch (Exception $e) {
        //     session()->flash('danger', 'Oops! Something went wrong.');
        //     return redirect()->back()->withInput();
        // }
    }
}
