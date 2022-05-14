<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class ListingController extends Controller
{
    // show all listings
    public function index()
    {

        // sto request helper apo katw pernas string an theleis na soy gyrisei ena pragma apo to request kai array an theleis na pareis polla

        // px request('tag') gia na pareis to value tou tag
        // px request(['tag', 'name']) gia na pareis ena array pou tha exei mesa [ tag=>'', name=>'' ]
        // dd(request(412421));
        // dd(request(['tag', 'search'],));

        return view('listings.index', [
            "heading" => "Latest Listings",
            "listings" => Listing::latest()
                // ->search(request('search'))
                ->filter(request(['tag', 'search']))
                // ->get(),
                ->paginate(2), // xwris params ta gyrnaei ola ta listings
        ]);
    }


    // show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            "listing" => $listing,
        ]);
    }

    // show create form
    public function create()
    {
        return view('listings.create');
    }

    // store listing data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique("listings", 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        // dd($formFields);

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully');
    }

    // show edit form
    public function edit(Listing $listing)
    {
        return view('listings.edit', [
            "listing" => $listing,
        ]);
    }

    // Update listing
    public function update(Request $request, Listing $listing)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }


        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect('/')->with('message', 'Listing deleted successfully');
    }
}
