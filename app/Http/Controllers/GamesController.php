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

    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        //validation op de data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        //info in database zetten
        $game = new Game();
        $game->title = $validated['title'];
        $game->description = $validated['description'];
//        $game->image_url = 'temp';
//        $game->category = 1;
//        $game->user_id = 1;

        $game->save();

        return redirect()
            ->route('games.index')
            ->with('success', 'Game added successfully!');
    }

    public function destroy(string $game)
    {
        // Only administrators can delete games
        if (!auth()->user()?->is_admin) {
            abort(403, 'Only administrators can delete games.');
        }

        // Find the game in the database
        $game = Game::findOrFail($game);

        // Delete the game
        $game->delete();

        return redirect()
            ->route('games.index')
            ->with('success', 'Game deleted successfully!');
    }
}
