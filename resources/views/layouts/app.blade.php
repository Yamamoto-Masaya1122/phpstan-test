<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Articles')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow mb-8">
        <div class="max-w-4xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('articles.index') }}" class="text-xl font-bold text-gray-800">デモアプリ</a>
        </div>
    </nav>
    <main class="max-w-4xl mx-auto px-4">
        @yield('content')
    </main>
</body>
</html>