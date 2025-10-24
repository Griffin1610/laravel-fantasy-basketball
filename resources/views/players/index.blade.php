<x-app-layout>

    <div class="p-6">
        <h2 class="text-xl font-semibold mb-4">All Player Stats</h2>

    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <a href="{{ route('players.create') }}" class="text-blue-500 underline mb-4 inline-block">Add New Players </a>
    <form method="GET" action="{{ route('players.index') }}" class="mb-4">
            <label for="sort" class="mr-2">Sort by:</label>
            <select name="sort" id="sort" onchange="this.form.submit()" class="border rounded px-2 py-1 !bg-grey text-black">
            <option value="">-- None --</option>
            <option value="MP" {{ $sort === 'MP' ? 'selected' : '' }}>Minutes Played</option>
            <option value="PTS" {{ $sort === 'PTS' ? 'selected' : '' }}>Points</option>
            <option value="AST" {{ $sort === 'AST' ? 'selected' : '' }}>Assists</option>
            </select>
        </form>
    <table class="w-full border text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-2 py-1">Name</th>
                <th class="border px-2 py-1">Team</th>
                <th class="border px-2 py-1">MP</th>
                <th class="border px-2 py-1">FG%</th>
                <th class="border px-2 py-1">3P%</th>
                <th class="border px-2 py-1">2P%</th>
                <th class="border px-2 py-1">FT%</th>
                <th class="border px-2 py-1">REB</th>
                <th class="border px-2 py-1">AST</th>
                <th class="border px-2 py-1">STL</th>
                <th class="border px-2 py-1">BLK</th>
                <th class="border px-2 py-1">PTS</th>
                <th class="border px-2 py-1">Actions</th>
            </tr>
          </thead>
        <tbody>
            @foreach($players as $player)
            <tr>
                    <td class="border px-2 py-1">{{ $player->Player }}</td>
                    <td class="border px-2 py-1">{{ $player->Tm }}</td>
                    <td class="border px-2 py-1">{{ $player->MP }}</td>
                    <td class="border px-2 py-1">{{ $player->FG_percent }}</td>
                    <td class="border px-2 py-1">{{ $player['P3_percent']}}</td>
                    <td class="border px-2 py-1">{{ $player['P2_percent'] }}</td>
                    <td class="border px-2 py-1">{{ $player->FT_percent }}</td>
                    <td class="border px-2 py-1">{{ $player->TRB }}</td>
                    <td class="border px-2 py-1">{{ $player->AST }}</td>
                    <td class="border px-2 py-1">{{ $player->STL }}</td>
                    <td class="border px-2 py-1">{{ $player->BLK }}</td>
                    <td class="border px-2 py-1">{{ $player->PTS }}</td>
                    <td class="border px-2 py-1">
                    <a href="{{ route('players.edit', $player) }}" class="text-blue-600">Edit</a>

                <form action="{{ route('team.add', $player->id) }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                    <button type="submit" class="text-green-600">Add</button>
                </form>

                <form action="{{ route('players.destroy', $player) }}" method="POST" class="inline">
                     @csrf
                    @method('DELETE')
                <button type="submit" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</butto>
        </form>
        </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>

