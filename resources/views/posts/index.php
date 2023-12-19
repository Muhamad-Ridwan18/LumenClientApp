
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Posts Table</title>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-8">Posts Table</h1>
        <button id="createDataBtn" class="bg-green-500 text-white px-4 py-2 mb-2 rounded hover:bg-green-700">Create Data</button>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full border bg-white">
                <thead>
                    <tr>
                        <th class="border p-4">Title</th>
                        <th class="border p-4">Author</th>
                        <th class="border p-4">Category</th>
                        <th class="border p-4">Status</th>
                        <th class="border p-4">Content</th>
                        <th class="border p-4">Image</th>
                        <th class="border p-4">Video</th>
                        <th class="border p-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data (Replace with your dynamic data) -->
                    <?php if ($posts): ?>
                         <?php foreach ($posts['data'] as $post): ?>
                              <tr>
                                   <td class="border p-4"><?= $post['title'] ?? 'Title not available' ?></td>
                                   <td class="border p-4"><?= $post['author'] ?? 'Title not available' ?></td>
                                   <td class="border p-4"><?= $post['category'] ?? 'Title not available' ?></td>
                                   <td class="border p-4"><?= $post['status'] ?? 'Title not available' ?></td>
                                   <td class="border p-4"><?= $post['content'] ?? 'Title not available' ?></td>
                                   <td class="border p-4"><img src="http://localhost:8000/public/posts/image/<?= $post['image'] ?? 'Title not available' ?>" alt="" style="width:100px;"></td>
                                   <td class="border p-4"><video src="http://localhost:8000/public/posts/video/<?= $post['video'] ?? 'Title not available' ?>" alt="" style="width:100px;"></video></td>
                                   <td class="border p-4">
                                        <a href="/posts/<?= $post['id'] ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">View</a>
                                   </td>
                              </tr>
                         <?php endforeach; ?>
                    <?php else: ?>
                         <p>No posts available.</p>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>


    <div id="createModal" class="fixed inset-0 z-10 bg-gray-500 bg-opacity-75 transition-opacity hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Create New Post</h3>
                    <!-- Customize the content for creating a new post -->
                    <div class="mt-2">
                        <!-- Add form fields for creating a new post -->
                        <label for="title" class="block mb-2">Title:</label>
                        <input type="text" id="title" name="title" class="w-full border p-2 mb-4" required>

                        <label for="author" class="block mb-2">Author:</label>
                        <input type="text" id="author" name="author" class="w-full border p-2 mb-4" required>

                        <label for="category" class="block mb-2">Category:</label>
                        <input type="text" id="category" name="category" class="w-full border p-2 mb-4" required>

                        <label for="status" class="block mb-2">Status:</label>
                        <input type="text" id="status" name="status" class="w-full border p-2 mb-4" required>

                        <label for="content" class="block mb-2">Content:</label>
                        <textarea id="content" name="content" class="w-full border p-2 mb-4" required></textarea>

                        <label for="image" class="block mb-2">Image:</label>
                        <input type="file" id="image" name="image" class="w-full border p-2 mb-4">

                        <label for="video" class="block mb-2">Video:</label>
                        <input type="file" id="video" name="video" class="w-full border p-2 mb-4">

                        <!-- Add other form fields as needed -->
                    </div>
                    </div>
                </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Create</button>
                <button id="closeModal" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                </div>
            </div>
            </div>
        </div>
        </div>

    <script>
        // Get elements
        const createDataBtn = document.getElementById('createDataBtn');
        const createModal = document.getElementById('createModal');
        const closeModalBtn = document.getElementById('closeModal');
        const createPostForm = document.getElementById('createPostForm');

        // Show modal when the "Create Data" button is clicked
        createDataBtn.addEventListener('click', () => {
            createModal.classList.remove('hidden');
        });

        // Close modal when the "Close" button is clicked
        closeModalBtn.addEventListener('click', () => {
            createModal.classList.add('hidden');
        });

        // Handle form submission (you can use AJAX to send data to the server)
        createPostForm.addEventListener('submit', (event) => {
            event.preventDefault();
            // Add logic to send form data to the server (e.g., using fetch or XMLHttpRequest)
            // After successfully creating a post, you may want to close the modal and update the table
            createModal.classList.add('hidden');
        });
    </script>

</body>
</html>


