@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Disposisi Surat Masuk')
@section('sidebar_title', 'Disposisi Surat Masuk')
@section('user_image', 'images/img.jpg')
@section('username', 'Mandan')
@section('content_title', 'Disposisi Surat Masuk')

@section('content')
  <div class="table-responsive">
    <div style="overflow:auto; max-height:650px; margin:0px 0 0px 0;">
      <table class="table table-bordered table-stripped">
        <thead>
        <tr>
          <th>No</th>
          <th>Info Surat</th>
          <th>Isi Surat</th>
          <th>Status</th>
          <th>Disposisi</th>
          <th>Aksi</th>
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
                    <td style="vertical-align: top;padding: 5px;">Bidang</td>
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
                  <td style="vertical-align: top;padding: 5px;">Perihal Surat</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">{{ $data['perihalsurat'] }}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;padding: 5px;">Asal Surat</td>
                  <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                  <td style="vertical-align: top;padding: 5px;">{{ $data['asalsurat'] }}</td>
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
            <td>{{ $data['status'] }}</td>
            <td style="width: 450px;">
              @if($data['status'] != 'Belum Di disposisi')
                <table style="padding: 5px;">
                  <tr>
                    <td style="vertical-align: top;padding: 5px;">Isi Disposisi</td>
                    <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                    <td style="vertical-align: top;padding: 5px;">{{ $data['isidisposisi'] }}</td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;padding: 5px;">Tanggal Disposisi</td>
                    <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                    <td style="vertical-align: top;padding: 5px;">{{ TanggalIndo($data['tgldisposisi']) }}</td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;padding: 5px;">Surat Diteruskan Kepada</td>
                    <td style="vertical-align: top;padding: 5px;padding: 5px 1px;"> : </td>
                    <td style="vertical-align: top;padding: 5px;">{{ $data['bidang'] }}</td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;padding: 5px;">Keterangan</td>
                    <td style="vertical-align: top;padding: 5px 1px;"> : </td>
                    <td style="vertical-align: top;padding: 5px;">{{ $data['ket'] }}</td>
                  </tr>
                </table>
              @endif
            </td>
            <td>
            @if($data['status'] == 'Belum Di disposisi')
              <button type="button" onclick="showModalEdit({{ $nomor }})" class="btn btn-primary">Disposisi</button>
            @endif
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
      elName("status")[0].value = "";
      elName("ket")[0].value = "";
      elName("isidisposisi")[0].value = "";
      elName("tgldisposisi")[0].value = "";
      elName("id_bidang")[0].value = "";
    }
    
    function closeModal()
    {
      resetModal();
      hideModal("#modal");
    }
    
    function showModalEdit(id)
    {
      resetModal();
      elId("judul_modal").innerHTML = "Disposisi Surat";
      var detail = data[id]; 
      elId("form_modal").action = "{{ site_url('kepaladinas/disposisi/edit') }}";
      elName("id")[0].value = detail.id;
      
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
          <form id="form_modal" method="POST" action="{{ site_url('kepaladinas/disposisi/tambah') }}">
            <input type="hidden" name="id">
            @include('components.form.select', ['_data' => ['name' => 'status', 'class' => 'form-control', 'label' => 'Status Surat', 'val' => 'value', 'caption' => 'value','options' => [['value' => 'acc'], ['value' => 'ditolak']]]])	
            @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tgldisposisi', 'class' => 'form-control', 'max' => 50, 'label' => 'Tanggal Disposisi']])	
            @include('components.form.textarea', ['_data' => ['name' => 'isidisposisi', 'class' => 'form-control', 'label' => 'Isi Disposisi']])	
            @include('components.form.select', ['_data' => ['name' => 'id_bidang', 'class' => 'form-control', 'label' => 'Bidang Tujuan', 'val' => 'id', 'caption' => 'bidang', 'options' => $bidang]]) 
            @include('components.form.textarea', ['_data' => ['name' => 'ket', 'class' => 'form-control', 'label' => 'Keterangan']])	
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="closeModal()">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan Disposisi</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection
