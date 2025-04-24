<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bands extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'genre_id',
        'formation_year',
        'description',
        'image_url',
    ];

    // A band belongs to a genre
    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    // Favorites: a band can be favorited by many users
    public function favoritedByUsers() {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function isFavoritedBy(User $user) {
        return $user->favoriteBands()->where('band_id', $this->id)->exists();
    }
}
