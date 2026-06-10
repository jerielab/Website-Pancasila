<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Stats Cards -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-red-500">
                    <div class="text-gray-500 text-sm uppercase font-bold">Total Reflections</div>
                    <div class="text-3xl font-extrabold text-gray-900">{{ $totalReflections }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-blue-500">
                    <div class="text-gray-500 text-sm uppercase font-bold">Total Surveys</div>
                    <div class="text-3xl font-extrabold text-gray-900">{{ $totalSurveys }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-green-500">
                    <div class="text-gray-500 text-sm uppercase font-bold">Total Votes</div>
                    <div class="text-3xl font-extrabold text-gray-900">{{ $totalVotes }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h3 class="text-lg font-bold mb-4">Quick Actions</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.surveys.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">Create New Survey</a>
                    <a href="{{ route('admin.surveys.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-900 transition-colors">Manage Surveys</a>
                    <a href="{{ route('admin.reflections.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-900 transition-colors">Review Reflections</a>
                </div>

                @if($activeSurvey)
                <div class="mt-8 p-6 bg-red-50 rounded-xl border border-red-100">
                    <h4 class="font-bold text-red-800 mb-2">Active Survey</h4>
                    <p class="text-red-700 mb-4">{{ $activeSurvey->question }}</p>
                    <a href="{{ route('admin.surveys.index') }}" class="text-red-600 font-semibold hover:underline">View results &rarr;</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
