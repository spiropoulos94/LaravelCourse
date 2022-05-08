<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    public function scopeFilter($query,  $filters)
    {
        if ($filters['tag'] ?? false) { // an einai true tha gyrisei to tag, alliws false
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($filters['search'] ?? false) { // an einai true tha gyrisei to tag, alliws false
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // public function scopeSearch($query, $searchParam)
    // {
    //     if ($searchParam) {
    //         $query->where('title', 'like', '%' . $searchParam . '%');
    //     }
    // }
}
