<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Container for the posts -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-4">Latest Posts</h3>
                    <div id="posts-container">Loading posts...</div> <!-- Placeholder -->
                    <a href="/posts" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded">View All
                        Posts</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("{{ route('api.posts') }}")
                .then(response => response.json())
                .then(posts => {
                    const container = document.getElementById('posts-container');
                    container.innerHTML = ""; // Clear loading text

                    if (posts.length === 0) {
                        container.innerHTML = "<p>No posts available.</p>";
                        return;
                    }

                    posts.forEach(post => {
                        const postElement = document.createElement('div');
                        postElement.classList.add('mb-4', 'border', 'p-4', 'rounded');
                        postElement.innerHTML = `
                            <h2 class="text-xl font-bold">${post.title}</h2>
                            <p>${post.content}</p>
                            <p class="text-sm text-gray-500">by ${post.user.name}</p>
                        `;
                        container.appendChild(postElement);
                    });
                })
                .catch(error => {
                    console.error('Error fetching posts:', error);
                    document.getElementById('posts-container').innerHTML = "<p>Error loading posts.</p>";
                });
        });
    </script>
</x-app-layout>