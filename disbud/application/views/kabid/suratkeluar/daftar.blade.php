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
@if($_SESSION['level'] != "Kepala Dinas")
  <button type="button" onclick="showModalTambah()" class="btn btn-primary">Tambah Data</button>
@endif
  <div class="table-responsive">
    <div style="overflow:auto; max-height:650px; margin:0px 0 0px 0;">
      <table class="table table-bordered table-stripped">
        <thead>
        <tr>
          <th>No</th>
          <th>Info Surat</th>
          <th>Isi Surat</th>
          @if($_SESSION['level'] != "Kepala Dinas")
          <th>Aksi</th>
          @endif
        </tr>
        </thead>
        <tbody>
        @foreach($data_list as $nomor => $data)
          <tr>
            <td>{{ ($nomor+1) }}</td>
            <td>
              <table style="padding: 5px;">
                <tr>
                  <td style="vertical-align: top;padding: 5px;">Nomor SK</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">{{ $data['nomorsk'] }}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;padding: 5px;">Bidang</td>
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
            @if($_SESSION['level'] != "Kepala Dinas")
            <td>
              <button type="button" onclick="showModalEdit({{ $nomor }})" class="btn btn-success">Edit</button>
              <button type="button" onclick="showConfirmationDelete('<?=site_url("kabid/suratkeluar/hapus?id=".$data['id'])?>')" class="btn btn-danger">Hapus</button>
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
      elName("nomorsk")[0].value = "";
      elName("id_bidang")[0].value = "<?=$_SESSION['id_bidang']?>";
      elName("tglsurat")[0].value = "";
      elName("tujuan")[0].value = "";
      elName("perihal")[0].value = "";
      elName("alamat")[0].value = "";
      elName("catatan")[0].value = "";
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
      elId("form_modal").action = "{{ site_url('kabid/suratkeluar/tambah') }}";
      showModal("#modal");
    }
    
    function showModalEdit(id)
    {
      resetModal();
      elId("judul_modal").innerHTML = "Edit Data";
      var detail = data[id]; 
      elId("form_modal").action = "{{ site_url('kabid/suratkeluar/edit') }}";
      elName("id")[0].value = detail.id;
      elName("nomorsk")[0].value = detail.nomorsk;
      elName("id_bidang")[0].value = detail.id_bidang;
      elName("tglsurat")[0].value = detail.tglsurat;
      elName("tujuan")[0].value = detail.tujuan;
      elName("perihal")[0].value = detail.perihal;
      elName("alamat")[0].value = detail.alamat;
      elName("catatan")[0].value = detail.catatan;
      
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
          <form id="form_modal" method="POST" action="{{ site_url('kabid/suratkeluar/tambah') }}" enctype='multipart/form-data'>
            <input type="hidden" name="id">
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nomorsk', 'class' => 'form-control', 'max' => 50, 'label' => 'Nomor Surat Keluar']])	
            @if($_SESSION['level'] == "Kepala Bidang")
              <input type="hidden" name="id_bidang" />
            @else
              @include('components.form.select', ['_data' => ['name' => 'id_bidang', 'class' => 'form-control', 'label' => 'Bidang', 'val' => 'id', 'caption' => 'bidang', 'options' => $bidang]])
            @endif
            @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tglsurat', 'class' => 'form-control', 'max' => 50, 'label' => 'Tanggal Surat']])
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'tujuan', 'class' => 'form-control', 'max' => 100, 'label' => 'Tujuan Surat']])
            @include('components.form.textarea', ['_data' => ['name' => 'perihal', 'class' => 'form-control', 'label' => 'Perihal Surat']])	
            @include('components.form.textarea', ['_data' => ['name' => 'alamat', 'class' => 'form-control', 'label' => 'Alamat Surat']])	
            @include('components.form.textarea', ['_data' => ['name' => 'catatan', 'class' => 'form-control', 'label' => 'Catatan']])
            
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
