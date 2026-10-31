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

            {{-- Edit and delete buttons: owner or admin only --}}
            @if (
                auth()->check() &&
                (
                    auth()->user()->is_admin ||
                    (
                        $game->user_id !== null &&
                        (int) $game->user_id === (int) auth()->id()
                    )
                )
            )
                <div class="game-actions">

                    <a
                        href="{{ route('games.edit', $game) }}"
                        class="game-edit-button"
                    >
                        Edit Game
                    </a>

                    <form
                        action="{{ route('games.destroy', $game) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this game?');"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="game-delete-button"
                        >
                            Delete Game
                        </button>
                    </form>
                </div>
            @endif
        </article>
    </div>
</x-app-layout>
