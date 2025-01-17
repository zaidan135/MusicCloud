<x-apps-layout>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Upload Musik Baru</h2>

        <form action="{{ route('music.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Music Details -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Lagu</label>
                <input type="text" id="title" name="title" class="mt-1 p-2 block w-full border rounded-md" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="writer" class="block text-sm font-medium text-gray-700">Penulis</label>
                    <input type="text" id="writer" name="writer" class="mt-1 p-2 block w-full border rounded-md">
                </div>
                <div>
                    <label for="singer" class="block text-sm font-medium text-gray-700">Penyanyi</label>
                    <input type="text" id="singer" name="singer" class="mt-1 p-2 block w-full border rounded-md">
                </div>
                <div>
                    <label for="composer" class="block text-sm font-medium text-gray-700">Komposer</label>
                    <input type="text" id="composer" name="composer" class="mt-1 p-2 block w-full border rounded-md">
                </div>
            </div>

            <div class="mb-4">
                <label for="genre" class="block text-sm font-medium text-gray-700">Genre</label>
                <input type="text" id="genre" name="genre" class="mt-1 p-2 block w-full border rounded-md">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="description" name="description" rows="3" class="mt-1 p-2 block w-full border rounded-md"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="release_date" class="block text-sm font-medium text-gray-700">Tanggal Rilis</label>
                    <input type="date" id="release_date" name="release_date" class="mt-1 p-2 block w-full border rounded-md">
                </div>
            </div>

            <hr class="my-6 border-t">

            <!-- Music Post -->
            <div class="mb-4">
                <label for="music_file" class="block text-sm font-medium text-gray-700">File Musik</label>
                <input type="file" id="music_file" name="music_file" class="mt-1 p-2 block w-full border rounded-md" accept="audio/*" required>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Cover Gambar</label>
                <input type="file" id="image" name="image" class="mt-1 p-2 block w-full border rounded-md" accept="image/*">
            </div>

            <x-primary-button type="submit" class="w-full flex justify-center text-white p-3 rounded-lg font-semibold">Upload Musik</x-primary-button>
        </form>
    </div>
</x-apps-layout>
