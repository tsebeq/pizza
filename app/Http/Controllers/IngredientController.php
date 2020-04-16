<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($data = [])
    {
        return view('ingredient', array_merge([
            'ingredients' => (new Ingredient)->get()
        ], $data));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'cost' => 'required|numeric',
        ]);

        Log::debug('Amount of '.$request->name, [Ingredient::where('name', $request->name)->count()]);
        if($same = Ingredient::withTrashed()->where('name', $request->name)->first()) {
            $same->update(['cost' => $request->cost*100]);
            if ($same->trashed()) {
                $same->restore();
            }
            return redirect('ingredient')->withErrors([$same->name . ' updated']);
            //return Ingredient::withTrashed()->where('name', $request->name)->update(['cost' => $request->cost*100])->restore();
        } else {
            $curent = Ingredient::create([
                'name' => $request->name,
                'cost' => $request->cost*100
            ]);
            return redirect('ingredient')->withErrors([$current->name . ' added']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    public function edit($name)
    {
        $current = Ingredient::where('name', $name)->first();
        $preset = [
            'preset' => [
                'name' => $current->name,
                'cost' => $current->cost
            ]
        ];
        return $this->index($preset);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        //
    }

    public function remove($id)
    {
        Log::debug('Ingredient no '.$id, [var_export(Ingredient::find($id), 1)]);
        if($ingredient = Ingredient::find($id)) {
            $msg = $ingredient->name . ' removed from ingredients';
            $ingredient->delete();
            return redirect('ingredient')->withErrors([$msg]);
        }
    }
}
