<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Grids\UsersGridInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UsersGridInterface $usersGrid
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(UsersGridInterface $usersGrid, Request $request)
    {
        // the 'query' argument needs to be an instance of the eloquent query builder
        // you can load relationships at this point
        return $usersGrid
            ->create([
                'query' => User::query(),
                'request' => $request
            ])
            ->renderOn('users.index'); // render the grid on the welcome view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function create(Request $request)
    {
        $roles = Role::all();
        $modal = [
            'model' => class_basename(User::class),
            'route' => route('users.store'),
            'action' => 'create',
            'pjaxContainer' => $request->get('ref'),
        ];

        return view('users.user_modal', compact('modal', 'roles'))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4|max:50',
            'email' => 'required|email|unique:Users',
            'password' => 'required|min:3|max:30',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required',
        ]);

        $user = new User;
        if ($request->hasFile('avatar')) {
            $user->avatar = $request->avatar;
        } else {
            $user->avatar = "";
        }

        if(!$request->role_id) {
            // $user->role_id = Role::query()->select('id')->get()->random()->id;
        } else {
            $user->role_id = $request->role_id;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return new JsonResponse([
            'success' => true,
            'message' => 'User with id ' . $user->name . ' has been created.'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function show($id, Request $request)
    {
        $user = User::query()->findOrFail($id);

        $modal = [
            'model' => class_basename(User::class),
            'route' => route('users.update', $user->id),
            'pjaxContainer' => $request->get('ref'),
            'method' => 'patch',
            'action' => 'update'
        ];

        return view('users.user_modal', compact('modal', 'user'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:Users,id,' . $id,

        ]);

        $status = User::query()->findOrFail($id)->update($request->all());

        if ($status) {
            return new JsonResponse([
                'success' => true,
                'message' => 'Update User successfully.'
            ]);
        }

        return new JsonResponse(['success' => false], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return JsonResponse|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $status = User::query()->findOrFail($id)->delete();

        return new JsonResponse([
            'success' => $status,
            'message' => 'Delete User successfully.'
        ]);
    }
}
