@extends('layouts.visitor')

@section('content')
<!-- Hero Section -->
<div class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="50,0 100,0 50,100 0,100" />
            </svg>

            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="sm:text-center lg:text-left">
                    <h2 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block xl:inline">Explore the Values of</span>
                        <span class="block text-red-600 xl:inline">Pancasila</span>
                    </h2>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Welcome to the Pancasila Museum. Discover the history and significance of Indonesia's foundational philosophy. Share your thoughts and engage with our community.
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow">
                            <a href="#reflection-section" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 md:py-4 md:text-lg md:px-10 transition-all transform hover:scale-105">
                                Share Reflection
                            </a>
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="#survey-section" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 md:py-4 md:text-lg md:px-10 transition-all transform hover:scale-105">
                                Take Survey
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1596422846543-75c6fc18a593?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Indonesian Heritage">
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <!-- Reflection Section (Left 2 columns) -->
        <div class="lg:col-span-2 space-y-12">
            <!-- Submission Form -->
            <section id="reflection-section" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 transform transition-all hover:shadow-md">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <span class="p-2 bg-red-100 rounded-lg">✍️</span>
                    Your Reflection
                </h3>
                
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3 animate-fade-in">
                        <span>✅</span>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('reflections.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="content" class="sr-only">Reflection</label>
                        <textarea id="content" name="content" rows="4" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-red-500 focus:ring-red-500 text-lg transition-all" placeholder="Share what you learned about Pancasila today..." required></textarea>
                        @error('content')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all transform hover:scale-105 active:scale-95">
                            Submit Reflection
                        </button>
                    </div>
                </form>
            </section>

            <!-- Reflection Board -->
            <section class="space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="p-2 bg-red-100 rounded-lg">📢</span>
                        Reflection Board
                    </h3>
                    <span class="text-sm text-gray-500">{{ $reflections->total() }} thoughts shared</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($reflections as $reflection)
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-red-200 transition-all group">
                            <p class="text-gray-700 leading-relaxed italic">"{{ $reflection->content }}"</p>
                            <div class="mt-4 flex items-center justify-between text-xs text-gray-400">
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 bg-red-400 rounded-full group-hover:animate-ping"></span>
                                    Anonymous Visitor
                                </span>
                                <span>{{ $reflection->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 p-12 text-center">
                            <p class="text-gray-400">No reflections shared yet. Be the first to share your thoughts!</p>
                        </div>
                    @endforelse
                </div>
                
                <div class="mt-8">
                    {{ $reflections->links() }}
                </div>
            </section>
        </div>

        <!-- Survey Section (Right 1 column) -->
        <div class="space-y-8">
            <section id="survey-section" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 sticky top-24">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <span class="p-2 bg-red-100 rounded-lg">📊</span>
                    Museum Survey
                </h3>

                @if($activeSurvey)
                    @php
                        $voted = session('show_results') == $activeSurvey->id || request()->cookie('voted_survey_' . $activeSurvey->id);
                        $totalVotes = $activeSurvey->options->sum(fn($opt) => $opt->votes->count());
                    @endphp

                    <div class="space-y-6">
                        <p class="text-lg font-semibold text-gray-800 leading-tight">
                            {{ $activeSurvey->question }}
                        </p>

                        @if($voted)
                            <div class="space-y-4 animate-fade-in">
                                @foreach($activeSurvey->options as $option)
                                    @php
                                        $percentage = $totalVotes > 0 ? round(($option->votes->count() / $totalVotes) * 100) : 0;
                                        $isLeading = $totalVotes > 0 && $option->votes->count() == $activeSurvey->options->max(fn($opt) => $opt->votes->count());
                                    @endphp
                                    <div class="relative">
                                        <div class="flex justify-between text-sm mb-1">
                                            <span class="font-medium {{ $isLeading ? 'text-red-700' : 'text-gray-700' }}">
                                                {{ $option->option_text }}
                                                @if($isLeading) <span class="ml-1">👑</span> @endif
                                            </span>
                                            <span class="text-gray-500">{{ $percentage }}%</span>
                                        </div>
                                        <div class="overflow-hidden h-2.5 text-xs flex rounded-full bg-gray-100">
                                            <div style="width:{{ $percentage }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center {{ $isLeading ? 'bg-red-600' : 'bg-red-300' }} transition-all duration-1000"></div>
                                        </div>
                                    </div>
                                @endforeach
                                <p class="text-center text-xs text-gray-400 mt-4">
                                    Total votes: {{ $totalVotes }} • Thank you for participating!
                                </p>
                            </div>
                        @else
                            <form action="{{ route('surveys.vote') }}" method="POST" class="space-y-3">
                                @csrf
                                @foreach($activeSurvey->options as $option)
                                    <label class="relative flex items-center p-4 rounded-xl border border-gray-200 cursor-pointer hover:bg-red-50 hover:border-red-200 transition-all group">
                                        <input type="radio" name="survey_option_id" value="{{ $option->id }}" class="h-5 w-5 text-red-600 border-gray-300 focus:ring-red-500" required>
                                        <span class="ml-3 text-gray-700 group-hover:text-red-700 transition-colors">{{ $option->option_text }}</span>
                                    </label>
                                @endforeach
                                <button type="submit" class="w-full mt-4 bg-red-600 text-white py-3 rounded-xl font-semibold shadow-sm hover:bg-red-700 transition-all transform hover:scale-[1.02] active:scale-[0.98]">
                                    Cast Vote
                                </button>
                            </form>
                        @endif
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-400 italic">No active survey at the moment. Please check back later!</p>
                    </div>
                @endif
            </section>

            <!-- Facts Card -->
            <div class="bg-gradient-to-br from-red-600 to-red-800 rounded-2xl shadow-lg p-8 text-white">
                <h4 class="text-xl font-bold mb-4">Did you know?</h4>
                <p class="text-red-100 text-sm leading-relaxed mb-6">
                    Pancasila was first introduced by Sukarno on June 1, 1945. It consists of two Old Javanese words: "panca" meaning five, and "sila" meaning principles.
                </p>
                <a href="#" class="inline-flex items-center text-sm font-semibold hover:underline">
                    Learn more history
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.5s ease-out forwards;
    }
</style>
@endsection
