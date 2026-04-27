@extends('errors.layout')

@section('title', 'Halaman Tidak Ditemukan')
@section('code', '404')
@section('message', 'Opps! Nyasar Ya?')

@section('icon')
<svg class="w-12 h-12 text-[#6C3DE3]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
@endsection

@section('description')
Halaman yang kamu cari nggak ada nih bro. Mungkin link-nya salah atau halamannya sudah dipindah ke tempat lain.
@endsection
