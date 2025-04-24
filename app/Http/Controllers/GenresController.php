<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    public function addGenresView() {
        $genres = Genre::all();

        return view('genres.add_genres', compact('genres'));
    }

    public function storeGenre(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Genre::insert([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Genre added successfully!');
    }
}
