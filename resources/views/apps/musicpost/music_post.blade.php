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

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="release_date" class="block text-sm font-medium text-neutral-400">Tanggal Rilis</label>
                    <input type="date" id="release_date" name="release_date" class="mt-1 p-2 block w-full border rounded-md">
                </div>
            </div>

            <div class="mb-6">
                <label for="music_file" class="block text-sm font-semibold text-white mb-2">File Musik</label>
                <div id="music-drop-area" class="relative flex items-center justify-center w-full h-40 border-2 border-dashed border-gray-500 rounded-lg cursor-pointer hover:border-blue-500 transition duration-300">
                    <input type="file" id="music_file" name="music_file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="audio/*" required>
                    <div class="flex flex-col items-center" id="music-preview">
                        <p class="text-sm text-gray-400 mt-2">Seret dan lepas atau klik untuk unggah musik</p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-semibold text-white mb-2">Cover Gambar</label>
                <div id="image-drop-area" class="relative flex items-center justify-center w-full h-40 border-2 border-dashed border-gray-500 rounded-lg cursor-pointer hover:border-green-500 transition duration-300">
                    <input type="file" id="image" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                    <div class="flex flex-col items-center" id="image-preview">
                        <p class="text-sm text-gray-400 mt-2">Seret dan lepas atau klik untuk unggah gambar</p>
                    </div>
                </div>
            </div>

            <x-primary-button type="submit" class="w-full flex justify-center text-white p-3 rounded-lg font-semibold">Upload Musik</x-primary-button>
        </form>
    </div>

    <script>
        document.getElementById('music_file').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('music-preview');
            if (file) {
                preview.innerHTML = `<p class='text-sm text-green-400 mt-2'>${file.name}</p>`;
            }
        });

        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="w-32 h-32 object-cover rounded-lg">`;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
