<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-[#EDEDEC] text-center">
                <h2 class="text-2xl font-bold mb-4">Welcome to the <span class="text-red-600">NBA</span> <span class="text-blue-600">Stats Builder</span></h2>

                <p class="text-lg mb-6 text-gray-300 mt-10">
                    This web application allows users to browse NBA player statistics, create custom teams,
                    and predict how far they might go in a season based on real player performance metrics.
                </p>

                <div class="flex justify-center">
                    <img src="{{ asset('images/nba-free-use.png') }}" alt="NBA application"
                        class="rounded shadow-md w-1/2 mt-20 h-auto">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
