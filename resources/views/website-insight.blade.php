<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Total Blogs</th>
                <th>Total Likes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($postCounts as $postCount )
            <tr>
                <th>$postCount->user_id</th>
                <th>$postCount->userCoolPosts()->get()->count()</th>

            </tr>            
            @endforeach
        </tbody>
    </table>
</body>
</html> -->