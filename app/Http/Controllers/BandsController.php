<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\User;
use App\Models\Bands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BandsController extends Controller
{
    public function listBands(Request $request) {

        $query = Bands::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('genres') && !empty($request->genres)) {
            $query->whereIn('genre_id', $request->genres);
        }

        $user = User::find(1);
        $bands = $query->paginate(6);
        $genres = Genre::all();

        return view('bands.index', compact('bands', 'genres', 'user'));
    }

        public function showBand($bandId) {
            $band = Bands::findOrFail($bandId);
            $user = Auth::user();

            $genreName = $band->genre->name;

            return view('bands.show_band', compact('band', 'genreName', 'user'));
        }


        public function addBandView() {
            $genres = Genre::all();

            return view('bands.add_bands', compact('genres'));
        }

        public function storeBand(Request $request) {
            $request->validate([
                'name' => 'required|string|max:255',
                'genre_id' => 'required|exists:genres,id',
                'formation_year' => 'required|integer|min:1900|max:' . date('Y'),
                'description' => 'required|string|max:3000',
                'image_url' => 'required|string'
            ]);

            Bands::insert([
                'name' => $request->name,
                'genre_id' => $request->genre_id,
                'formation_year' => $request->formation_year,
                'description' => $request->description,
                'image_url' => $request->image_url,
            ]);

            return redirect()->back()->with('success', 'Band added successfully!');
        }
}
