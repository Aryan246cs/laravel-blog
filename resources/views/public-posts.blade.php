<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        nav[role="navigation"] {
            display: flex;
            justify-content: center !important;
            margin-top: 20px;
        }

        .hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between {
            justify-content: center !important;
            gap: 20px;
            flex-wrap: wrap;
        }

        .text-sm.text-gray-700.leading-5 {
            display: none;
        }
    </style>

</head>

<body class="bg-gray-100 text-gray-800 min-h-screen font-sans">
    <header>
        <div class="flex justify-between items-center bg-gray-800 text-white px-4 py-3">
            <h1 class="text-xl font-bold">My Blog</h1>

            @auth
                    <div class="flex gap-4 justify-end mb-4">
                        <a href="{{ route('dashboard') }}" class="bg-green-600 text-white px-4 py-2 rounded">Dashboard</a>
                        <a href="{{ route('create-post') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Create Post</a>
                        <a href="{{ route('your-posts') }}" class="bg-green-600 text-white px-4 py-2 rounded">Your Posts</a>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 px-3 py-1 rounded">Logout</button>
                    </form>
                </div>
            @else
            <a href="{{ route('login') }}" class="bg-green-500 px-3 py-1 rounded">Login / Register</a>
        @endauth
        </div>

    </header>

    <main class="max-w-3xl mx-auto p-4">
        <h2 class="text-2xl font-bold my-6 text-center">Explore Public Posts</h2>

        @foreach ($posts as $post)
            <div class="bg-white shadow-md rounded-lg p-5 mb-6">
                <h3 class="text-xl font-semibold mb-2">{{ $post->title }}</h3>
                <p class="text-gray-700 mb-3">{{ $post->body }}</p>
                <p class="text-sm text-gray-500">Posted by User ID: {{ $post->user_id }}</p>


                {{-- Like Button --}}
                <form action="{{ route('like.store', $post->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-blue-500 hover:text-blue-700">
                        👍 {{ $post->likes->count() }}
                        {{ $post->likes->contains('user_id', auth()->id()) ? '(Liked)' : '' }}
                    </button>
                </form>


                <div x-data="{ open: false }" class="mt-4">
                    
                    <button @click="open = !open" class="text-blue-500 hover:underline text-sm">💬 Comment</button>

                    @auth
                    <form action="{{ route('comment.store', $post->id) }}" method="POST" x-show="open" class="mt-2">
                        @csrf
                        <input type="text" name="body" placeholder="Write a comment..."
                            class="w-full border px-3 py-1 rounded text-sm">
                        <button type="submit"
                            class="mt-1 bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">Post</button>
                    </form>
                    @endauth
                  
                    <div class="max-h-24 overflow-y-auto">
                        @if($post->comments->count())
                            <div class="mt-4">
                                <h3 class="font-semibold text-gray-800">Comments:</h3>
                                @foreach ($post->comments as $comment)
                                    <div class="mt-2 text-sm text-gray-600 border-b pb-2">
                                        <strong>{{ $comment->user->name }}:</strong> {{ $comment->body }}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>



                {{-- <div class="mt-4">
                    <h3 class="font-semibold text-gray-800">Comments:</h3>
                    @foreach ($post->comments as $comment)
                    <div class="mt-2 text-sm text-gray-600 border-b pb-2">
                        <strong>{{ $comment->user->name }}:</strong> {{ $comment->body }}
                    </div>
                    @endforeach
                </div>

                @auth
                <form action="{{ route('comment.store', $post->id) }}" method="POST" class="mt-4">
                    @csrf
                    <textarea name="body" rows="2" class="w-full border rounded p-2"
                        placeholder="Add a comment..."></textarea>
                    <button type="submit" class="mt-2 px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Comment
                    </button>
                </form>
                @endauth --}}
            </div>

        @endforeach

        <div class="mt-8 flex justify-center">
            {{ $posts->links() }}
        </div>
    </main>
    <script src="//unpkg.com/alpinejs" defer></script>

</body>

</html>