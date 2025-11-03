<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-[#EDEDEC]">Add Player</h2>
    </x-slot>

    <div class="p-6 text-[#EDEDEC]">
        @if ($errors->any())
            <div class="mb-4 text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('players.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1 text-[#EDEDEC]">Player Name</label>
                    <input type="text" name="Player" class="border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded w-full p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-[#EDEDEC]">Team (Tm)</label>
                    <input type="text" name="Tm" class="border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded w-full p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-[#EDEDEC]">Position (Pos)</label>
                    <input type="text" name="Pos" class="border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded w-full p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-[#EDEDEC]">Age</label>
                    <input type="number" name="Age" class="border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded w-full p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-[#EDEDEC]">MP</label>
                    <input type="number" step="0.1" name="MP" class="border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded w-full p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-[#EDEDEC]">FG%</label>
                    <input type="number" step="0.001" name="FG_percent" class="border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded w-full p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-[#EDEDEC]">3P%</label>
                    <input type="number" step="0.001" name="3P_percent" class="border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded w-full p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-[#EDEDEC]">2P%</label>
                    <input type="number" step="0.001" name="2P_percent" class="border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded w-full p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-[#EDEDEC]">FT%</label>
                    <input type="number" step="0.001" name="FT_percent" class="border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded w-full p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-[#EDEDEC]">TRB</label>
                    <input type="number" step="0.1" name="TRB" class="border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded w-full p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-[#EDEDEC]">AST</label>
                    <input type="number" step="0.1" name="AST" class="border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded w-full p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-[#EDEDEC]">STL</label>
                    <input type="number" step="0.1" name="STL" class="border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded w-full p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-[#EDEDEC]">BLK</label>
                    <input type="number" step="0.1" name="BLK" class="border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded w-full p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-[#EDEDEC]">PTS</label>
                    <input type="number" step="0.1" name="PTS" class="border border-gray-600 bg-gray-800 text-[#EDEDEC] rounded w-full p-2">
                </div>
            </div>

            <button type="submit" class="mt-6 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Player</button>
        </form>
    </div>
</x-app-layout>
