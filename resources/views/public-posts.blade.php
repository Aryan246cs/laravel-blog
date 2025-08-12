<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Explore | My Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
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

<body class="bg-gray-900 text-gray-100 font-sans">

    <!-- Header -->
    <header
        class="bg-gradient-to-r from-gray-900 to-black shadow-lg py-4 px-6 flex flex-wrap justify-between items-center gap-4">
        <!-- Logo -->
        <h1 class="text-3xl font-bold text-white">Quillly</h1>

        <!-- Search Form -->
        <form action="{{ route('explore.posts') }}" method="GET" class="flex flex-1 max-w-md">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search by User ID or Post Title..."
                class="border border-gray-600 bg-gray-800 text-white placeholder-gray-400 rounded-l px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r transition duration-200">
                Search
            </button>
        </form>

        <!-- Navigation -->
        @auth
            <div class="flex items-center gap-4">
                <a href="{{ route('create-post') }}"
                    class="bg-gray-900 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition duration-200">
                    Create Post
                </a>

                <a href="{{ route('your-posts') }}"
                    class="bg-gray-900 hover:bg-green-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition duration-200">
                    Your Posts
                </a>

                <a href="{{ route('report') }}"
                    class="bg-gray-900 hover:bg-green-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition duration-200">
                    Report
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-gray-900 hover:bg-red-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition duration-200">
                        Logout
                    </button>
                </form>
            </div>
        @endauth

        <!-- Website Analytics Link (Always visible) -->
        <a href="{{ route('web-analytics') }}"
            class="bg-gray-900 hover:bg-green-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition duration-200">
            Website Analytics
        </a>
    </header>


    <section class="bg-gradient-to-r from-gray-900 to-black text-white">
        <div class="max-w-5xl mx-auto px-6 py-20 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold mb-4">Uncover Stories That Resonate</h1>
            <p class="text-base md:text-lg mb-6">
                Welcome to <strong>Quillly</strong>- your space to write, express, and share. Whether it's a personal
                journal or a public story, you choose who sees it. Create blogs, keep them private, or share them with
                the world- all in one place.
            </p>

            <div class="mt-8">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="bg-white text-gray-700 font-semibold px-6 py-2 rounded-full hover:bg-gray-100 transition">Go
                        to Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-white text-gray-700 font-semibold px-6 py-2 rounded-full hover:bg-gray-100 transition">Login
                        / Register</a>
                @endauth
            </div>
        </div>


        <div class="-mt-10">
            <svg viewBox="0 0 1440 100" class="w-full">
                <path fill="#111827" d="M0,64L1440,0L1440,320L0,320Z"></path>
            </svg>
        </div>


    </section>




    <!-- Public Posts -->
    <main class="max-w-4xl mx-auto px-4 py-10">
        <h2 class="text-2xl md:text-3xl font-semibold mb-4">
            🔍 See What's Shared
        </h2>
        <h2 class="text-gray-900">.</h2>
        <div class="flex flex-wrap gap-3 mb-6">
            @foreach($categories as $cat)
                <a href="{{ route('explore.posts', $cat->name) }}" class="px-4 py-2 text-sm rounded-full border border-blue-600
                          {{ $category == $cat->name ? 'bg-blue-600 text-white' : 'text-blue-600 hover:bg-blue-100' }}">
                    {{ $cat->name }}
                </a>
            @endforeach

            @if($category)
                <a href="{{ route('explore.posts') }}"
                    class="px-4 py-2 text-sm rounded-full text-red-600 border border-red-600 hover:bg-red-100">
                    Clear Filter ✕
                </a>
            @endif
        </div>

        <h2 class="text-gray-900">.</h2>


        @foreach ($posts as $post)
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-6 shadow-xl">
                <h3 class="text-2xl font-semibold mb-2 text-white">{{ $post->title }}</h3>
                <p class="text-gray-500 text-sm">
                    Posted on {{ $post->created_at->format('F j, Y') }}
                </p>
                <p class="text-gray-300 mb-3">{{ $post->body }}</p>
                <p class="text-sm text-gray-500 mb-4">Posted by User ID: {{ $post->user_id }}</p>

                <!-- Like & Comment Buttons in One Line -->
                <div x-data="{ open: false }" class="mt-2">
                    <div class="flex items-center space-x-4">
                        <!-- Like Button -->
                        <form action="{{ route('like.store', $post->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-blue-400 hover:text-blue-500 text-sm">
                                👍 {{ $post->likes->count() }}
                                {{ $post->likes->contains('user_id', auth()->id()) ? '(Liked)' : '' }}
                            </button>
                        </form>

                        <!-- Comment Toggle Button -->
                        <button @click="open = !open" class="text-purple-400 hover:underline text-sm">
                            💬 {{ $post->comments->count() }}
                            {{ $post->comments->contains('user_id', auth()->id()) ? '(Commented)' : '' }}
                        </button>
                    </div>

                    <!-- Comment Form and Previous Comments (Shown When 'open' is true) -->
                    <div x-show="open" class="mt-3">
                        @auth
                            <form action="{{ route('comment.store', $post->id) }}" method="POST" class="mb-3">
                                @csrf
                                <input type="text" name="body" placeholder="Write a comment..."
                                    class="w-full bg-gray-700 text-white border border-gray-600 px-3 py-2 rounded text-sm">
                                <button type="submit"
                                    class="mt-2 bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Post</button>
                            </form>
                        @endauth

                        <!-- Comments List -->
                        <div class="max-h-32 overflow-y-auto">
                            @if($post->comments->count())
                                <h4 class="font-semibold text-gray-300 mb-2">Comments:</h4>
                                @foreach ($post->comments as $comment)
                                    <div class="text-sm text-gray-400 border-b border-gray-700 pb-2 mb-2">
                                        <strong>{{ $comment->user->name }}:</strong> {{ $comment->body }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        @endforeach

        <div class="mt-10 flex justify-center">
            {{ $posts->links() }}
        </div>
    </main>
    <!--how to create blog -->

    <section class="bg-gradient-to-r from-gray-900 to-black text-white ">
        <div class="-mb-1 rotate-180">
            <svg viewBox="0 0 1440 100" class="w-full">
                <path fill="#111827" d="M0,64L1440,0L1440,320L0,320Z"></path>
            </svg>
        </div>


        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-start justify-between gap-12">
            <!-- Left Side -->
            <div class="md:w-1/2">
                <h2 class="text-5xl font-bold mb-4">How to post a public blog?</h2>
                <a href="{{ route('login') }}"
                    class="inline-block text-white underline font-semibold hover:underline hover:text-gray-200 transition">
                    GET STARTED BY REGESTERING→
                </a>
            </div>

            <!-- Right Side -->
            <div class="md:w-1/2 space-y-4">
                <div class="flex gap-4">
                    <span class="font-bold">01.</span>
                    <p>Register by filling in your Details.</p>
                </div>
                <div class="flex gap-4">
                    <span class="font-bold">02.</span>
                    <p>You will be logged in, then click on Create Post button in header. <br> You can like and Comment
                        once you are logged in </p>
                </div>
                <div class="flex gap-4">
                    <span class="font-bold">03.</span>
                    <p>Write the Title and Body of your Blog then select the category and visibility of your post.</p>
                </div>
                <div class="flex gap-4">
                    <span class="font-bold">04.</span>
                    <p>If you select public and click Create Post,then BOOM! Your post will be created publicaly
                        displayed.</p>
                </div>
                <div class="flex gap-4">
                    <span class="font-bold">05.</span>
                    <p>If you select private section your post will be privately stored, and you can view it from Your
                        Posts button.</p>
                </div>
                <div class="flex gap-4">
                    <span class="font-bold">06.</span>
                    <p>If you made an error in title or body- no problem, can edit and delete from your posts section.
                    </p>
                </div>
                <div class="flex gap-4">
                    <p class="text-black">.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 to-black text-sm py-6 text-center border-t border-gray-700">
        <p>© {{ date('Y') }} Quillly. Built with ❤️ using Laravel, Php & Tailwind CSS. <br> by Aryan Srivastava +91
            9929894791 </p>
    </footer>
</body>

</html>