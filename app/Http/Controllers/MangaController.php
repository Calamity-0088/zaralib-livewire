<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    public function index()
    {
        $mangas = Manga::all();

        return view('index', compact('mangas'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $manga = Manga::create([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'author' => $request->author,
            'genre' => $request->genre,
            'volumes' => $request->volumes,
            'chapters' => $request->chapters,
            'status' => $request->status,
            'rating' => $request->rating,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'cover_image' => $request->cover_image,
        ]);

        return redirect()->route('mangas.show', $manga->id);
    }

    public function show($id)
    {
        $manga = Manga::findOrFail($id);

        return view('show', compact('manga'));
    }

    public function edit($id)
    {
        $manga = Manga::findOrFail($id);

        return view('edit', compact('manga'));
    }

    public function update(Request $request, $id)
    {
        $manga = Manga::findOrFail($id);

        $manga->update([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'author' => $request->author,
            'genre' => $request->genre,
            'volumes' => $request->volumes,
            'chapters' => $request->chapters,
            'status' => $request->status,
            'rating' => $request->rating,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'cover_image' => $request->cover_image,
        ]);

        return redirect()->route('mangas.show', $manga->id);
    }

    public function destroy($id)
    {
        $manga = Manga::findOrFail($id);
        $manga->delete();

        return redirect()->route('mangas.index');
    }

    public function setLocale($locale)
    {
        session(['locale' => $locale]);

        return redirect()->back();
    }
}
