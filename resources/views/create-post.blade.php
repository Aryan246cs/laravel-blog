<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="border-2 border-black p-6 m-4 bg-white rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Create a new Post</h2>
            <form action="/create-post" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="title" placeholder="Post title" class="w-full border rounded px-3 py-2">
                <textarea name="body" placeholder="Body content..." class="w-full border rounded px-3 py-2"></textarea>
                <div>
                    <label class="mr-2">Post Visibility:</label>
                    <label><input type="radio" name="visibility" value="public" checked class="mr-1"> Public</label>
                    <label class="ml-4"><input type="radio" name="visibility" value="private" class="mr-1"> Private</label>
                </div>
                <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Save Post</button>
            </form>
        </div>
</body>
</html>