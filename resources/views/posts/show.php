<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Post Detail</title>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl bg-white p-8 rounded shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Post Detail</h1>

        <!-- Post Details -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold mb-4 text-blue-600"><?= $post['title'] ?? 'Title not available' ?></h2>
            <p class="text-gray-600 mb-2"><?= $post['author'] ?? 'author not available' ?></p>
            <p class="text-gray-600 mb-2">Category: Technology</p>
            <p class="text-gray-600 mb-2">Status: Published</p>
            <p class="text-gray-600 mb-2">Content: Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
            <div class="mb-4">
                <img src="http://localhost:8000/public/posts/image/<?=  $post['image'] ?? 'author not available' ?>" alt="<?= $post['image'] ?? 'author not available' ?>" class="w-full h-auto rounded shadow-lg">
            </div>
            <div class="mb-4">
                <video controls class="w-full rounded shadow-lg">
                    <source src="http://localhost:8000/public/posts/video/<?=  $post['video'] ?? 'author not available' ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center">
            <a href="/posts" class="text-blue-500 hover:underline">Back to Posts</a>
        </div>
    </div>
</body>
</html>
