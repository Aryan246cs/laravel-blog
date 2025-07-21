<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-900 to-gray-800 min-h-screen flex items-center justify-center px-4">
    <div class="bg-gray-800 p-8 rounded-xl shadow-xl w-full max-w-2xl text-gray-100">
        <h1 class="text-3xl font-bold text-center text-blue-400 mb-6">Edit Your Post</h1>

        <form action="/edit-post/{{ $post->id }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold text-gray-300 mb-1">Title</label>
                <input type="text" name="title" value="{{ $post->title }}"
                    class="w-full bg-gray-900 text-gray-100 border border-gray-700 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block font-semibold text-gray-300 mb-1">Body</label>
                <textarea name="body" rows="6"
                    class="w-full bg-gray-900 text-gray-100 border border-gray-700 rounded-md px-4 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $post->body }}</textarea>
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ url()->previous() }}"
                    class="text-sm text-gray-400 hover:underline hover:text-gray-200">← Back</a>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md transition duration-200">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</body>

</html>
