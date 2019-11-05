<?php
  if(!isset($_SESSION['level']))
  {
    header("Location: ".site_url("login"));
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="{{ base_url() }}assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ base_url() }}assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ base_url() }}assets/css/nprogress.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="{{ base_url() }}assets/css/custom.min.css" rel="stylesheet">
    
    <link href="{{ base_url() }}assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ base_url() }}assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
    @section('head')
      <!-- Custom Head -->
    @show
    <style>
      .show-modal {
        display: block;
      }
      .hide-modal {
        display: none;
      }
      
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div align ="center" class="navbar nav_title" style="border: 0;padding: 20px;" >
              <img  src="{{ base_url() }}assets/images/800px-Logo-kemkominfo-id.jpg" heigt="100%" width="100%">
              <!-- <span align="right" style="font-size:15px; font-weight: bold">DINAS KEBUDAYAAN PROVINSI SUMATERA BARAT</span></br> -->
            </div>
        
            <div class="clearfix"></div>
        
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_info">
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->
        
            <br />
        
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                  @section('sidebar_menu')
                    <li><a href="{{ site_url('beranda') }}"><i class="fa fa-home"></i> Beranda</a></li>
                    <?php
                      switch($_SESSION['level'])
                      {
                        case "Admin":
                    ?>
                        <li><a href="{{ site_url('admin/bidang') }}"><i class="fa fa-bars"></i> Bidang</a></li>
                        <li><a href="{{ site_url('admin/pegawai') }}"><i class="fa fa-binoculars"></i> Pegawai</a></li>
                        <li><a href="{{ site_url('admin/suratmasuk') }}"><i class="fa fa-envelope"></i> Surat Masuk</a></li>
                        <li><a href="{{ site_url('kabid/suratkeluar') }}"><i class="fa fa-send"></i> Surat Keluar</a></li>
                        <li><a href="{{ site_url('kepaladinas/laporan-surat-masuk') }}"><i class="fa fa-file-archive-o"></i> Laporan Surat Masuk</a></li>
                        <li><a href="{{ site_url('kepaladinas/laporan-surat-keluar') }}"><i class="fa fa-file-archive-o"></i> Laporan Surat Keluar</a></li>
                        
                    <?php
                        break;
                        
                        case "Kepala Dinas":
                    ?>
                        <li><a href="{{ site_url('kepaladinas/disposisi') }}"><i class="fa fa-edit"></i> Disposisi Surat</a></li>
                        <li><a href="{{ site_url('kabid/suratkeluar') }}"><i class="fa fa-send"></i> Surat Keluar</a></li>
                    <?php
                        break;
                        case "Kepala Bidang":
                    ?>
                        <li><a href="{{ site_url('admin/suratmasuk') }}"><i class="fa fa-envelope"></i> Surat Masuk</a></li>
                        <li><a href="{{ site_url('kabid/suratkeluar') }}"><i class="fa fa-send"></i> Surat Keluar</a></li>
                    <?php
                        break;
                      }
                    ?>
                    
                    
                    
                    
                  @show
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>
        

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
              	<?php if($_SESSION['level'] == "Kepala Dinas"): ?>
      <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{ $_SESSION['banyak_surat_masuk'] }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda Punya {{ $_SESSION['banyak_surat_masuk'] }} Surat Yang Belum Di Disposisi</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php
                    foreach($_SESSION['surat_masuk'] as $data):
                  ?>
                  <li>
                    <a href="<?php echo base_url('SuratmasukController'); ?>">
                      <i class="fa fa-edit text-aqua"></i> Surat No <?php echo $data["nomorsm"]; ?> Belum Di Disposisi
                    </a>
                  </li>
                <?php endforeach; ?>
                </ul>
              </li>
              <li class="footer"><a href="<?php echo base_url('kepaladinas/disposisi'); ?>">Tampilkan Semua Surat</a></li>
            </ul>
          </li>
        <?php endif; ?>
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ base_url() }}assets/images/{{ $_SESSION['foto'] }}" alt="">
                    Selamat Datang, {{ $_SESSION['nama'] }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ site_url('profil')}}"> Profil</a></li>
                    <li><a href="{{ site_url('ganti-password')}}"> Ganti Password</a></li>
                    <li><a href="{{ site_url('logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
                      @yield('content_title')
                    </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @yield('content')
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Dinas Kebudayaan Provinsi Sumatera Barat <a href="https://colorlib.com"></a>
          </div>
          <div class="clearfix"></div>
          <script>
            $('#DataTable').DataTable();
          </script>
        </footer>
        <!-- /footer content -->
        
      </div>
    </div>
    <!-- jQuery -->
    <script src="{{ base_url() }}assets/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ base_url() }}assets/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="{{ base_url() }}assets/js/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{ base_url() }}assets/js/nprogress.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="{{ base_url() }}assets/js/custom.min.js"></script>
    
    
    <script src="{{ base_url() }}assets/js/jquery.dataTables.min.js"></script>
    <script src="{{ base_url() }}assets/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ base_url() }}assets/js/dataTables.responsive.min.js"></script>
    
    @section('script')
      <!-- Custom Script -->
    @show
    <!-- modal untuk peringatan hapus -->
    <div class="modal fade hide-modal" id="modal_hapus">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="judul_modal">Peringatan!</h4>
        </div>
        <div class="modal-body">
          <h5>Apakah Anda yakin untuk menghapus data ini?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="hideModal('#modal_hapus')">Batal</button>
          <a id="url_hapus" href="" class="btn btn-danger">Hapus Data</a>
        </div>
      </div>
    </div>
  </div>
  <script>
      $('.table').DataTable();
      function elId(id)
      {
        return document.getElementById(id);
      }
      function elName(name)
      {
        return document.getElementsByName(name);
      }
      function showModal(id)
      {
        $(id).modal("show");
      }
      function hideModal(id)
      {
        $(id).modal("hide");
      }
      function showConfirmationDelete(url)
      {
        document.getElementById("url_hapus").href = url;
        showModal('#modal_hapus');
      }
    </script>
  </body>
</html>
