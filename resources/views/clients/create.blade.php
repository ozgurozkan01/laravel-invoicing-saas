<x-app-layout>
    <div class="max-w-xl mx-auto p-6">
        <h1 class="text-xl font-bold mb-4">Yeni Müşteri</h1>

        <form action="{{ route('clients.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1">İsim</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2">
                @error('name')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1">E-posta</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded p-2">
                @error('email')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1">Telefon</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded p-2">
                @error('phone')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Kaydet</button>
        </form>
    </div>
</x-app-layout>