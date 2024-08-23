<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Place;
use Illuminate\Http\Request;

class placeController extends Controller
{

    public function index()
    {
        $places = Place::paginate(12);

        // ارسال داده‌ها به ویو
        return view('index', compact('places'));
    }

    public function addview()
    {
        return view('addplace');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'phone' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'photo' => 'required|image|max:2048',
        ]);

        // ایجاد رکورد Place
        $place = Place::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'phone' => $request->phone,
            'instagram' => $request->instagram,
        ]);

        // ذخیره عکس در پوشه public/photos
        $path = $request->file('photo')->move(public_path('photos'), time() . '_' . $request->file('photo')->getClientOriginalName());

        // ایجاد رکورد Photo
        Photo::create([
            'path' => 'photos/' . basename($path),
            'place_id' => $place->id,
        ]);

        // برگشت به فرم با پیام موفقیت
        return back()->with('success', 'Place and Photo uploaded successfully');

    }

    public function view(Request $request, $id)
    {
        $place = Place::with('photos')->findOrFail($id);

        // ارسال داده‌ها به ویو
        return view('view', compact('place'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search'); // Assuming you're passing 'search' via a form input
        $places = Place::where('country', 'like', '%' . $searchTerm . '%')
            ->orWhere('address', 'like', '%' . $searchTerm . '%')
            ->orWhere('name', 'like', '%' . $searchTerm . '%')
            ->orWhere('city', 'like', '%' . $searchTerm . '%')
            ->paginate(12);
        return view('index', compact('places'));
    }

}
