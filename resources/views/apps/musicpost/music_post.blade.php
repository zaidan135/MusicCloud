<x-app-layout>
    <div class="p-6">
        <h2 class="text-2xl font-bold text-neutral-300 mb-4">Upload Musik Baru</h2>

        <form action="{{ route('music.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Music Details -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-neutral-400">Judul Lagu</label>
                <input type="text" id="title" name="title" class="mt-1 p-2 block w-full border rounded-md" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="writer" class="block text-sm font-medium text-neutral-400">Penulis</label>
                    <input type="text" id="writer" name="writer" class="mt-1 p-2 block w-full border rounded-md">
                </div>
                <div>
                    <label for="singer" class="block text-sm font-medium text-neutral-400">Penyanyi</label>
                    <input type="text" id="singer" name="singer" class="mt-1 p-2 block w-full border rounded-md">
                </div>
                <div>
                    <label for="composer" class="block text-sm font-medium text-neutral-400">Komposer</label>
                    <input type="text" id="composer" name="composer" class="mt-1 p-2 block w-full border rounded-md">
                </div>
            </div>

            <div class="mb-4">
                <label for="genre" class="block text-sm font-medium text-neutral-400">Genre</label>
                <input type="text" id="genre" name="genre" class="mt-1 p-2 block w-full border rounded-md">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-neutral-400">Deskripsi</label>
                <textarea id="description" name="description" rows="3" class="mt-1 p-2 block w-full border rounded-md"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="release_date" class="block text-sm font-medium text-neutral-400">Tanggal Rilis</label>
                    <input type="date" id="release_date" name="release_date" class="mt-1 p-2 block w-full border rounded-md">
                </div>
            </div>

            <hr class="my-6 border-t">

            <!-- Music Post -->
            <div class="mb-6">
                <label for="music_file" class="block text-sm font-semibold text-white mb-2">File Musik</label>
                <div id="music-drop-area" class="relative flex items-center justify-center w-full h-40 border-2 border-dashed border-gray-500 rounded-lg cursor-pointer hover:border-blue-500 transition duration-300">
                    <input type="file" id="music_file" name="music_file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="audio/*" required>
                    <div class="flex flex-col items-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 18V5l12-2v13"></path>
                            <circle cx="6" cy="18" r="3"></circle>
                            <circle cx="18" cy="16" r="3"></circle>
                        </svg>
                        <p class="text-sm text-gray-400 mt-2">Seret dan lepas atau klik untuk unggah musik</p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-semibold text-white mb-2">Cover Gambar</label>
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

            <x-primary-button type="submit" class="w-full flex justify-center text-white p-3 rounded-lg font-semibold">Upload Musik</x-primary-button>
        </form>
    </div>
</x-app-layout>
