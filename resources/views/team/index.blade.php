<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Your Team</h2>
    </x-slot>

    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        @if($teamPlayers->isEmpty())
            <p class="text-gray-600">No players on your team yet.</p>
        @else
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
                        <th class="border px-2 py-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teamPlayers as $tp)
                        @php $player = $tp->player; @endphp
                        <tr>
                            <td class="border px-2 py-1">{{ $player->Player }}</td>
                            <td class="border px-2 py-1">{{ $player->Tm }}</td>
                            <td class="border px-2 py-1">{{ $player->MP }}</td>
                            <td class="border px-2 py-1">{{ $player->FG_percent }}</td>
                            <td class="border px-2 py-1">{{ $player['3P_percent'] }}</td>
                            <td class="border px-2 py-1">{{ $player['2P_percent'] }}</td>
                            <td class="border px-2 py-1">{{ $player->FT_percent }}</td>
                            <td class="border px-2 py-1">{{ $player->TRB }}</td>
                            <td class="border px-2 py-1">{{ $player->AST }}</td>
                            <td class="border px-2 py-1">{{ $player->STL }}</td>
                            <td class="border px-2 py-1">{{ $player->BLK }}</td>
                            <td class="border px-2 py-1">{{ $player->PTS }}</td>
                            <td class="border px-2 py-1">
                            <form action="{{ route('team.remove', $player->id) }}" method="POST" class="inline">
                                @csrf
                            @method('DELETE')
                             <button type="submit" class="text-red-600">Remove</button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-6">
            <h3 class="text-lg font-semibold">Predicted Season Outcome</h>
            <p>Total Wins: <strong>{{ $wins }}</strong></p>
            <p>Playoff Projection: <strong>{{ $playoffResult }}</strong></p>
            </div>
        @endif
    </div>
</x-app-layout>
