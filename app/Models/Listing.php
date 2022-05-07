<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        dd($filters);

        if ($filters['tag'] ?? false) { // an einai true tha gyrisei to tag, alliws false
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
    }
}
