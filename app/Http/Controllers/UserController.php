<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function addUserView() {
        return view('auth.register');
    }

    public function loginView() {
        return view('auth.login');
    }

    public function listUsers() {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function storeUser(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'User registrated successfully!');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }

    public function login(Request $request)  {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $remember)) {

            // Create a new session ID to prevent an invasor from reusing the old session ID (protects against session fixation attacks)
            $request->session()->regenerate();

            return redirect()->route('home')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials!',
        ]);
    }

    public function showUser(Request $request, $userId) {
        $user = User::with(['favoriteBands', 'favoriteBands.genre'])->find($userId);

        $genreCounts = [];

        foreach ($user->favoriteBands as $band) {
            $genreName = $band->genre->name ?? 'Unknown';

            if (!isset($genreCounts[$genreName])) {
                $genreCounts[$genreName] = 0;
            }

            $genreCounts[$genreName]++;

        }

        arsort($genreCounts);
        $favoriteGenre = array_key_first($genreCounts) ?? 'None';

        return view('users.show_user', compact('user', 'favoriteGenre'));
    }

    public function editUser(Request $request, $userId) {
        $user = User::find($userId);

        return view('users.edit_profile', compact('user'));
    }

    public function updateRole(Request $request, $userId) {
        $request->validate([
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($userId);
        $user->role = $request->role;
        $user->update([
            'role' => $request->role
        ]);

        return redirect()->back()->with('success', 'User role updated successfully!');
    }

    public function updateUser(Request $request, $bandId) {

        $user = User::find($bandId);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string|min:8',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = Storage::putFile('userPhotos', $request->file('image'));
            $user->image = $imagePath;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function deleteUser(Request $request, $userId) {

        if ($userId == Auth::user()->id) {
            return redirect()->back()->with('error', 'You cannot delete yourself!');
        }

        $user = User::find($userId);

        if ($user && $user->role === 'admin') {
            return redirect()->back()->with('error', 'You cannot delete an admin!');
        }

        User::where('id', $userId)->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}
