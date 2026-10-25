<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GamesController
{
    public function index()
    {
        $games = Game::all();

        return view('index', compact('games'));
    }

    public function show($game) {
        return view('games.show', compact('game'));
    }

    public function create()
    {
        return view('create');
    }

    public function store($request)
    {
        //validation op de data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|decimal:2',
        ]);

        //info in database zetten
        $game = new Game();
        $game->name = $request->input(key:'name');
        $game->description = $request->input(key:'description');
        $game->price = $request->input(key:'price');
        $game->image_url = 'temp';
        $game->category = 1;
//        $game->user_id = 1;

        $game->save();

        return redirect()->route('games.index');
    }

    public function destroy(string $game)
    {
        $game->delete();

        return redirect()->route('games.index');
    }
}
