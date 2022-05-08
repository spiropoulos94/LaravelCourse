<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // show all listings
    public function index()
    {

        // sto request helper apo katw pernas string an theleis na soy gyrisei ena pragma apo to request kai array an theleis na pareis polla

        // px request('tag') gia na pareis to value tou tag
        // px request(['tag', 'name']) gia na pareis ena array pou tha exei mesa [ tag=>'', name=>'' ]
        dd(request('tag'));

        return view('listings.index', [
            "heading" => "Latest Listings",
            "listings" => Listing::latest()->filter(request(['tag']))->get(),
        ]);
    }


    // show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            "listing" => $listing,
        ]);
    }
}
