<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @yield('style')
</head>
<body>
    <header class="bg-primary text-white p-3 mb-4">
        <div class="container">
            <h1>My E-Commerce Site</h1>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-light text-center p-3 mt-4">
        &copy; {{ date('Y') }} My E-Commerce Site
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
