<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// Rute untuk Autentikasi
$routes->get('/register', 'AuthController::register');
$routes->post('/register/process', 'AuthController::processRegister');
$routes->get('/login', 'AuthController::login');
$routes->post('/login/process', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');

// Grup untuk semua rute yang memerlukan autentikasi
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    
    // === TAMBAHKAN RUTE BARU DI SINI ===
     $routes->resource('pengeluaran', ['controller' => 'PengeluaranController']);
      $routes->resource('pemasukkan', ['controller' => 'PemasukkanController']);
        $routes->get('laporan', 'LaporanController::index');
    $routes->get('laporan/cetak', 'LaporanController::cetak');

    $routes->resource('jadwal-kajian', ['controller' => 'JadwalKajianController']);
    $routes->resource('informasi-masjid', ['controller' => 'InformasiMasjidController']);
    // $routes->get('laporan', 'LaporanController::index');
    // $routes->get('jadwal-kajian', 'JadwalKajianController::index');
    // $routes->get('informasi', 'InformasiController::index');
});