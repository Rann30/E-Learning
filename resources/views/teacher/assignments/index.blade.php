@extends('teacher.layouts.app')

@section('title','Daftar Tugas')


@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Daftar Tugas</h2>
    <a href="{{ route('teacher.assignments.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg">+ Buat Tugas</a>
</div>


<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-100">
            <tr>
                <th class="p-3 text-left">Judul</th>
                <th class="p-3">Deadline</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assignments as $assignment)
            <tr class="border-t">
                <td class="p-3">{{ $assignment->title }}</td>
                <td class="p-3 text-center">{{ $assignment->deadline }}</td>
                <td class="p-3 text-center">
                    <a href="#" class="text-blue-600">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection