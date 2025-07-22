@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-white">Create Karyawan</h1>

    <form action="{{ route('karyawans.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="nama" class="block text-sm font-medium text-white">Nama</label>
            <input type="text" name="nama" id="nama" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm" required>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-white">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm" required>
        </div>

        <div>
            <label for="alamat" class="block text-sm font-medium text-white">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm" required>
        </div>

        <div>
            <label for="telepon" class="block text-sm font-medium text-white">Telepon</label>
            <input type="text" name="telepon" id="telepon" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm" required>
        </div>

        <div>
            <label for="jabatan" class="block text-sm font-medium text-white">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm" required>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('karyawans.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Cancel</a>
            <button type="submit" name="another" value="1" class="bg-indigo-600 text-white px-4 py-2 rounded">Create & Create Another</button>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create</button>
        </div>
    </form>
</div>
@endsection
