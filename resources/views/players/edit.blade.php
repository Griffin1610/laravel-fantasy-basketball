<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Edit Player</h2>
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

        <form action="{{ route('players.update', $player) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Player Name</label>
                    <input type="text" name="Player" value="{{ $player->Player }}" class="border rounded w-full p-2" required>
                </div>
                <div>
                    <label>Team (Tm)</label>
                    <input type="text" name="Tm" value="{{ $player->Tm }}" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>Position (Pos)</label>
                    <input type="text" name="Pos" value="{{ $player->Pos }}" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>Age</label>
                    <input type="number" name="Age" value="{{ $player->Age }}" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>MP</label>
                    <input type="number" step="0.1" name="MP" value="{{ $player->MP }}" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>FG%</label>
                    <input type="number" step="0.001" name="FG_percent" value="{{ $player->FG_percent }}" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>3P%</label>
                    <input type="number" step="0.001" name="3P_percent" value="{{ $player['3P_percent'] }}" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>2P%</label>
                    <input type="number" step="0.001" name="2P_percent" value="{{ $player['2P_percent'] }}" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>FT%</label>
                    <input type="number" step="0.001" name="FT_percent" value="{{ $player->FT_percent }}" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>TRB</label>
                    <input type="number" step="0.1" name="TRB" value="{{ $player->TRB }}" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>AST</label>
                    <input type="number" step="0.1" name="AST" value="{{ $player->AST }}" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>STL</label>
                    <input type="number" step="0.1" name="STL" value="{{ $player->STL }}" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>BLK</label>
                    <input type="number" step="0.1" name="BLK" value="{{ $player->BLK }}" class="border rounded w-full p-2">
                </div>
                <div>
                    <label>PTS</label>
                    <input type="number" step="0.1" name="PTS" value="{{ $player->PTS }}" class="border rounded w-full p-2">
                </div>
            </div>

            <button type="submit" class="mt-6 bg-green-500 text-white px-4 py-2 rounded">Update Player</button>
        </form>
    </div>
</x-app-layout>
