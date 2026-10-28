<x-app-layout>
    <div class="game-details-container">
        <a href="{{ route('games.index') }}" class="back-link">
            &larr; Back to Games
        </a>

        <article class="game-details-card">

            @if ($game->image)
                <img
                    src="{{ asset('storage/' . $game->image) }}"
                    alt="{{ $game->title }}"
                    class="game-details-image"
                >
            @endif

            <h1>{{ $game->title }}</h1>

            <p class="game-details-description">
                {{ $game->description }}
            </p>

            <div>
                @if (auth()->user()?->is_admin)
                    <form
                        action="{{ route('games.destroy', $game->id) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this game?');"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit">
                            Delete Game
                        </button>
                    </form>
                @endif
            </div>
        </article>
    </div>
</x-app-layout>
