<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    const DEFAULT_PAGE = 1;
    const DEFAULT_LIMIT = 2;

    public function index(Request $request)
    {
        $page = $request->query('page', UserController::DEFAULT_PAGE);
        $limit = $request->query('limit', UserController::DEFAULT_LIMIT);

        $skip = ($page - 1) * $limit;

        // For task eager loading only
        $users = User::with('products')->orderByDesc('id')->skip($skip)->take($limit)->get();

        return view('users', [
            'users' => $users,
        ]);
    }

    public function find(int $id) {
        return DB::table('users')->find($id, [
            'id',
            'email',
            'username',
            'is_admin',
            'is_active',
            'first_name',
            'last_name',
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $vBody = $request->validated();
        $vBody["password"] = Hash::make($vBody["password"]);

        $id = DB::table('users')->insertGetId([
            ...$vBody,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $this->find($id);
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $vBody = $request->validated();
        if (isset($vBody["password"])) {
            $vBody["password"] = Hash::make($vBody["password"]);
        }
        $values = [
            ...$vBody,
            'updated_at' => now(),
        ];

        if (isset($request->password)) {
            $values['password'] = $request->password;
        }

        DB::table('users')->where('id', '=', $id)->update($values);

        return $this->find($id);
    }

    public function destroy(int $id)
    {
        DB::table('users')->delete($id);
    }
}
