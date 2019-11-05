@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Laporan Surat Keluar')
@section('sidebar_title', 'Laporan Surat Keluar')
@section('user_image', 'images/img.jpg')
@section('username', 'Laporan Surat Keluar')
@section('content_title', 'Laporan Surat Keluar')

@section('content')
<form method="POST" target="_blank">
  @include('components.form.select', ['_data' => ['name' => 'jenis_laporan', 'class' => 'form-control', 'label' => 'Jenis Laporan', 'val' => 'value', 'caption' => 'value', 'options' => [
    ['value' => 'Harian'],
    ['value' => 'Bulanan'],
    ['value' => 'Tahunan']
  ]]])
  @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tgl', 'class' => 'form-control', 'label' => 'Tanggal/Bulan/Tahun Laporan']])
  <button type="submit" class="btn btn-primary">Cetak Laporan</button>
</form>
@endsection
