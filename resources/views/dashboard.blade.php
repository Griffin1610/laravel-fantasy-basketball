<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-[#EDEDEC] text-center">
                <h2 class="text-2xl font-bold mb-4">Welcome to the <span class="text-red-600">NBA</span> <span class="text-blue-600">Stats Builder</span></h2>

                <p class="text-lg mb-6 text-gray-300">
                    This web application allows users to browse NBA player statistics, create custom teams,
                    and predict how far they might go in a season based on real player performance metrics.
                </p>

                <div class="flex justify-center">
                    <img src="{{ asset('images/NBA.jpg') }}" alt="NBA application"
                        class="rounded shadow-md max-w-full h-auto">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
