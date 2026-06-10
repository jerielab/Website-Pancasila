<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pancasila Museum Engagement</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-600 flex items-center justify-center rounded-lg shadow-sm">
                                <span class="text-white font-bold text-xl">P</span>
                            </div>
                            <h1 class="text-xl font-bold text-gray-900 tracking-tight">Pancasila Museum</h1>
                        </div>
                    </div>
                    
                    @if(isset($leadingPercentage) && $leadingPercentage > 0)
                    <div class="hidden md:flex items-center bg-red-50 px-4 py-2 rounded-full border border-red-100 shadow-sm animate-pulse">
                        <span class="text-red-700 text-sm font-semibold">🔥 Current Survey Lead: {{ $leadingPercentage }}%</span>
                    </div>
                    @endif

                    <div class="flex items-center gap-4">
                        <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-red-600 transition-colors">Home</a>
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-red-600 transition-colors">Admin Panel</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-red-600 transition-colors">Admin Login</a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-12 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Pancasila Museum. Dedicated to our national heritage.</p>
                <div class="mt-4 flex justify-center gap-6">
                    <a href="#" class="text-gray-400 hover:text-red-600 transition-colors">About</a>
                    <a href="#" class="text-gray-400 hover:text-red-600 transition-colors">Contact</a>
                    <a href="#" class="text-gray-400 hover:text-red-600 transition-colors">Privacy</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
