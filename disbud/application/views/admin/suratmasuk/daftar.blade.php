@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Surat Masuk')
@section('sidebar_title', 'Surat Masuk')
@section('user_image', 'images/img.jpg')
@section('username', 'Mandan')
@section('content_title', 'Surat Masuk')

@section('content')
  <!-- if($_SESSION['level'] == "Admin")
  <button type="button" onclick="showModalTambah()" class="btn btn-primary">Tambah Data</button> -->
<div class="table-responsive">
<div style="overflow:auto; max-height:650px; margin:0px 0 0px 0;">
<table class="table table-bordered table-stripped">
<thead>
  @if($_SESSION['level'] == "Admin")
  <button type="button" onclick="showModalTambah()" class="btn btn-primary">Tambah Data</button>
  @endif
        <tr>
          <th>No</th>
          <th>Info Surat</th>
          <th>Isi Surat</th>
          <th>Status</th>
          @if($_SESSION['level'] == "Admin")
          <th>Aksi</th>
          @endif
        </tr>
    </thead>
    <tbody>
        @foreach($data_list as $nomor => $data)
          <tr>
            <td>{{ ($nomor+1) }}</td>
            <td style="width: 450px;">
              <table style="padding: 5px;">
                  <tr>
                    <td style="vertical-align: top;padding: 5px;">Nomor Surat</td>
                    <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                    <td style="vertical-align: top;padding: 5px;">{{ $data['nomorsm'] }}</td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;padding: 5px;">Surat Diteruskan Kepada</td>
                    <td style="vertical-align: top;padding: 5px;padding: 5px 1px;"> : </td>
                    <td style="vertical-align: top;padding: 5px;">{{ $data['bidang'] }}</td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;padding: 5px;">Tanggal Surat</td>
                    <td style="vertical-align: top;padding: 5px;padding: 5px 1px;"> : </td>
                    <td style="vertical-align: top;padding: 5px;">{{ TanggalIndo($data['tglsurat']) }}</td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;padding: 5px;">Tanggal Diterima</td>
                    <td style="vertical-align: top;padding: 5px;padding: 5px 1px;"> : </td>
                    <td style="vertical-align: top;padding: 5px;">{{ TanggalIndo($data['tglditerima']) }}</td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;padding: 5px;">Alamat Surat</td>
                    <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                    <td style="vertical-align: top;padding: 5px;">{{ $data['alamatsurat'] }}, {{ $data['kodepos'] }}</td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;padding: 5px;">Email</td>
                    <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                    <td style="vertical-align: top;padding: 5px;">{{ $data['email'] }}</td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;padding: 5px;">Website</td>
                    <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                    <td style="vertical-align: top;padding: 5px;">{{ $data['website'] }}</td>
                  </tr>
                </table>
            </td>
            <td style="width: 450px;">
              <table style="padding: 5px;">
                <tr>
                  <td style="vertical-align: top;padding: 5px;">Asal Surat</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">{{ $data['asalsurat'] }}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;padding: 5px;">Perihal Surat</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">{{ $data['perihalsurat'] }}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;padding: 5px;">File Surat</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">
                    <a href="{{ base_url() }}assets/images/{{ $data['filesurat'] }}" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Unduh Surat</a>
                  </td>
                </tr>
              </table>
            </td>
            <td>{{ $data['status'] }}</td>
            @if($_SESSION['level'] == "Admin")
            <td>
              <button type="button" onclick="showModalEdit({{ $nomor }})" class="btn btn-success">Edit</button>
              <button type="button" onclick="showConfirmationDelete('<?=site_url("admin/suratmasuk/hapus?id=".$data['id'])?>')" class="btn btn-danger">Hapus</button>
            </td>
            @endif
          </tr>
        @endforeach
      </tbody>
      </table>
    </div>
  </div>

  
  <script>
    var data = <?=json_encode($data_list)?>;
    
    function resetModal()
    {
      elId("form_modal").action = "";
      elName("id")[0].value = "";
      elName("nomorsm")[0].value = "";
      elName("id_bidang")[0].value = "";
      elName("tglsurat")[0].value = "";
      elName("tglditerima")[0].value = "";
      elName("asalsurat")[0].value = "";
      elName("email")[0].value = "";
      elName("perihalsurat")[0].value = "";
      elName("alamatsurat")[0].value = "";
      elName("kodepos")[0].value = "";
      elName("website")[0].value = "";
      elId("filesurat").innerHTML = "";
    }
    
    function closeModal()
    {
      resetModal();
      hideModal("#modal");
    }
    
    function showModalTambah()
    {
      resetModal();
      elId("judul_modal").innerHTML = "Tambah Data Baru";
      elId("form_modal").action = "{{ site_url('admin/suratmasuk/tambah') }}";
      showModal("#modal");
    }
    
    function showModalEdit(id)
    {
      resetModal();
      elId("judul_modal").innerHTML = "Edit Data";
      var detail = data[id]; 
      elId("form_modal").action = "{{ site_url('admin/suratmasuk/edit') }}";
      elName("id")[0].value = detail.id;
      elName("nomorsm")[0].value = detail.nomorsm;
      elName("id_bidang")[0].value = detail.id_bidang;
      elName("tglsurat")[0].value = detail.tglsurat;
      elName("tglditerima")[0].value = detail.tglditerima;
      elName("asalsurat")[0].value = detail.asalsurat;
      elName("email")[0].value = detail.email;
      elName("perihalsurat")[0].value = detail.perihalsurat;
      elName("alamatsurat")[0].value = detail.alamatsurat;
      elName("kodepos")[0].value = detail.kodepos;
      elName("website")[0].value = detail.website;
      
      if(detail.filesurat != "")
      {
        elId("filesurat").innerHTML = "<small>*Upload file baru untuk mengganti file lama.</small> <br> <img src='{{ base_url().'assets/images/' }}" + detail.filesurat + "' width='300' height='300' />"
      }
      
      showModal("#modal");
    }
  </script>
  
  <div class="modal fade hide-modal" id="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="judul_modal">Judul Modal</h4>
        </div>
        <div class="modal-body">
          <form id="form_modal" method="POST" action="{{ site_url('admin/suratmasuk/tambah') }}" enctype='multipart/form-data'>
            <input type="hidden" name="id">
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nomorsm','required' => 'required', 'class' => 'form-control', 'max' => 50,  'label' => 'Nomor Surat Masuk']])	
                      @include('components.form.select', ['_data' => ['name' => 'id_bidang', 'class' => 'form-control', 'label' => 'Bidang Tujuan', 'val' => 'id', 'caption' => 'bidang', 'options' => $bidang]])	
  @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tglsurat','required' => 'required', 'class' => 'form-control', 'max' => 50, 'label' => 'Tanggal Surat']])
            @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tglditerima','required' => 'required', 'class' => 'form-control', 'max' => 50, 'label' => 'Tanggal Diterima']])
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'asalsurat','required' => 'required', 'class' => 'form-control', 'max' => 100, 'label' => 'Asal Surat']])	
            @include('components.form.input', ['_data' => ['type' => 'email', 'name' => 'email', 'class' => 'form-control', 'max' => 100, 'label' => 'Email']])	
            @include('components.form.textarea', ['_data' => ['name' => 'perihalsurat','required' => 'required', 'class' => 'form-control', 'label' => 'Perihal Surat']])	
            @include('components.form.textarea', ['_data' => ['name' => 'alamatsurat', 'class' => 'form-control', 'label' => 'Alamat Surat']])	
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'kodepos', 'class' => 'form-control', 'max' => 10, 'label' => 'Kode Pos']])	
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'website', 'class' => 'form-control', 'max' => 100, 'label' => 'Website']])	
            <input type="hidden" name="ket" value="" />
            <div class="form-group">
              <label>File Surat</label>
              <br>
              <p id="filesurat"></p>
              <input type="file" name="filesurat" class="form-control" />
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="closeModal()">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection
