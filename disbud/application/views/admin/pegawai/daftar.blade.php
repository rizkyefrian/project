@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Pegawai')
@section('sidebar_title', 'Pegawai')
@section('user_image', 'images/img.jpg')
@section('username', 'Mandan')
@section('content_title', 'Pegawai')

@section('content')
  <button type="button" onclick="showModalTambah()" class="btn btn-primary">Tambah Data</button>
  <div class="table-responsive">
    <div style="overflow:auto; max-height:650px; margin:0px 0 0px 0;">
      <table class="table table-bordered table-stripped">
        <thead>
        <tr>
          <th>No</th>
          <th>NIP</th>
          <th>Nama</th>
          <th>Tempat Lahir</th>
          <th>Tanggal Lahir</th>
          <th>Jenis Kelamin</th>
          <th>Alamat</th>
          <th>Status</th>
          <th>NoHP</th>
          <th>Email</th>
          <th>Jabatan</th>
          <th>Golongan</th>
          <th>Level</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data_list as $nomor => $data)
          <tr>
            <td>{{ ($nomor+1) }}</td>
            <td>{{ $data['nip'] }}</td>
            <td>{{ $data['nama'] }}</td>
            <td>{{ $data['tempatlhr'] }}</td>
            <td>{{ TanggalIndo($data['tgllahir']) }}</td>
            <td>{{ $data['jeniskelamin'] }}</td>
            <td>{{ $data['alamat'] }}</td>
            <td>{{ $data['status'] }}</td>
            <td>{{ $data['hp'] }}</td>
            <td>{{ $data['email'] }}</td>
            <td>{{ $data['jabatan'] }}</td>
            <td>{{ $data['gol'] }}</td>
            <td>{{ $data['level'] }}</td>
            <td>
              <button type="button" onclick="showModalEdit({{ $nomor }})" class="btn btn-success">Edit</button>
              <button type="button" onclick="showConfirmationDelete('<?=site_url("admin/pegawai/hapus?id=".$data['id'])?>')" class="btn btn-danger">Hapus</button>
            </td>
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
      elName("nip")[0].value = "";
      elName("nama")[0].value = "";
      elName("tempatlhr")[0].value = "";
      elName("tgllahir")[0].value = "";
      elName("jeniskelamin")[0].value = "";
      elName("alamat")[0].value = "";
      elName("status")[0].value = "";
      elName("hp")[0].value = "";
      elName("email")[0].value = "";
      elName("jabatan")[0].value = "";
      elName("gol")[0].value = "";
      elName("level")[0].value = "";
      elName("password")[0].value = "";
      elId("foto").innerHTML = "";
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
      elId("form_modal").action = "{{ site_url('admin/pegawai/tambah') }}";
      showModal("#modal");
    }
    
    function showModalEdit(id)
    {
      resetModal();
      elId("judul_modal").innerHTML = "Edit Data";
      var detail = data[id]; 
      elId("form_modal").action = "{{ site_url('admin/pegawai/edit') }}";
      elName("id")[0].value = detail.id;
      elName("nip")[0].value = detail.nip;
      elName("nama")[0].value = detail.nama;
      elName("tempatlhr")[0].value = detail.tempatlhr;
      elName("tgllahir")[0].value = detail.tgllahir;
      elName("jeniskelamin")[0].value = detail.jeniskelamin;
      elName("alamat")[0].value = detail.alamat
      elName("status")[0].value = detail.status;
      elName("hp")[0].value = detail.hp;
      elName("email")[0].value = detail.email;
      elName("jabatan")[0].value = detail.jabatan;
      elName("gol")[0].value = detail.gol;
      elName("level")[0].value = detail.level;
      elName("password")[0].value = detail.password;
      
      if(detail.foto != "")
      {
        elId("foto").innerHTML = "<small>*Upload foto baru untuk mengganti foto lama.</small> <br> <img src='{{ base_url().'assets/images/' }}" + detail.foto + "' width='300' height='300' />"
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
          <form id="form_modal" method="POST" action="{{ site_url('admin/bidang/tambah') }}" enctype='multipart/form-data'>
            <input type="hidden" name="id">
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nip', 'class' => 'form-control', 'max' => 50, 'label' => 'NIP']])	
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nama', 'class' => 'form-control', 'max' => 50, 'label' => 'Nama']])
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'tempatlhr', 'class' => 'form-control', 'max' => 30, 'label' => 'Tempat Lahir']])	
            @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tgllahir', 'class' => 'form-control', 'max' => 12, 'label' => 'Tanggal Lahir']])
            @include('components.form.input', ['_data' => ['type' => 'email', 'name' => 'email', 'class' => 'form-control', 'max' => 50, 'label' => 'Email']])
            @include('components.form.select', ['_data' => ['name' => 'jeniskelamin', 'class' => 'form-control', 'label' => 'Jenis Kelamin', 'val' => 'value', 'caption' => 'value', 'options' => [
              ['value' => 'Laki-laki'],
              ['value' => 'Perempuan']
            ]]])	
            @include('components.form.textarea', ['_data' => ['name' => 'alamat', 'class' => 'form-control', 'label' => 'Alamat']])	
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'status', 'class' => 'form-control', 'max' => 40, 'label' => 'Status']])	
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'hp', 'class' => 'form-control', 'max' => 15, 'label' => 'NoHP']])	
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'jabatan', 'class' => 'form-control', 'max' => 50, 'label' => 'Jabatan']])	
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'gol', 'class' => 'form-control', 'max' => 25, 'label' => 'Golongan']])	
            @include('components.form.select', ['_data' => ['name' => 'level', 'class' => 'form-control', 'label' => 'Level', 'val' => 'value', 'caption' => 'value', 'options' => [
              ['value' => 'Admin'],
              ['value' => 'Kepala Dinas'],
              ['value' => 'Kepala Bidang'],
              ['value' => 'Pegawai']
            ]]])	
            @include('components.form.input', ['_data' => ['type' => 'password', 'name' => 'password', 'class' => 'form-control', 'max' => 12, 'label' => 'Password']])	
            <div class="form-group">
              <label>Foto</label>
              <br>
              <p id="foto"></p>
              <input type="file" name="foto" class="form-control" />
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
