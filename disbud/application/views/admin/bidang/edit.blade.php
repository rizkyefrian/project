@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Ubah Data Bidang')
@section('sidebar_title', 'Ubah Data Bidang')
@section('user_image', 'images/img.jpg')
@section('username', 'Mandan')
@section('content_title', 'Ubah Data Bidang')

@section('content')
	<form method="POST" action="{{ site_url('admin/bidang/edit') }}">    
    
    @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nip', 'class' => 'form-control', 'max' => 50, 'label' => 'NIP', 'value' => $detail['nip']]])	
    @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'bidang', 'class' => 'form-control', 'max' => 50, 'label' => 'Bidang', 'value' => $detail['bidang']]])	
    @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nama', 'class' => 'form-control', 'max' => 50, 'label' => 'Nama', 'value' => $detail['nama']]])	
    
    @include('components.form.button', ['_data' => ['type' => 'submit', 'text' => 'Simpan', 'class' => 'btn btn-primary']])
    @include('components.form.button', ['_data' => ['type' => 'reset', 'text' => 'Batal', 'class' => 'btn btn-danger']])
    @include('components.form.input', ['_data' => ['type' => 'hidden', 'name' => 'id', 'value' => $detail['id']]])
  </form>
@endsection
