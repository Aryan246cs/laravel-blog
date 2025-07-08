<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="border-2 border-black p-6 m-4 bg-white rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">All Your Posts</h2>
            @foreach ($posts as $post)
                <div class="bg-gray-200 p-4 rounded mb-4">
                    <h3 class="text-lg font-semibold">{{ $post['title'] }} <small> by {{ $post->user->name }}</small></h3>
                    <p>{{ $post['body'] }}</p>
                    <div class="mt-2">
                        <a href="/edit-post/{{ $post->id }}" class="text-blue-500 hover:underline">Edit</a>
                    </div>
                    <form action="/delete-post/{{ $post->id }}" method="POST">
                        @csrf
                        @method('Delete')
                        <button class="mt-2 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
</body>
</html>