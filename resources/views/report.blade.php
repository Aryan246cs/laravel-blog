<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts Table</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-6xl">
        <h1 class="text-3xl font-bold text-center mb-6">Your Blogs Report</h1>

        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="min-w-full table-auto bg-gray-800 rounded-lg">
                <thead class="bg-gray-700 text-white uppercase text-sm">
                    <tr>
                        <th class="px-6 py-3 text-left">User Name</th>
                        <th class="px-6 py-3 text-left">Blog Title</th>
                        <th class="px-6 py-3 text-center">Likes</th>
                        <th class="px-6 py-3 text-center">Comments</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($posts as $post)
                        <tr class="hover:bg-gray-600 transition duration-200">
                            <td class="px-6 py-4">{{ $post->user->name }}</td>
                            <td class="px-6 py-4">{{ $post->title }}</td>
                            <td class="px-6 py-4 text-center">{{ $post->likes->count() }}</td>
                            <td class="px-6 py-4 text-center">{{ $post->comments->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($posts->count() === 0)
                <div class="text-center text-gray-400 p-6">
                    No posts available.
                </div>
            @endif
        </div>
    </div>

</body>
</html>
