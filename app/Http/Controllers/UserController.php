<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('UserIndex', [
            'users' => User::withCount(['images', 'files'])->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('UserCreate');
    }

    public function store(Request $request)
    {
        $attrs = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8']
        ]);

        User::create([
            'name' => $attrs['name'],
            'email' => $attrs['email'],
            'password' => Hash::make($attrs['password']),
        ]);

        return to_route('users.index');
    }

    public function edit(User $user)
    {
        return Inertia::render('UserCreate', compact('user'));
    }

    public function show()
    {

    }

    public function update(Request $request, User $user)
    {
        $attrs = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', "unique:users,email,$user->email,email"],
            'password' => ['nullable', 'string', 'min:8']
        ]);

        $user->fill(Arr::except($attrs, 'password'));

        if (isset($attrs['password'])) {
            $user->password = Hash::make($attrs['password']);
        }

        $user->save();

        return to_route('users.index');
    }
}
