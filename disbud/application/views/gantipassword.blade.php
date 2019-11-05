@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Ganti Password')
@section('sidebar_title', 'Ganti Password')
@section('user_image', 'images/img.jpg')
@section('username', 'Ganti Password')
@section('content_title', 'Ganti Password')

@section('content')
<p>Anda akan otomatis logout setelah mengganti password dan dapat login kembali dengan password baru tersebut.</p>
<form method="POST">
  <input type="hidden" name="id" value="<?=$_SESSION['id']?>">
  @include('components.form.input', ['_data' => ['type' => 'password', 'name' => 'password_lama', 'class' => 'form-control', 'label' => 'Password Lama']])	
  @include('components.form.input', ['_data' => ['type' => 'password', 'name' => 'password_baru', 'class' => 'form-control', 'label' => 'Password Baru']])	
  @include('components.form.input', ['_data' => ['type' => 'password', 'name' => 'password_baru_cek', 'class' => 'form-control', 'label' => 'Ulangi Password Baru']])	
  <button type="submit" class="btn btn-primary">Ganti Password</button>
</form>
@endsection
