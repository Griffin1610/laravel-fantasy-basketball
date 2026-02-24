<x-app-layout>
    <div class="p-6 text-[#EDEDEC]">
        @if(session('success'))
            <div class="mb-4 text-green-500">{{ session('success') }}</div>
        @endif

        @if($teamPlayers->isEmpty())
            <p class="text-gray-400 mb-4">No players on your team yet.</p>
        @else
            <table class="w-full border border-gray-700 text-sm">
                <thead>
                    <tr class="bg-gray-800">
                        <th class="border border-gray-700 px-2 py-1">Name</th>
                        <th class="border border-gray-700 px-2 py-1">Team</th>
                        <th class="border border-gray-700 px-2 py-1">MP</th>
                        <th class="border border-gray-700 px-2 py-1">FG%</th>
                        <th class="border border-gray-700 px-2 py-1">3P%</th>
                        <th class="border border-gray-700 px-2 py-1">2P%</th>
                        <th class="border border-gray-700 px-2 py-1">FT%</th>
                        <th class="border border-gray-700 px-2 py-1">REB</th>
                        <th class="border border-gray-700 px-2 py-1">AST</th>
                        <th class="border border-gray-700 px-2 py-1">STL</th>
                        <th class="border border-gray-700 px-2 py-1">BLK</th>
                        <th class="border border-gray-700 px-2 py-1">PTS</th>
                        <th class="border border-gray-700 px-2 py-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teamPlayers as $tp)
                        @if($tp->player)
                        <tr class="hover:bg-gray-800">
                            <td class="border border-gray-700 px-2 py-1">{{ $tp->player->Player }}</td>
                            <td class="border border-gray-700 px-2 py-1">{{ $tp->player->Tm }}</td>
                            <td class="border border-gray-700 px-2 py-1">{{ $tp->player->MP }}</td>
                            <td class="border border-gray-700 px-2 py-1">{{ $tp->player->FG_percent }}</td>
                            <td class="border border-gray-700 px-2 py-1">{{ $tp->player['P3_percent'] }}</td>
                            <td class="border border-gray-700 px-2 py-1">{{ $tp->player['P2_percent'] }}</td>
                            <td class="border border-gray-700 px-2 py-1">{{ $tp->player->FT_percent }}</td>
                            <td class="border border-gray-700 px-2 py-1">{{ $tp->player->TRB }}</td>
                            <td class="border border-gray-700 px-2 py-1">{{ $tp->player->AST }}</td>
                            <td class="border border-gray-700 px-2 py-1">{{ $tp->player->STL }}</td>
                            <td class="border border-gray-700 px-2 py-1">{{ $tp->player->BLK }}</td>
                            <td class="border border-gray-700 px-2 py-1">{{ $tp->player->PTS }}</td>
                            <td class="border border-gray-700 px-2 py-1">
                            <form action="{{ route('team.remove', $tp->player->id) }}" method="POST" class="inline">
                                @csrf
                            @method('DELETE')
                             <button type="submit" class="text-red-600 hover:text-red-500">Remove</button>
                            </form>
                        </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            
            <div class="mt-6 space-y-4">
                <div>
                    <h3 class="text-lg font-semibold mb-3 text-[#EDEDEC]">Season Prediction</h3>
                    <div class="grid grid-cols-2 gap-4 mb-3">
                        <div>
                            <p class="text-sm text-gray-400">Projected Wins</p>
                            <p class="text-2xl font-bold text-[#EDEDEC]">{{ $wins ?? 0 }}/82</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Playoff Projection</p>
                            <p class="text-xl font-semibold text-[#EDEDEC]">{{ $playoffResult[0] ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-300 italic">{{ $playoffResult[1] ?? '' }}</p>
                </div>

                @if(isset($strengths) && count($strengths) > 0)
                <div>
                    <h4 class="font-semibold text-[#EDEDEC] mb-2">Team Strengths</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($strengths as $strength)
                            <span class="text-[#EDEDEC] px-2 py-1 text-sm">{{ $strength }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(isset($weaknesses) && count($weaknesses) > 0)
                <div>
                    <h4 class="font-semibold text-[#EDEDEC] mb-2">Areas for Improvement</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($weaknesses as $weakness)
                            <span class="text-[#EDEDEC] px-2 py-1 text-sm">{{ $weakness }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                <div>
                    <h4 class="font-semibold mb-2 text-[#EDEDEC]">Team Statistics</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                        <div>
                            <p class="text-gray-400">Points/Game</p>
                            <p class="font-semibold text-[#EDEDEC]">{{ number_format($totals['PTS'] ?? 0, 1) }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Assists/Game</p>
                            <p class="font-semibold text-[#EDEDEC]">{{ number_format($totals['AST'] ?? 0, 1) }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Rebounds/Game</p>
                            <p class="font-semibold text-[#EDEDEC]">{{ number_format($totals['TRB'] ?? 0, 1) }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Team Size</p>
                            <p class="font-semibold text-[#EDEDEC]">{{ $playerCount ?? $teamPlayers->count() }}/5 players</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
