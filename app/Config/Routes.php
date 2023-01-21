<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// if(session())

$routes->get('/', 'Home::index',['filter' => 'DpFilter']);
$routes->get('/detail_paket_users/(:any)', 'Home::detail_paket_users/$1');
$routes->get("validation_waktu/(:any)/(:any)/(:any)","Home::validation_waktu/$1/$2/$3");
$routes->get("detail_provinsi/(:any)","Home::detail_provinsi/$1");
$routes->get("ambil_provinsi/(:any)","Home::ambil_provinsi/$1");
$routes->get("ambil_provinsi_edit/(:any)","Home::ambil_provinsi_edit/$1");
$routes->get("ambil_kabupaten/(:any)","Home::ambil_kabupaten/$1");
$routes->get("ambil_kabupaten_edits/(:any)/(:any)","Home::ambil_kabupaten_edits/$1/$2");
$routes->get("ambil_kecamatan/(:any)","Home::ambil_kecamatan/$1");
$routes->post('/tambah_jamaah_user', 'Home::tambah_jamaah_user');
$routes->get('/masuk', 'Home::login');
$routes->get('/regis', 'Home::regis');
$routes->post('/daftar', 'Home::daftar');
$routes->get('/keluar', 'Home::keluar');
$routes->post('login', 'LoginController::index');


    $routes->get('/dashboard', 'DashboardController::index');
    $routes->get('/paket', 'PaketController::index');
    $routes->get('/detail_paket/(:any)', 'PaketController::detail_paket/$1');
    $routes->post('/tambah_paket', 'PaketController::tambah_paket');
    $routes->post('/edit_paket/(:any)', 'PaketController::edit_paket/$1');
    $routes->post('/hapus_paket/(:any)', 'PaketController::hapus_paket/$1');
    $routes->post('/hapus_petugas', 'PaketController::hapus_petugas');
    $routes->post('/edit_petugas', 'PaketController::edit_petugas');
    $routes->post('/tambah_petugas', 'PaketController::tambah_petugas');
    
    
    $routes->post('/tambah_keberangkatan', 'KeberangkatanController::tambah_keberangkatan');
    $routes->post('/edit_keberangkatan', 'KeberangkatanController::edit_keberangkatan');
    $routes->post('/hapus_keberangkatan', 'KeberangkatanController::hapus_keberangkatan');
    
    
    $routes->post('/tambah_hotel', 'HotelController::tambah_hotel');
    $routes->post('/edit_hotel', 'HotelController::edit_hotel');
    $routes->post('/hapus_hotel', 'HotelController::hapus_hotel');
    
    // kepulangan
    $routes->post('/tambah_kepulangan', 'KepulanganController::tambah_kepulangan');
    $routes->post('/edit_kepulangan', 'KepulanganController::edit_kepulangan');
    $routes->post('/hapus_kepulangan', 'KepulanganController::hapus_kepulangan');
    
    // history
    $routes->get('/detail_history_kloter/(:any)/(:any)', 'HistoryController::detail_history_kloter/$1/$2');
    $routes->get('/detail_perencanaan_kloter/(:any)/(:any)/(:any)', 'HistoryController::detail_perencanaan_kloter/$1/$2/$3');
    $routes->get('/detail_selesai_jamaah/(:any)/(:any)/(:any)', 'HistoryController::detail_selesai_jamaah/$1/$2/$3');
    $routes->get('/laporan_harian_realisasi/(:any)/(:any)/(:any)/(:any)', 'HistoryController::laporan_harian_realisasi/$1/$2/$3/$4');
    $routes->get('/detail_perencanaan_realisasi/(:any)/(:any)/(:any)', 'HistoryController::detail_perencanaan_realisasi/$1/$2/$3');
    $routes->get('/paket_selesai', 'HistoryController::index');
    
    $routes->get('/pendaftaran', 'PendaftaranController::pendaftaran');
    
    $routes->get("/tambah_pendaftaran/(:any)/(:any)","PendaftaranController::tambah_pendaftaran/$1/$2");
    // $routes->post("/tambah_pendaftaran/(:any)/(:any)","PendaftaranController::tambah_pendaftaran/$1/$2");
    $routes->get("/detail_pendaftaran_kloter/(:any)","PendaftaranController::detail_pendaftaran_kloter/$1");
    $routes->get("/kelengkapan_jamaah/(:any)/(:any)/(:any)","PendaftaranController::kelengkapan_jamaah/$1/$2/$3");
    $routes->post("/kelengkapan_jamaah_insert/(:any)/(:any)/(:any)","PendaftaranController::kelengkapan_jamaah_insert/$1/$2/$3");
    $routes->get("/edits_jamaah/(:any)/(:any)/(:any)","PendaftaranController::edits_jamaah/$1/$2/$3");
    $routes->post("/hapus_jamaah/(:any)","PendaftaranController::hapus_jamaah/$1");
    $routes->post("/tambah_jamaah","PendaftaranController::tambah_jamaah");
    $routes->post("/bayar/(:any)","PendaftaranController::bayar/$1");
    $routes->post("/asuransi/(:any)","PendaftaranController::asuransi/$1");
    $routes->post("/visa/(:any)","PendaftaranController::visa/$1");
    $routes->post("/edit_jamaah/(:any)","PendaftaranController::edit_jamaah/$1");
    $routes->post("/pindah_paket/(:any)","PendaftaranController::pindah_paket/$1");
    $routes->post("/pindah_paket_user/(:any)","PendaftaranController::pindah_paket_user/$1");
    $routes->post("/vaksin/(:any)","PendaftaranController::vaksin/$1");
    
    
    $routes->post("/mangkat","PendaftaranController::mangkat");
    $routes->get("/download_pdf/(:any)/(:any)","PendaftaranController::download_pdf/$1/$2");
    $routes->get("/ambil_kolter/(:any)","PendaftaranController::ambil_kolter/$1");
    $routes->get("/print_kartu/(:any)","PendaftaranController::print_kartu/$1");
    $routes->get("/download_template","PendaftaranController::download_template");
    $routes->get("/insert_jamaah/(:any)/(:any)","PendaftaranController::insert_jamaah/$1/$2");
    $routes->get("/download_jamaah/(:any)/(:any)","PendaftaranController::download_jamaah/$1/$2");
    $routes->get("/pindah_paket_umrah/(:any)/(:any)/(:any)","PendaftaranController::pindah_paket_umrah/$1/$2/$3");
    
    //tiket
    $routes->get("tiket","TiketController::index");
    $routes->get("detail_kloter_tiket/(:any)/(:any)","TiketController::detail_tiket/$1/$2");
    $routes->get("detail_tiket/(:any)","TiketController::detail_tiket/$1");
    $routes->get("edit_tikets/(:any)/(:any)/(:any)","TiketController::edit_tikets/$1/$2/$3");
    $routes->get("kloter_detail_tiket/(:any)","TiketController::kloter_detail_tiket/$1");
    $routes->post("update_tiket/(:any)","TiketController::update_tiket/$1");


    // bank
    $routes->get("data_bank","DataBankController::index");
    $routes->post("add_data_bank","DataBankController::add_data_bank");
    $routes->post("hapus_data_bank/(:any)","DataBankController::hapus_data_bank/$1");
    $routes->post("edit_data_bank/(:any)","DataBankController::edit_data_bank/$1");

    // travel
    $routes->post("add_data_travel","DataTravelController::add_data_travel");
    $routes->post("hapus_data_travel/(:any)","DataTravelController::hapus_data_travel/$1");
    $routes->post("edit_data_travel/(:any)","DataTravelController::edit_data_travel/$1");
    $routes->get("data_travel","DataTravelController::index");

    //petugas
    $routes->get("/petugas","PetugasController::index");
    $routes->post("/add_petugas","PetugasController::add_petugas");
    $routes->post("/edit_petugas_baru/(:any)","PetugasController::edit_petugas_baru/$1");
    $routes->post("/hapus_petugas_baru/(:any)","PetugasController::hapus_petugas_baru/$1");


    // profil
    $routes->get("/profil","ProfilController::index");
    $routes->post("/update_profile","ProfilController::update_profile");

    //realisasi
    $routes->get("/realisasi","RealisasiControlller::index");
    $routes->get("/detail_realisasi_kloter/(:any)","RealisasiControlller::detail_realisasi_kloter/$1");
    $routes->get("/detail_realisasi/(:any)/(:any)","RealisasiControlller::detail_realisasi/$1/$2");
    $routes->get("/selesai_paket/(:any)/(:any)","RealisasiControlller::selesai_paket/$1/$2");
    $routes->post("/tambah_petugas_realisasi","RealisasiControlller::tambah_petugas_realisasi");
    $routes->post("/hapus_petugas_realisasi","RealisasiControlller::hapus_petugas_realisasi");
    $routes->post("/edit_petugas_realisasi","RealisasiControlller::edit_petugas_realisasi");
    $routes->post("/tambah_keberangkatan_realisasi","RealisasiControlller::tambah_keberangkatan_realisasi");
    $routes->post("/hapus_keberangkatan_realisasi","RealisasiControlller::hapus_keberangkatan_realisasi");
    $routes->post("/edit_keberangkatan_realisasi","RealisasiControlller::edit_keberangkatan_realisasi");
    $routes->post("/tambah_hotel_realisasi","RealisasiControlller::tambah_hotel_realisasi");
    $routes->post("/hapus_hotel_realisasi","RealisasiControlller::hapus_hotel_realisasi");
    $routes->post("/edit_hotel_realisasi","RealisasiControlller::edit_hotel_realisasi");
    $routes->post("/tambah_kepulangan_realisasi","RealisasiControlller::tambah_kepulangan_realisasi");
    $routes->post("/edit_kepulangan_realisasi","RealisasiControlller::edit_kepulangan_realisasi");
    $routes->post("/hapus_kepulangan_realisasi","RealisasiControlller::hapus_kepulangan_realisasi");
    $routes->post("/tambah_kasus","RealisasiControlller::tambah_kasus");
    $routes->post("/edit_kasus","RealisasiControlller::edit_kasus");
    $routes->post("/hapus_kasus","RealisasiControlller::hapus_kasus");
    $routes->post("/tambah_laporan_harian","RealisasiControlller::tambah_laporan_harian");
    $routes->post("/hapus_laporan_harian","RealisasiControlller::hapus_laporan_harian");
    $routes->get("/laporan_harian/(:any)/(:any)/(:any)","RealisasiControlller::laporan_harian/$1/$2/$3");

    // level petugas
    $routes->get("/data_provider","LevelPetugasController::data_provider");
    $routes->get("/data_hotel","LevelPetugasController::data_hotel");
    $routes->get("/data_asuransi","LevelPetugasController::data_asuransi");
    $routes->get("/data_mussahah","LevelPetugasController::data_mussahah");
    $routes->get("/level_users","LevelPetugasController::level_petugas");
    $routes->post("/add_level","LevelPetugasController::add_level");
    $routes->post("/add_asuransi","LevelPetugasController::add_asuransi");
    $routes->post("/add_provider","LevelPetugasController::add_provider");
    $routes->post("/hapus_muassahah/(:any)","LevelPetugasController::hapus_muassahah/$1");
    $routes->post("/edit_hotel/(:any)","LevelPetugasController::edit_hotel/$1");
    $routes->post("/hapus_hotel/(:any)","LevelPetugasController::hapus_hotel/$1");
    $routes->post("/edit_muassahah/(:any)","LevelPetugasController::edit_muassahah/$1");
    $routes->post("/add_muasahah","LevelPetugasController::add_muasahah");
    $routes->post("/add_hotel","LevelPetugasController::add_hotel");
    $routes->post("/edit_level/(:any)","LevelPetugasController::edit_level/$1");
    $routes->post("/edit_asuransi_data/(:any)","LevelPetugasController::edit_asuransi_data/$1");
    $routes->post("/hapus_level/(:any)","LevelPetugasController::hapus_level/$1");
    $routes->post("/hapus_asuransi_data/(:any)","LevelPetugasController::hapus_asuransi_data/$1");
    $routes->post("/edit_provider/(:any)","LevelPetugasController::edit_provider/$1");
    $routes->post("/hapus_provider/(:any)","LevelPetugasController::hapus_provider/$1");

    // rekening penampung
    $routes->get("/rekening_penampung","RekeningPenampungController::index");
    $routes->get("/pembayaran/(:any)/(:any)/(:any)","RekeningPenampungController::pembayaran/$1/$2/$3");
    $routes->post("/tambah_rekening","RekeningPenampungController::tambah_rekening");
    $routes->post("/edit_rekening","RekeningPenampungController::edit_rekening");
    $routes->post("/hapus_rekening","RekeningPenampungController::hapus_rekening");
    $routes->post("/bayar_cicil/(:any)","RekeningPenampungController::bayar_cicil/$1");

    //history
    $routes->get("/detail_history/(:any)","HistoryController::detail_history/$1");
    $routes->get("/detail_perencanaan_history/(:any)","HistoryController::detail_perencanaan_history/$1");
    $routes->get("/detail_jamaah_history/(:any)","HistoryController::detail_jamaah_history/$1");
    $routes->get("/laporan_harian_history/(:any)/(:any)","HistoryController::laporan_harian_history/$1/$2");

    // users
    $routes->get("/users","UsersController::index");
    $routes->get("/profile_user/(:any)","UsersController::profile_user/$1");
    $routes->get("/edit_travel_baru/(:any)","UsersController::edit_travel_baru/$1");
    $routes->get("/profile_user","UsersController::profile_user_tambah");
    $routes->post("/add_users","UsersController::add_users");
    $routes->post("/edit_users","UsersController::edit_users");
    $routes->post("/hapus_users","UsersController::hapus_users");
    $routes->post("/hapus_users_baru","UsersController::hapus_users_baru");
    $routes->post("/update_profile_users","UsersController::update_profile_users");
    $routes->post("/edit_travel","UsersController::edit_travel");
    $routes->get("/user_travel/(:any)","UsersController::user_travel/$1");


    // home
    $routes->get("/detail_banner/(:any)","Home::detail_banner/$1");
    $routes->get("/daftar_jamaah/(:any)/(:any)","Home::daftar_jamaah/$1/$2");
    $routes->post("/daftar_jamaah_baru","Home::daftar_jamaah_baru");
    $routes->post("/ganti_password","Home::ganti_password");
    $routes->post("/cari_paket","Home::cari");
    $routes->get("/cari","Home::mencari");

    //kloter
    $routes->post("/add_kloter","KloterController::add_kloter");
    $routes->post("/edit_kloter","KloterController::edit_kloter");
    $routes->post("/hapus_kloter","KloterController::hapus_kloter");


    //banner
    $routes->get("banner","BannerController::index");
    $routes->post("add_banner","BannerController::add_banner");
    $routes->post("hapus_banner/(:any)","BannerController::hapus_banner/$1");
    $routes->post("edit_banner/(:any)","BannerController::edit_banner/$1");

    // pembayaran admin
    $routes->get("pembayaran_user","PembayaranAdminController::index");
    $routes->get("detail_pembayaran_kloter/(:any)","PembayaranAdminController::detail_pembayaran_kloter/$1");
    $routes->get("detail_pembayaran_jamaah/(:any)/(:any)","PembayaranAdminController::detail_pembayaran_jamaah/$1/$2");
    $routes->get("tolak/(:any)","PembayaranAdminController::tolak/$1");
    $routes->get("approve/(:any)","PembayaranAdminController::approve/$1");

    //user
    $routes->get("dashboard_user","UserManagementControllerBaru::index");
    $routes->get("view_profile","UserManagementControllerBaru::view_profile");
    $routes->get("pembayaran_jamaah","UserManagementControllerBaru::pembayaran_jamaah");
    $routes->get("pindah_paket_jamaah/(:any)/(:any)/(:any)","UserManagementControllerBaru::pindah_paket_jamaah/$1/$2/$3");
    $routes->get("asuransi_jamaah","UserManagementControllerBaru::asuransi_jamaah");
    $routes->get("visa_jamaah","UserManagementControllerBaru::visa_jamaah");
    $routes->get("profile_jamaah","UserManagementControllerBaru::profile_jamaah");
    $routes->get("paket_user","UserManagementControllerBaru::paket_user");
    $routes->get("paket_selesai_user","UserManagementControllerBaru::paket_selesai_user");
    $routes->get("detail_paket_user/(:any)","UserManagementControllerBaru::detail_paket_user/$1");
    $routes->get("detail_jamaah_aktif/(:any)/(:any)","UserManagementControllerBaru::detail_jamaah_aktif/$1/$2");
    $routes->get("detail_jamaah_diri/(:any)/(:any)/(:any)","UserManagementControllerBaru::detail_jamaah_diri/$1/$2/$3");
    $routes->post("/profile_insert","UserManagementControllerBaru::profile_insert");

    // cabang
    $routes->get("/cabang","CabangController::index");
    $routes->get("/profile_cabang/(:any)","CabangController::profile_cabang/$1");
    $routes->post("/hapus_user_cabang","CabangController::hapus_user_cabang");
    $routes->post("/edit_user_cabang","CabangController::edit_user_cabang");
    $routes->post("/tambah_user_cabang","CabangController::tambah_user_cabang");
    $routes->post("/tambah_cabang","CabangController::tambah_cabang");
    $routes->post("/edit_cabang","CabangController::edit_cabang");
    $routes->post("/hapus_cabang","CabangController::hapus_cabang");

    // request paket
    $routes->get("request_paket","RequestPaketController::index");
    $routes->post("konfirmasi_paket/(:any)","RequestPaketController::konfirmasi_paket/$1");
    $routes->get("tolak_paket/(:any)","RequestPaketController::tolak_paket/$1");

    $routes->get("request_jamaah","RequestJamaahController::index");
    $routes->post("pilih_kloter","RequestJamaahController::pilih_kloter");
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}