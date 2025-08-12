<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans min-h-screen">

    <header class="bg-gray-800 py-4 shadow-md">
        <div class="max-w-5xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white">Your Blog Posts</h1>
            <a href="{{ route('dashboard') }}" class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700 text-white text-sm">⬅ Dashboard</a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6 border-b border-gray-700 pb-2">All Your Posts</h2>

        @foreach ($posts as $post)
            <div class="bg-gray-800 rounded-lg shadow-md p-5 mb-6 transition hover:shadow-lg">
                <h3 class="text-xl font-semibold text-blue-400 mb-1">
                    {{ $post['title'] }}
                    <small class="text-gray-400 text-sm">by {{ $post->user->name }}</small>
                </h3>
                <p class="text-gray-500 text-sm">
                    Posted on {{ $post->created_at->format('F j, Y') }}
                </p>
                <p class="text-gray-300 mb-4">{{ $post['body'] }}</p>

                <div class="flex items-center gap-4">
                    <a href="/edit-post/{{ $post->id }}" class="text-blue-500 hover:underline text-sm">✏️ Edit</a>

                    <form action="/delete-post/{{ $post->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('Delete')
                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                            🗑 Delete
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </main>

    <footer class="bg-gray-800 text-gray-400 text-center text-sm py-4 mt-10">
        &copy; {{ date('Y') }} Quillly. All rights reserved.
    </footer>

</body>
</html>
