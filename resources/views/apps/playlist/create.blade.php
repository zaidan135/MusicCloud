<x-app-layout>
    <div class="p-6">
        <h2 class="text-2xl font-bold text-neutral-300 mb-4">Buat Playlist Baru</h2>

        <form action="{{ route('playlist.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-neutral-400">Nama Playlist</label>
                <input type="text" id="name" name="name" class="mt-1 p-2 block w-full border rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-neutral-400">Deskripsi</label>
                <textarea id="description" name="description" rows="3" class="mt-1 p-2 block w-full border rounded-md"></textarea>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-semibold text-white mb-2">Cover Gambar (Opsional)</label>
                <div id="image-drop-area" class="relative flex items-center justify-center w-full h-40 border-2 border-dashed border-gray-500 rounded-lg cursor-pointer hover:border-green-500 transition duration-300">
                    <input type="file" id="image" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                    <div class="flex flex-col items-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="9" cy="9" r="2"></circle>
                            <path d="M21 15l-5-5L5 21"></path>
                        </svg>
                        <p class="text-sm text-gray-400 mt-2">Seret dan lepas atau klik untuk unggah gambar</p>
                    </div>
                </div>
            </div>

            <x-primary-button type="submit" class="w-full flex justify-center text-white p-3 rounded-lg font-semibold">Buat Playlist</x-primary-button>
        </form>
    </div>
</x-app-layout>
