<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                "email" => "Your provided credentials is incorrect."
            ]);
        }

        session()->regenerate();

        return redirect('/')->with('success', 'Welcome Back!');
    }
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }

    public function show(User $user)
    {
        return view('sessions.show', [
            'user' => $user,
            'posts' => Post::where('user_id', $user->id)->latest()->paginate(3)->withQueryString()
        ]);
    }

    public function editProfile(User $user)
    {
        return view('sessions.edit', [
            'user' => $user
        ]);
    }

    public function editPassword(User $user)
    {
        return view('sessions.password-update', [
            'user' => $user
        ]);
    }

    public function update(User $user)
    {
        if (request()->filled('password')) {
            return $this->updatePassword($user);
        } else {
            return $this->updateProfile($user);
        }
    }

    protected function updateProfile(User $user)
    {
        // Validate profile update request data
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => ['required', Rule::unique('users', 'username')->ignore($user)],
            'email' => ['required', Rule::unique('users', 'email')->ignore($user)],
            'image' => $user->exists ? ['image'] : ['required', 'image'],
        ]);

        // Update profile information (name, username, email, avatar)
        if (request()->hasFile('image')) {
            $attributes['image'] = request()->file('image')->store('profile');
        }
        $user->update($attributes);

        return redirect('/')->with('success', 'Profile updated!');
    }

    protected function updatePassword(User $user)
    {
        // Validate password update request data
        request()->validate([
            'password' => 'required|min:8', // Add any additional password validation rules here
        ]);

        // Update the password
        $user->password = bcrypt(request('password'));
        $user->save();

        return redirect('/')->with('success', 'Password updated!');
    }
}
