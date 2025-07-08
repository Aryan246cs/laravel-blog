<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-xl">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-600">Edit Post</h1>

        <form action="/edit-post/{{$post->id}}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold">Title:</label>
                <input type="text" name="title" value="{{ $post->title }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label class="block font-semibold">Body:</label>
                <textarea name="body" rows="6"
                    class="w-full border border-gray-300 rounded px-3 py-2 mt-1 resize-none">{{ $post->body }}</textarea>
            </div>

            <div class="text-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</body>

</html>
