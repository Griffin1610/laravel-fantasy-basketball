<x-app-layout>

    <div class="p-6 text-[#EDEDEC]">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">All Player Stats</h2>
            @php
                $playersUntilFull = 5 - ($teamPlayerCount ?? 0);
            @endphp
            <p class="text-[#EDEDEC]">
                {{ $teamPlayerCount ?? 0 }}/5 players
            </p>
        </div>

    @if(session('success'))
        <div class="mb-4 text-green-500">{{ session('success') }}</div>
    @endif

    <div class="mb-4 flex gap-4 items-end">
        <form method="GET" action="{{ route('players.index') }}" class="w-48">
            @if($search)
                <input type="hidden" name="search" value="{{ $search }}">
            @endif
            <label for="sort" class="block text-sm font-medium mb-1 text-[#EDEDEC]">Sort by:</label>
            <select name="sort" id="sort" onchange="this.form.submit()" class="w-full border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded px-2 py-2">
            <option value="">-- None --</option>
            <option value="PTS" {{ $sort === 'PTS' ? 'selected' : '' }}>Points</option>
            <option value="TRB" {{ $sort === 'TRB' ? 'selected' : '' }}>Rebounds</option>
            <option value="AST" {{ $sort === 'AST' ? 'selected' : '' }}>Assists</option>
            <option value="STL" {{ $sort === 'STL' ? 'selected' : '' }}>Steals</option>
            <option value="BLK" {{ $sort === 'BLK' ? 'selected' : '' }}>Blocks</option>
            <option value="FG_percent" {{ $sort === 'FG_percent' ? 'selected' : '' }}>Field Goal %</option>
            <option value="P3_percent" {{ $sort === 'P3_percent' ? 'selected' : '' }}>3-Point %</option>
            <option value="FT_percent" {{ $sort === 'FT_percent' ? 'selected' : '' }}>Free Throw %</option>
            <option value="MP" {{ $sort === 'MP' ? 'selected' : '' }}>Minutes Played</option>
            </select>
        </form>
        
        <form method="GET" action="{{ route('players.index') }}" class="flex-1 max-w-md">
            <label for="search" class="block text-sm font-medium mb-1 text-[#EDEDEC]">Search Players</label>
            <div class="flex gap-2">
                <input type="text" 
                       name="search" 
                       id="search" 
                       value="{{ $search ?? '' }}" 
                       placeholder="Search by name or team..." 
                       class="flex-1 border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded px-3 py-2">
                <input type="hidden" name="sort" value="{{ $sort ?? '' }}">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Search</button>
                @if($search ?? '')
                    <a href="{{ route('players.index', ['sort' => $sort]) }}" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600">Clear</a>
                @endif
            </div>
        </form>
    </div>
    
    @if(isset($search) && $search)
        <div class="mb-4 text-sm text-gray-400">
            Showing results for: "<strong>{{ $search }}</strong>" 
            <a href="{{ route('players.index', ['sort' => $sort]) }}" class="text-blue-500 underline">Clear search</a>
        </div>
    @endif

    <table class="w-full border border-gray-700 text-sm text-[#EDEDEC]">
        <thead>
            <tr class="bg-gray-800">
                <th class="border border-gray-700 px-2 py-1">Name</th>
                <th class="border border-gray-700 px-2 py-1">Team</th>
                <th class="border border-gray-700 px-2 py-1">MP</th>
                <th class="border border-gray-700 px-2 py-1">PTS</th>
                <th class="border border-gray-700 px-2 py-1">AST</th>
                <th class="border border-gray-700 px-2 py-1">REB</th>
                <th class="border border-gray-700 px-2 py-1">FG%</th>
                <th class="border border-gray-700 px-2 py-1">3P%</th>
                <th class="border border-gray-700 px-2 py-1">2P%</th>
                <th class="border border-gray-700 px-2 py-1">FT%</th>
                <th class="border border-gray-700 px-2 py-1">STL</th>
                <th class="border border-gray-700 px-2 py-1">BLK</th>
                <th class="border border-gray-700 px-2 py-1">Add</th>
            </tr>
          </thead>
        <tbody>
            @foreach($players as $player)
            <tr class="hover:bg-gray-800">
                    <td class="border border-gray-700 px-2 py-1">{{ $player->Player }}</td>
                    <td class="border border-gray-700 px-2 py-1">{{ $player->Tm }}</td>
                    <td class="border border-gray-700 px-2 py-1">{{ $player->MP }}</td>
                    <td class="border border-gray-700 px-2 py-1">{{ $player->PTS }}</td>
                    <td class="border border-gray-700 px-2 py-1">{{ $player->AST }}</td>
                    <td class="border border-gray-700 px-2 py-1">{{ $player->TRB }}</td>
                    <td class="border border-gray-700 px-2 py-1">{{ $player->FG_percent }}</td>
                    <td class="border border-gray-700 px-2 py-1">{{ $player['P3_percent']}}</td>
                    <td class="border border-gray-700 px-2 py-1">{{ $player['P2_percent'] }}</td>
                    <td class="border border-gray-700 px-2 py-1">{{ $player->FT_percent }}</td>
                    <td class="border border-gray-700 px-2 py-1">{{ $player->STL }}</td>
                    <td class="border border-gray-700 px-2 py-1">{{ $player->BLK }}</td>
                    <td class="border border-gray-700 px-2 py-1">
                <form action="{{ route('team.add', $player->id) }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <button type="submit" class="text-green-500 hover:text-green-400">Add</button>
                </form>
        </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>

