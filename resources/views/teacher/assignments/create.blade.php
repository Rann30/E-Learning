@extends('teacher.layouts.app')


@section('title','Buat Tugas')


@section('content')
<h2 class="text-2xl font-bold mb-6">Buat Tugas Baru</h2>


<form method="POST" action="{{ route('teacher.assignments.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow max-w-2xl">
    @csrf


    <div class="mb-4">
        <label class="block mb-1">Judul Tugas</label>
        <input name="title" class="w-full border rounded px-3 py-2" required>
    </div>


    <div class="mb-4">
        <label class="block mb-1">Deskripsi</label>
        <textarea name="description" rows="4" class="w-full border rounded px-3 py-2"></textarea>
    </div>


    <div class="mb-4">
        <label class="block mb-1">Deadline</label>
        <input type="datetime-local" name="deadline" class="w-full border rounded px-3 py-2" required>
    </div>


    <div class="mb-4">
        <label class="block mb-1">File (Opsional)</label>
        <input type="file" name="file" class="w-full">
    </div>


    <button class="bg-emerald-600 text-white px-6 py-2 rounded-lg">Simpan Tugas</button>
</form>
@endsection