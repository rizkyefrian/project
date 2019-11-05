@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Beranda')
@section('sidebar_title', 'Beranda')
@section('user_image', 'images/img.jpg')
@section('username', 'Mandan')
@section('content_title', '')

@section('content')
 <h1>Selamat Datang!</h1>
  <div class="row">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
    <div class="icon"><i class="fa fa-caret-square-o-right"></i>
    </div>
    <div class="count">{{ $belum }}</div>
    <h3><a href="{{ site_url('admin/suratmasuk') }}">Surat Masuk</a></h3>
    <p>Belum Di Disposisi</p>
    </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
    <div class="icon"><i class="fa fa-comments-o"></i>
    </div>
    <div class="count">{{ $acc }}</div>
    <h3><a href="{{ site_url('admin/suratmasuk') }}">Surat Masuk</a></h3>
    <p>Diacc</p>
    </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
    <div class="icon"><i class="fa fa-sort-amount-desc"></i>
    </div>
    <div class="count">{{ $ditolak }}</div>
    <h3><a href="{{ site_url('admin/suratmasuk') }}">Surat Masuk</a></h3>
    <p>Ditolak</p>
    </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
    <div class="icon"><i class="fa fa-check-square-o"></i>
    </div>
    <div class="count">{{ $keluar }}</div>
    <h3><a href="{{ site_url('kabid/suratkeluar') }}">Surat Keluar</a></h3>
    <p>Diterbikan</p>
    </div>
    </div>
    <div align="center">
            <img src="{{ base_url() }}assets/images/Dinas-Komunikasi-dan-Informatika_080419034154.jpeg" width="500" height="250" align="center">
    
    </div>
<!--     <div class=disbud-slider>
        <div class=isi-slider>
            <img src="{{ base_url() }}assets/images/disbud.jpg" width="500" height="250" align="center">
            <img src="{{ base_url() }}assets/images/logo-padang.png" align="center">
            <img src="{{ base_url() }}assets/images/logo-disbud.png" align="center">
        </div>
    </div> -->
    <div>
    </br></br>
    <table>

          <tr>
            <td align="left"><span style="font-size:15px; font-weight: bold">Visi</span></br>
            <span style="font-size:13px; font-style: italic;">Terwujudnya Tata Kehidupan yang Berbudaya Berdasarkan Falsafah “Adat Basandi Syarak, Syarak Basandi Kitabullah"</span></br></td>
          </tr>
        <tr>
            <td align="left"><span style="font-size:15px; font-weight: bold">Misi</span></br>
            <span style="font-size:13px; font-style: italic;">1. Meningkatkan penguatan dan pelestarian adat & nilai-nilai tradisional</span></br>
            <span style="font-size:13px; font-style: italic;">2. Mewujudkan penelusuran dan penulisan Sejarah Minangkabau</span></br>
            <span style="font-size:13px; font-style: italic;">3. Meningkatkan pengembangan dan pelestarian budaya</span></br>
            <span style="font-size:13px; font-style: italic;">4. Meningkatkan pengembangan dan perlindungan Bahasa Minangkabau</span></br>
            <span style="font-size:13px; font-style: italic;">5. Meningkatkan perlindungan warisan budaya dan cagar budaya</span></br></td>
          </tr>    
    </table>
    </div>

@endsection
