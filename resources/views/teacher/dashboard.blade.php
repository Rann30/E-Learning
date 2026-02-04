@extends('teacher.layouts.app')


@section('title','Dashboard Guru')


@section('content')
<h2 class="text-2xl font-bold mb-6">Dashboard Guru</h2>


<div class="grid md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-slate-500">Total Kelas</p>
        <p class="text-3xl font-bold">{{ $courseCount }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-slate-500">Total Tugas</p>
        <p class="text-3xl font-bold">{{ $assignmentCount }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-slate-500">Akun</p>
        <p class="font-semibold">{{ auth()->user()->name }}</p>
    </div>
</div>
@endsection