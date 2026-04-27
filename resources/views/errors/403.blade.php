@extends('errors.layout')

@section('title', 'Akses Dilarang')
@section('code', '403')
@section('message', 'Eits! Nggak Boleh Masuk.')

@section('icon')
<svg class="w-12 h-12 text-[#6C3DE3]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002-2zm10-10V7a4 4 0 00-8 0v4h8z" />
</svg>
@endsection

@section('description')
Kamu nggak punya izin buat akses halaman ini bro. Pastikan kamu sudah login dengan akun yang benar.
@endsection
