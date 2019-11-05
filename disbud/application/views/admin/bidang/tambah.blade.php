@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Tambah Data Bidang')
@section('sidebar_title', 'Tambah Data Bidang')
@section('user_image', 'images/img.jpg')
@section('username', 'Mandan')
@section('content_title', 'Tambah Data Bidang')

@section('content')
    
	<form method="POST" action="{{ site_url('admin/bidang/tambah') }}">
    @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nip', 'class' => 'form-control', 'max' => 50, 'label' => 'NIP']])	
    @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'bidang', 'class' => 'form-control', 'max' => 50, 'label' => 'Bidang']])	
    @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nama', 'class' => 'form-control', 'max' => 50, 'label' => 'Nama']])	
    @include('components.form.button', ['_data' => ['type' => 'submit', 'text' => 'Simpan', 'class' => 'btn btn-primary']])
    @include('components.form.button', ['_data' => ['type' => 'reset', 'text' => 'Batal', 'class' => 'btn btn-danger']])
  </form>
@endsection
