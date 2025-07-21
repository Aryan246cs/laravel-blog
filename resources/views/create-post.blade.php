<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-gray-100 to-teal-200 min-h-screen flex items-center justify-center px-4">
    <div class="bg-gray-800 p-8 rounded-xl shadow-md w-full max-w-2xl">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-300">Create a New Post</h2>

        <form action="/create-post" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block font-semibold text-gray-300 mb-1">Post Title</label>
                <input type="text" name="title" placeholder="Enter your post title"
                    class="bg-gray-600  w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-600" />
            </div>

            <div>
                <label class="block font-semibold text-gray-300 mb-1">Body Content</label>
                <textarea name="body" rows="6" placeholder="Write your post content here..."
                    class="bg-gray-600 w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 resize-none"></textarea>
            </div>

            <div>
                <label class="block font-semibold text-gray-300 mb-1">Post Visibility</label>
                <div class="flex items-center gap-6 mt-1">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="visibility" value="public" checked class="accent-green-600" />
                        <span>Public</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="visibility" value="private" class="accent-green-600" />
                        <span>Private</span>
                    </label>
                </div>
            </div>

            <div class="text-center pt-2">
                <button type="submit"
                    class="bg-gray-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md transition duration-200">
                    Save Post
                </button>
            </div>
        </form>
    </div>
</body>

</html>
