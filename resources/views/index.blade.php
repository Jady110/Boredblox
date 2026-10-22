<x-layout>
    <div style="max-width: 1000px; margin: 40px auto; padding: 20px;">

        <h1>Welcome to BoredBlox!</h1>
        <p>Check out what our community has made!</p>

        <div style="display: flex; gap: 20px; flex-wrap: wrap;">

            <a href="{{ route('games.index') }}"
               style="display: block; padding: 25px; background: #dbeafe;
                      border-radius: 12px; text-decoration: none; color: black;">
                <h2>Browse Games</h2>
                <p>See all available games.</p>
            </a>

            <a href="{{ route('games.create') }}"
               style="display: block; padding: 25px; background: #dcfce7;
                      border-radius: 12px; text-decoration: none; color: black;">
                <h2>Add a Game</h2>
                <p>Create a new game.</p>
            </a>

        </div>
    </div>
</x-layout>
