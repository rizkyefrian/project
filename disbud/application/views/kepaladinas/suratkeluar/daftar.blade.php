@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Surat Keluar')
@section('sidebar_title', 'Surat Keluar')
@section('user_image', 'images/img.jpg')
@section('username', 'Mandan')
@section('content_title', 'Surat Keluar')

@section('content')
  <div class="table-responsive">
    <div style="overflow:auto; max-height:650px; margin:0px 0 0px 0;">
      <table class="table table-bordered table-stripped">
        <tr>
          <th>No</th>
          <th>Info Surat</th>
          <th>Isi Surat</th>
        </tr>
        @foreach($data_list as $nomor => $data)
          <tr>
            <td>{{ ($nomor+1) }}</td>
             <td style="width: 450px;">
              <table style="padding: 5px;">
                <tr>
                  <td style="vertical-align: top;padding: 5px;">Nomor Surat</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">{{ $data['nomorsk'] }}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;padding: 5px;">Bidang yang Mengeluarkan</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">{{ $data['bidang'] }}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;padding: 5px;">Tanggal Surat</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">{{ TanggalIndo($data['tglsurat']) }}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;padding: 5px;">Alamat</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">{{ $data['alamat'] }}</td>
                </tr>
              </table>  
            </td>
            <td>
              <table style="padding: 5px;">
                <tr>
                  <td style="vertical-align: top;padding: 5px;">Judul Surat</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">{{ $data['judulsurat'] }}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;padding: 5px;">Perihal Surat</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">{{ $data['perihal'] }}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;padding: 5px;">Tujuan Surat</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">{{ $data['tujuan'] }}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;padding: 5px;">Catatan</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">{{ $data['catatan'] }}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;padding: 5px;">File Surat</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">
                    <a href="{{ base_url() }}assets/images/{{ $data['filesurat'] }}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Unduh Surat</a>
                  </td>
                </tr>
              </table>  
            </td>
      
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection
