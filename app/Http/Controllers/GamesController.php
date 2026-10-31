<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GamesController
{
    public function index(Request $request)
    {
        $categories = [
            'Action',
            'Adventure',
            'Puzzle',
            'Racing',
            'Simulation',
            'Roleplay',
        ];

        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'in:Action,Adventure,Puzzle,Racing,Simulation,Other'],
        ]);

        $games = Game::query()
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->whereLike('title', '%' . $search . '%')
                        ->orWhereLike('description', '%' . $search . '%');
                });
            })
            ->when($filters['category'] ?? null, function ($query, $category) {
                $query->where('category', $category);
            })
            ->latest()
            ->get();

        return view('index', compact('games', 'categories'));
    }

    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    public function create()
    {
        return view('create');
    }

    public function destroy(Game $game)
    {
        // Allow the owner or an admin to delete the game.
        $this->authorizeGameManagement($game);

        // Delete the game.
        $game->delete();

        return redirect()
            ->route('games.index')
            ->with('success', 'Game deleted successfully!');
    }

    private function authorizeGameManagement(Game $game): void
    {
        $user = auth()->user();

        abort_unless(
            $user && (
                $user->is_admin ||
                ($game->user_id !== null && $game->user_id === $user->id)
            ),
            403,
            'Je mag deze game niet aanpassen.'
        );
    }

    public function edit(Game $game)
    {
        $this->authorizeGameManagement($game);

        return view('games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        // Only the game's owner or an admin may edit it.
        $this->authorizeGameManagement($game);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'category' => [
                'required',
                'in:Action,Adventure,Puzzle,Racing,Simulation,Roleplay',
            ],
        ]);

        // Update the title and description.
        $game->title = $validated['title'];
        $game->description = $validated['description'];
        $game->category = $validated['category'];


        // Replace the image only if a new one was uploaded.
        if ($request->hasFile('image')) {
            // Store the new image in storage/app/public/games.
            $newImage = $request->file('image')->store('games', 'public');

            // Remove the previous image if one exists.
            if ($game->image) {
                \Illuminate\Support\Facades\Storage::disk('public')
                    ->delete($game->image);
            }

            $game->image = $newImage;
        }

        $game->save();

        return redirect()
            ->route('games.show', $game)
            ->with('success', 'Game updated successfully!');
    }

    public function store(Request $request)
    {
        //validation op de data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'category' => [
                'required',
                'in:Action,Adventure,Puzzle,Racing,Simulation,Roleplay',
            ],
        ]);

        //info in database zetten
        $game = new Game();
        $game->title = $validated['title'];
        $game->description = $validated['description'];
        $game->category = $validated['category'];
//        $game->image_url = 'temp';
//        $game->category = 1;
        $game->user_id = auth()->id();

        $game->save();

        return redirect()
            ->route('games.index')
            ->with('success', 'Game added successfully!');
    }
}
