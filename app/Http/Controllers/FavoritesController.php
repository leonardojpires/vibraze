<?php

namespace App\Http\Controllers;

use App\Models\Bands;
use App\Models\User;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function favoriteBandsView() {
        $user = User::find(1);
        $bands = $user->favoriteBands()->paginate(10);

        return view('favorites.index', compact('bands', 'user'));
    }

    public function favoriteBands(Request $request, $bandId) {
        $band = Bands::findOrFail($bandId); # Find the band by its ID

        $user = User::find(1);

        if ($user->favoriteBands()->where('band_id', $bandId)->exists()) {
            return redirect()->back()->with('error', 'You have already favorited this band!');
        }

        $user->favoriteBands()->attach($bandId);

        return redirect()->back()->with('success', 'Band favorited sucessfully!');
    }

    public function removeFavorites(Request $request, $bandId) {
        $user = User::find(1);
        $band = Bands::findOrFail($bandId);

        if ($user->favoriteBands()->where('band_id', $bandId)->exists()) {
            $user->favoriteBands()->detach($bandId);

            return redirect()->back()->with('success', 'Band removed from favorites sucessfully!');
        } else {
            return redirect()->back()->with('error', 'Band not found in your favorites!');
        }
    }
}
