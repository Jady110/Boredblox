<div>
    <h1>{{ $game->name }}</h1>
    <p>{{ $game->description }}</p>
    <p>Price: ${{ $game->price }}</p>
</div>

<div>
    <form action="{{ route('games.destroy', $game) }}" method="post">
        @method('DELETE')

        <button type="submit">Delete</button>
    </form>
</div>
