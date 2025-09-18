<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind CSS --}}
    @vite('resources/css/app.css')

    <style>
        /* Custom Scrollbar for Cart Items */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #2563eb;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-50 via-white to-blue-50 text-gray-900 min-h-screen flex flex-col">

    {{-- Header --}}
    <header class="bg-blue-600 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white">MyShop</h1>
            <nav>
                <a href="{{ route('index') }}" 
                   class="text-white hover:text-yellow-300 font-semibold transition-colors">Home</a>
            </nav>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-6 py-10">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            {{ $slot }}
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-blue-600 mt-10">
        <div class="max-w-7xl mx-auto px-6 py-6 text-center text-white font-medium">
            © {{ date('Y') }} MyShop. All rights reserved.
        </div>
    </footer>

</body>
</html>
