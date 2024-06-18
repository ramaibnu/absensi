<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'Login_api';
$route['404_override'] = 'Error_pages/not_found';
$route['translate_uri_dashes'] = FALSE;

// Unknown
$route['karyawan/detail_karyawan/(:any)'] = 'karyawan/detail_karyawan/$1';
$route['karyawan/edit_karyawan/(:any)'] = 'karyawan/edit_karyawan/$1';
// Dummy
$route['edit_perusahaan/(:any)'] = 'Perusahaan_api/edit_perusahaan/$1';
$route['proses_edit_perusahaan'] = 'Perusahaan_api/update';

// Authentication
$route['login_view'] = 'Login_api';
$route['login_process'] = 'Login_api/auth';
$route['logout'] = 'Logout_api/logout';

// Change Password
$route['change_password_view'] = 'ChangePassword_api';
$route['change_password'] = 'ChangePassword_api/process';

// Dashboard
$route['dashboard_main'] = 'Dashboard_api';
$route['dashboard_datatables'] = 'Dashboard_api/new_data';

// Data Master
// Perusahaan
$route['perusahaan'] = 'Perusahaan_api';
$route['tambah_perusahaan'] = 'Perusahaan_api/tambah_perusahaan';
// Struktur Perusahaan
$route['struktur'] = 'Struktur_api';
$route['tambah_struktur'] = 'Struktur_api/tambah_struktur';
// Departemen
$route['departemen'] = 'Departemen_api';
$route['tambah_departemen'] = 'Departemen_api/tambah_departemen';
// Section
$route['section'] = 'Section_api';
$route['tambah_section'] = 'Section_api/tambah_section';
// Posisi
$route['posisi'] = 'Posisi_api';
$route['tambah_posisi'] = 'Posisi_api/tambah_posisi';
// Level 
$route['level'] = 'Level_api';
$route['tambah_level'] = 'Level_api/tambah_level';
// Grade
$route['grade'] = 'Grade_api';
$route['tambah_grade'] = 'Grade_api/tambah_grade';
// Golongan
$route['golongan'] = 'Golongan_api';
$route['tambah_golongan'] = 'Golongan_api/tambah_golongan';
// Status Perjanjian Karyawan
$route['status_perjanjian'] = 'StatusPerjanjian_api';
$route['tambah_status_perjanjian'] = 'StatusPerjanjian_api/tambah_status_perjanjian';
// Roster
$route['roster'] = 'Roster_api';
$route['tambah_roster'] = 'Roster_api/tambah_roster';
// Bank
$route['bank'] = 'Bank_api';
$route['tambah_bank'] = 'Bank_api/tambah_bank';
// Sanksi
$route['sanksi'] = 'Sanksi_api';
$route['tambah_sanksi'] = 'Sanksi_api/tambah_sanksi';
// Jenis Sertifikasi
$route['jenis_sertifikasi'] = 'Jenis_sertifikasi_api';
$route['tambah_jenis_sertifikasi'] = 'Jenis_sertifikasi_api/tambah_jenis_sertifikasi';
// Lokasi Kerja
$route['lokasi_kerja'] = 'LokasiKerja_api';
$route['tambah_lokasi_kerja'] = 'LokasiKerja_api/tambah_lokasi_kerja';
// Lokasi Penerimaan
$route['lokasi_penerimaan'] = 'LokasiPenerimaan_api';
$route['tambah_lokasi_penerimaan'] = 'LokasiPenerimaan_api/tambah_lokasi_penerimaan';
// POH (Point Of Hire)
$route['poh'] = 'Poh_api';
$route['tambah_poh'] = 'Poh_api/tambah_poh';
// Sim Polisi
$route['sim'] = 'SIM_api';
$route['tambah_sim'] = 'SIM_api/tambah_sim';
// Unit
$route['unit'] = 'Unit_api';
$route['tambah_unit'] = 'Unit_api/tambah_unit';

// Karyawan
$route['karyawan'] = 'Karyawan_api';
$route['tambah_karyawan'] = 'Karyawan_api/tambah_karyawan';
$route['detail_karyawan/(:any)'] = 'Karyawan_api/detail_karyawan/$1';
$route['edit_karyawan/(:any)'] = 'Karyawan_api/edit_karyawan/$1';
// Nonaktif
$route['nonaktif_karyawan'] = 'Karyawan_nonaktif_api';
$route['tambah_nonaktif_karyawan'] = 'Karyawan_nonaktif_api/tambah_nonaktif_karyawan';

// Pelanggaran
$route['pelanggaran'] = 'Pelanggaran_api';
$route['tambah_pelanggaran'] = 'Pelanggaran_api/tambah_pelanggaran';
$route['detail_pelanggaran/(:any)'] = 'Pelanggaran_api/detail_pelanggaran/$1';
$route['update_pelanggaran/(:any)'] = 'Pelanggaran_api/update_pelanggaran/$1';

// Users
$route['users'] = 'User_api';
$route['tambah_user'] = 'User_api/tambah_user';

// Files Path
$route['berkasMCU/(:any)'] = 'Karyawan_api/mcu/$1';
$route['berkasSertifikasi/(:any)'] = 'Karyawan_api/fileSertifikasi/$1';
$route['berkasPendukung/(:any)'] = 'Karyawan_api/support/$1';
$route['berkasPelanggaran/(:any)'] = 'Pelanggaran_api/berkas/$1';

// Error Pages
$route['not_found'] = 'Error_pages/not_found';
$route['device_unauthorized'] = 'Error_pages/device_unauthorized';
$route['unauthorized'] = 'Error_pages/unauthorized';
$route['ip_blocked'] = 'Error_pages/ip_blocked';
$route['forbidden'] = 'Error_pages/forbidden';
$route['unallowed'] = 'Error_pages/forbidden_2';
$route['server_error'] = 'Error_pages/page_error';

// Download Data
$route['download_karyawan'] = 'Download_data/karyawan';
$route['download_pelanggaran'] = 'Download_data/pelanggaran';

// Absensi
$route['get_absensi'] = 'Absensi/get_absensi';
$route['kal_absensi'] = 'Absensi/kalabsen';

// Jadwal
$route['set_plan'] = 'Jadwal/set_plan';
$route['plan'] = 'Jadwal/plan';
$route['updjadwal'] = 'Jadwal/updjadwal';

// Export Import
$route['export'] = 'Exportimport/export';
$route['import'] = 'Exportimport/import';

// Pengajuan
$route['pengajuan'] = 'Pengajuan/viewpengajuan';
$route['addpengajuan'] = 'Pengajuan/addpengajuan';
$route['updpengajuan/(:num)'] = 'Pengajuan/updpengajuan/$1';
