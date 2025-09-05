<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Add Player</h2>
    </x-slot>

    <div class="p-6">
        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('players.store') }}" method="POST">
            @csrf

            <button type="submit" class="mt-6 bg-blue-500 text-black px-4 py-2 rounded">Add Player</button>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Player Name</label>
                    <input type="text" name="Player" class="border rounded w-full p-2" required>
                </div>
                <div>
                    <label>Team (Tm)</label>
                    <input type="text" name="Tm" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>Position (Pos)</label>
                    <input type="text" name="Pos" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>Age</label>
                    <input type="number" name="Age" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>MP</label>
                    <input type="number" step="0.1" name="MP" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>FG%</label>
                    <input type="number" step="0.001" name="FG_percent" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>3P%</label>
                    <input type="number" step="0.001" name="3P_percent" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>2P%</label>
                    <input type="number" step="0.001" name="2P_percent" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>FT%</label>
                    <input type="number" step="0.001" name="FT_percent" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>TRB</label>
                    <input type="number" step="0.1" name="TRB" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>AST</label>
                    <input type="number" step="0.1" name="AST" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>STL</label>
                    <input type="number" step="0.1" name="STL" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>BLK</label>
                    <input type="number" step="0.1" name="BLK" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>PTS</label>
                    <input type="number" step="0.1" name="PTS" class="border rounded w-full p-2">
                </div>
            </div>

            <button type="submit" class="mt-6 bg-blue-500 text-white px-4 py-2 rounded">Add Player</button>
        </form>
    </div>
</x-app-layout>
