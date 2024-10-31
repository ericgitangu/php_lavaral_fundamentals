<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-white">
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-6">Posts</h1>

        <!-- Button to Open Create Modal -->
        <button onclick="openCreateModal()" class="px-4 py-2 bg-green-500 text-white rounded mb-4">Create New
            Post</button>

        <!-- No Posts Message -->
        @if ($posts->isEmpty())
            <p class="text-center text-gray-600 dark:text-gray-400">No posts found.</p>
        @else
            <!-- Post Feed -->
            <div id="post-feed">
                @foreach($posts as $post)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-4">
                        <h2 class="text-lg font-semibold">{{ $post->title }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">by {{ $post->user->name }}</p>
                        <p class="mt-2">{{ $post->content }}</p>
                        <!-- Edit and Delete Buttons -->
                        <div class="flex mt-4 space-x-2">
                            <button
                                onclick="openEditModal('{{ $post->id }}', '{{ addslashes($post->title) }}', '{{ addslashes($post->content) }}')"
                                class="px-4 py-2 bg-blue-500 text-white rounded">Edit</button>
                            <button onclick="openDeleteModal('{{ $post->id }}')"
                                class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Create Modal -->
    <div id="createModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
            <h2 class="text-lg font-semibold mb-4">Create Post</h2>
            <form id="createForm" method="POST" action="{{ route('posts.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="createTitle" class="block font-semibold text-gray-800 dark:text-white">Title:</label>
                    <input type="text" id="createTitle" name="title" class="w-full p-2 rounded border dark:bg-gray-700"
                        required>
                </div>
                <div class="mb-4">
                    <label for="createContent"
                        class="block font-semibold text-gray-800 dark:text-white">Content:</label>
                    <textarea id="createContent" name="content" class="w-full p-2 rounded border dark:bg-gray-700"
                        required></textarea>
                </div>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Create</button>
                <button type="button" onclick="closeCreateModal()"
                    class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
            <h2 class="text-lg font-semibold mb-4">Edit Post</h2>
            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" id="postId">
                <div class="mb-4">
                    <label for="editTitle" class="block font-semibold">Title:</label>
                    <input type="text" id="editTitle" name="title" class="w-full p-2 rounded border dark:bg-gray-700"
                        required>
                </div>
                <div class="mb-4">
                    <label for="editContent" class="block font-semibold">Content:</label>
                    <textarea id="editContent" name="content" class="w-full p-2 rounded border dark:bg-gray-700"
                        required></textarea>
                </div>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Save Changes</button>
                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
            <h2 class="text-lg font-semibold mb-4">Delete Post</h2>
            <p>Are you sure you want to delete this post?</p>
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
                <button type="button" onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>

        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
        }

        function openEditModal(id, title, content) {
            document.getElementById('editForm').action = `/posts/${id}`;
            document.getElementById('postId').value = id;
            document.getElementById('editTitle').value = title;
            document.getElementById('editContent').value = content;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function openDeleteModal(id) {
            document.getElementById('deleteForm').action = `/posts/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</body>

</html>