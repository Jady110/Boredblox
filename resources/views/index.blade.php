<x-app-layout>

    <div class="page-container">

        {{-- Welcome section --}}
        <section class="welcome-section">
            <h1>Welcome to BoredBlox!</h1>

            @if (session('success'))
                <p class="success-message">
                    {{ session('success') }}
                </p>
            @endif

            <p>Check out what our community has made!</p>
        </section>

        {{-- Available games --}}
        <section class="available-games">
            <h1>Available Games</h1>

            <div class="games-grid">
                @forelse ($games as $game)

                    <article class="game-card">

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

                    </article>

                @empty
                    <p>No games have been added yet.</p>
                @endforelse
            </div>
        </section>

    </div>

</x-app-layout>
