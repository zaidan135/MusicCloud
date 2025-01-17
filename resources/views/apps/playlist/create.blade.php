<x-app-layout>
    <div class="p-6 bg-primary text-white">
        <h1 class="text-2xl font-bold mb-4">Buat Playlist Baru</h1>
        
        <form method="POST" action="{{ route('playlist.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <label>
                    <span>Nama Playlist:</span>
                    <input type="text" name="name" class="w-full rounded-lg p-2 bg-gray-800 text-white" required>
                </label>
                <label>
                    <span>Deskripsi Playlist:</span>
                    <textarea name="description" class="w-full rounded-lg p-2 bg-gray-800 text-white"></textarea>
                </label>
                <label>
                    <span>Gambar Playlist (Opsional):</span>
                    <input type="file" name="image" class="w-full rounded-lg p-2 bg-gray-800 text-white">
                </label>
            </div>
            <button type="submit" class="mt-6 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">
                Buat Playlist
            </button>
        </form>
    </div>
</x-app-layout>
