<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\User;
use App\Models\Bands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

        $user = Auth::user();
        $bands = $query->paginate(6);
        $genres = Genre::all();

        return view('bands.index', compact('bands', 'genres', 'user'));
    }

        public function showBand($bandId) {
            $band = Bands::findOrFail($bandId);
            $user = Auth::user();
            $genres = Genre::all();

            $imagePath = $band->image ? Storage::url($band->image) : null;

            $genreName = $band->genre->name;

            return view('bands.show_band', compact('band', 'genreName', 'user', 'genres', 'imagePath'));
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
                'singer' => 'nullable|string|max:255',
                'backing_vocals' => 'nullable|string|max:255',
                'rythm_guitarist' => 'nullable|string|max:255',
                'lead_guitarist' => 'nullable|string|max:255',
                'bassist' => 'nullable|string|max:255',
                'drummer' => 'nullable|string|max:255',
                'percussionist' => 'nullable|string|max:255',
                'keyboardist' => 'nullable|string|max:255',
                'dj' => 'nullable|string|max:255',
                'best_selled_album' => 'nullable|string|max:255',
                'image' => 'required|image'
            ]);

            $image = null;

            if ($request->hasFile('image')) {
                $image = Storage::putFile('bandPhotos', $request->file('image'));
            }

            Bands::insert([
                'name' => $request->name,
                'genre_id' => $request->genre_id,
                'formation_year' => $request->formation_year,
                'description' => $request->description,
                'singer' => $request->singer ?? null,
                'backing_vocals' => $request->backing_vocals ?? null,
                'rythm_guitarist' => $request->rythm_guitarist ?? null,
                'lead_guitarist' => $request->lead_guitarist ?? null,
                'bassist' => $request->bassist ?? null,
                'drummer' => $request->drummer ?? null,
                'percussionist' => $request->percussionist ?? null,
                'keyboardist' => $request->keyboardist ?? null,
                'dj' => $request->dj ?? null,
                'best_selled_album' => $request->best_selled_album ?? null,
                'image' => $image
            ]);

            return redirect()->back()->with('success', 'Band added successfully!');
        }

        public function updateBand(Request $request, $bandId) {
            $request->validate([
                'name' => 'required|string|max:255',
                'genre_id' => 'required|exists:genres,id',
                'formation_year' => 'required|integer|min:1900|max:' . date('Y'),
                'description' => 'required|string|max:3000',
                'singer' => 'nullable|string|max:255',
                'backing_vocals' => 'nullable|string|max:255',
                'rythm_guitarist' => 'nullable|string|max:255',
                'lead_guitarist' => 'nullable|string|max:255',
                'bassist' => 'nullable|string|max:255',
                'drummer' => 'nullable|string|max:255',
                'percussionist' => 'nullable|string|max:255',
                'keyboardist' => 'nullable|string|max:255',
                'dj' => 'nullable|string|max:255',
                'best_selled_album' => 'nullable|string|max:255',
                'image' => 'required|image'
            ]);

            $image = null;

            if ($request->hasFile('image')) {
                $image = Storage::putFile('bandPhotos', $request->file('image'));
            }

            Bands::where('id', $bandId)->update([
                'name' => $request->name,
                'genre_id' => $request->genre_id,
                'formation_year' => $request->formation_year,
                'description' => $request->description,
                'singer' => $request->singer ?? null,
                'backing_vocals' => $request->backing_vocals ?? null,
                'rythm_guitarist' => $request->rythm_guitarist ?? null,
                'lead_guitarist' => $request->lead_guitarist ?? null,
                'bassist' => $request->bassist ?? null,
                'drummer' => $request->drummer ?? null,
                'percussionist' => $request->percussionist ?? null,
                'keyboardist' => $request->keyboardist ?? null,
                'dj' => $request->dj ?? null,
                'best_selled_album' => $request->best_selled_album ?? null,
                'image' => $image
            ]);

            return redirect()->back()->with('success', "Band updated successfully!");
        }

        public function deleteBand($bandId) {
            Bands::where('id', $bandId)->delete();

            return redirect()->back()->with('success', "Band deleted successfully!");
        }
}
