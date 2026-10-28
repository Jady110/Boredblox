<x-app-layout>

    <div class="page-container">
        <section class="available-games">
            <div class="games-grid">
                @forelse ($games as $game)
                    <article class="game-card">

                        <a href="{{ route('games.show', $game) }}"
                           class="game-card-link">

                            <div class="game-image-container">
                                @if ($game->image)
                                    <img
                                        src="{{ asset('storage/' . $game->image) }}"
                                        alt="{{ $game->title }}"
                                        class="game-image"
                                    >
                                @endif
                            </div>

                            <h2 class="game-title">
                                {{ $game->title }}
                            </h2>

                            <p class="game-description">
                                {{ $game->description }}
                            </p>

                        </a>

                    </article>
                @empty
                    <p>No games have been added yet.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-app-layout>
