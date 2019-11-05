@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Bidang')
@section('sidebar_title', 'Bidang')
@section('user_image', 'images/img.jpg')
@section('username', 'Mandan')
@section('content_title', 'Bidang')

@section('content')
<div class="table-responsive">
<div style="overflow:auto; max-height:650px; margin:0px 0 0px 0;">
<table class="table table-bordered table-stripped">
<thead>
  <button type="button" onclick="showModalTambah()" class="btn btn-primary">Tambah Data</button>
  <!-- <table class="table table-bordered table-stripped"> -->
    <tr>
      <th>No</th>
      <th>NIP</th>
      <th>Nama</th>
      <th>Bidang</th>
      <th>Aksi</th>
    </tr>
</thead>
<tbody>
    @foreach($data_list as $nomor => $data)
      <tr>
        <td>{{ ($nomor+1) }}</td>
        <td>{{ $data['nip'] }}</td>
        <td>{{ $data['nama'] }}</td>
        <td>{{ $data['bidang'] }}</td>
        <td>
          <button type="button" onclick="showModalEdit({{ $nomor }})" class="btn btn-success">Edit</button>
          <button type="button" onclick="showConfirmationDelete('<?=site_url("admin/bidang/hapus?id=".$data['nip'])?>')" class="btn btn-danger">Hapus</button>
        </td>
      </tr>
    @endforeach
  </tbody>
  </table>
</div>
</div>

  
  <script>
    var bidang = <?=json_encode($data_list)?>;
    
    function resetModal()
    {
      elId("form_modal").action = "";
      elId("judul_modal").innerHTML = "Tambah Data Baru";
      elName("id")[0].value = "";
      elName("nip")[0].value = "";
      elName("bidang")[0].value = "";
      elName("nama")[0].value = "";
      elName("nip")[0].disabled = false;
    }
    
    function closeModal()
    {
      resetModal();
      hideModal("#modal");
    }
    
    function showModalTambah()
    {
      resetModal();
      elId("form_modal").action = "{{ site_url('admin/bidang/tambah') }}";
      showModal("#modal");
    }
    
    function showModalEdit(id_bidang)
    {
      elId("judul_modal").innerHTML = "Edit Data";
      resetModal();
      var detail = bidang[id_bidang]; 
      elId("form_modal").action = "{{ site_url('admin/bidang/edit') }}";
      elName("id")[0].value = detail.id;
      elName("nip")[0].value = detail.nip;
      elName("nip")[0].disabled = true;
      elName("bidang")[0].value = detail.bidang;
      elName("nama")[0].value = detail.nama;
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
          <form id="form_modal" method="POST" action="{{ site_url('admin/bidang/tambah') }}">
            <input type="hidden" name="id">
            @include('components.form.input', ['_data' => ['type' => 'text', 'max' => 50, 'name' => 'nip', 'class' => 'form-control', 'label' => 'Nip']]) 	
            @include('components.form.input', ['_data' => ['type' => 'text', 'max' => 50, 'name' => 'bidang', 'class' => 'form-control', 'label' => 'Bidang']])	
            @include('components.form.input', ['_data' => ['type' => 'text', 'max' => 50, 'name' => 'nama', 'class' => 'form-control', 'label' => 'Nama']]) 
          
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
