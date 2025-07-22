<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Website Analytics</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100 p-10">
    <div class="max-w-5xl mx-auto bg-gray-800 p-6 rounded shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-400">Website Analytics</h1>
        <table class="min-w-full table-auto border border-gray-700">
            <thead class="bg-gray-700 text-left text-gray-300">
                <tr>
                    <th class="p-3 border border-gray-700">User ID</th>
                    <th class="p-3 border border-gray-700">Name</th>
                    <th class="p-3 border border-gray-700">Total Blogs</th>
                    <th class="p-3 border border-gray-700">Total Likes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @php
                        $totalLikes = $user->usersCoolPosts->sum(fn($post) => $post->likes_count);
                    @endphp
                    <tr class="border-t border-gray-700 hover:bg-gray-700">
                        <td class="p-3 border border-gray-700">{{ $user->id }}</td>
                        <td class="p-3 border border-gray-700">{{ $user->name }}</td>
                        <td class="p-3 border border-gray-700">{{ $user->users_cool_posts_count }}</td>
                        <td class="p-3 border border-gray-700">{{ $totalLikes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
