<x-app-layout>
    <div class="admin-container">
        <h1 class="admin-title">Admin Dashboard</h1>
        <p class="admin-subtitle">
            Overzicht van alle geregistreerde gebruikers en hun games.
        </p>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                <tr>
                    <th>Naam</th>
                    <th>E-mailadres</th>
                    <th>Aantal games</th>
                    <th>Geregistreerd op</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->games_count }}</td>
                        <td>
                            {{ $user->created_at?->format('d-m-Y H:i') ?? 'Onbekend' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            Er zijn nog geen gebruikers geregistreerd.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('games.index') }}" class="admin-back-link">
            &larr; Terug naar BoredBlox
        </a>
    </div>
</x-app-layout>
