<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.htbeml
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Autentikasi/login';
$route['404_override'] = 'Autentikasi/dilarang';
$route['translate_uri_dashes'] = FALSE;

$route['home']['GET'] = 'Home/index';                // Lihat Data

$route['admin/pegawai']['GET'] = 'Pegawai/daftar';                // Lihat Data
$route['admin/pegawai/tambah']['POST'] = 'Pegawai/prosesTambah';  // Proses Tambah Data
$route['admin/pegawai/edit']['POST'] = 'Pegawai/prosesEdit';             // Proses Edit Data
$route['admin/pegawai/hapus']['GET'] = 'Pegawai/prosesHapus';     // Hapus Data 


$route['kabid/suratkeluar']['GET'] = 'SuratKeluar/daftar';                // Lihat Data
$route['kabid/suratkeluar/tambah']['POST'] = 'SuratKeluar/prosesTambah';  // Proses Tambah Data
$route['kabid/suratkeluar/edit']['POST'] = 'SuratKeluar/prosesEdit';             // Proses Edit Data
$route['kabid/suratkeluar/hapus']['GET'] = 'SuratKeluar/prosesHapus';     // Hapus Data 

$route['admin/suratmasuk']['GET'] = 'SuratMasuk/daftar';                // Lihat Data
$route['admin/suratmasuk/tambah']['POST'] = 'SuratMasuk/prosesTambah';  // Proses Tambah Data
$route['admin/suratmasuk/edit']['POST'] = 'SuratMasuk/prosesEdit';             // Proses Edit Data
$route['admin/suratmasuk/hapus']['GET'] = 'SuratMasuk/prosesHapus';     // Hapus Data 

$route['kepaladinas/disposisi']['GET'] = 'SuratMasuk/daftarDisposisi';                // Lihat Data
$route['kepaladinas/disposisi/edit']['POST'] = 'SuratMasuk/prosesDisposisi';             // Proses Edit Data

$route['kepaladinas/suratkeluar']['GET'] = 'SuratKeluar/lihatSuratKeluar';    

$route['kepaladinas/laporan-surat-masuk']['GET'] = 'SuratMasuk/laporanSuratMasuk';    
$route['kepaladinas/laporan-surat-masuk']['POST'] = 'SuratMasuk/prosesLaporanSuratMasuk';  

  
$route['kepaladinas/laporan-surat-keluar']['GET'] = 'SuratKeluar/laporanSuratKeluar';    
$route['kepaladinas/laporan-surat-keluar']['POST'] = 'SuratKeluar/prosesLaporanSuratKeluar';  

  

$route['admin/bidang']['GET'] = 'Bidang/daftar';                // Lihat Data
$route['admin/bidang/tambah']['POST'] = 'Bidang/prosesTambah';  // Proses Tambah Data
$route['admin/bidang/edit']['POST'] = 'Bidang/prosesEdit';             // Proses Edit Data
$route['admin/bidang/hapus']['GET'] = 'Bidang/prosesHapus';     // Hapus Data 



// Route untuk login, register dsm
$route['login']['GET'] = 'Autentikasi/login'; 
$route['login']['POST'] = 'Autentikasi/prosesLogin'; 
$route['logout']['GET'] = 'Autentikasi/prosesLogout'; 
$route['beranda']['GET'] = 'Home/beranda';
$route['ganti-password']['GET'] = 'Pegawai/gantiPassword';
$route['ganti-password']['POST'] = 'Pegawai/prosesGantiPassword';

$route['404']['GET'] = 'Autentikasi/dilarang'; 


// EOF Route admin
