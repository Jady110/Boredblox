<x-app-layout>

    <div class="page-container">

        <form action="{{ route('games.index') }}" method="GET" class="games-filter-form">

            <div class="search-field">
                <label for="search">Search games</label>

                <input
                    type="search"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by title or description..."
                    maxlength="100"
                >
            </div>

            <div class="category-field">
                <label for="category">Category</label>

                <select id="category" name="category">
                    <option value="">All categories</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category }}"
                            @selected(request('category') === $category)
                        >
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="games-search-button">
                Search
            </button>

            <a href="{{ route('games.index') }}" class="games-reset-button">
                Reset
            </a>

        </form>

        @if (request()->filled('search') || request()->filled('category'))
            <p class="games-results-message">
                Found {{ $games->count() }}
                {{ $games->count() === 1 ? 'game' : 'games' }}.
            </p>
        @endif

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
