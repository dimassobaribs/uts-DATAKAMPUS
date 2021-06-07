@extends('layouts.app', ['title' => 'Tambah Post'])

@section('content')

<div class="container mx-auto mt-10 mb-10">
    <div class="bg-white p-5 rounded shadow-sm">
        <form action="{{ route('post.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mt-5">
                <label>NAMA MAHASISWA</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                class="w-full bg-gray-200 p-2 rounded shadow-sm border border-gray-200 focus:outline-none focus:bg-white mt-2"
                placeholder="Masukan nama">
                @error('nama')
                    <div class="bg-red-400 p-2 shadow-sm rounded mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mt-5">
                <label>ALAMAT</label>
                <input type="text" name="alamat" value="{{ old('alamat') }}"
                class="w-full bg-gray-200 p-2 rounded shadow-sm border border-gray-200 focus:outline-none focus:bg-white mt-2"
                placeholder="judul post">
                @error('alamat')
                    <div class="bg-red-400 p-2 shadow-sm rounded mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mt-5">
                <label>KONTAK</label>
                <input type="text" name="kontak" value="{{ old('kontak') }}"
                class="w-full bg-gray-200 p-2 rounded shadow-sm border border-gray-200 focus:outline-none focus:bg-white mt-2"
                placeholder="kontak">
                @error('kontak')
                    <div class="bg-red-400 p-2 shadow-sm rounded mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mt-5">
                <button type="submit"
                    class="bg-indigo-500 text-white p-2 rounded shadow-sm focus:outline-none hover:bg-indigo-700">SIMPAN POST</button>
            </div>

        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>

@endsection