<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::all();

        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Recipe::create(array_merge(
            $request->validate(Recipe::rules()),
            ['creator_id' => Auth::user()->id],
            ['photo' => $this->getPhoto($request)]
        ));


        return redirect(route('recipes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        $recipe->update(array_merge(
            $request->validate(Recipe::rules()),
        ));

        if ($request->has('photo')) {
            $recipe->update(['photo' => $this->getPhoto($request)]);
        }

        return redirect(route('recipes.edit', $recipe))->with('status', 'The recipe has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect(route('recipes.index'))->with('status', 'The recipe has been successfully deleted');
    }

    /**
     * Saves the image to the public/uploads and
     * returns the name of the file
     *
     * @param Request $request
     * @return string
     */
    private function getPhoto(Request $request): string
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Get the uploaded file
        $photo = $request->file('photo');

        // Generate a unique name for the file
        $fileName = time() . '_' . $photo->getClientOriginalName();

        // Move the uploaded file to the desired location
        $photo->move(public_path('uploads'), $fileName);

        return $fileName;
    }
}
