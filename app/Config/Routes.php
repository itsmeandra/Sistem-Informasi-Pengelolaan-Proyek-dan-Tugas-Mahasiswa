<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Auth::login');

$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::proses_login');
$routes->get('/auth/logout', 'Auth::logout');

$routes->get('/dashboard/dosen', 'Dashboard::dosen');
$routes->get('/dashboard/mahasiswa', 'Dashboard::mahasiswa');

$routes->get('/project', 'Project::index');
$routes->get('/project/create', 'Project::create');
$routes->post('/project/store', 'Project::store');
$routes->get('/project/edit/(:num)', 'Project::edit/$1');
$routes->post('/project/update/(:num)', 'Project::update/$1');
$routes->get('/project/delete/(:num)', 'Project::delete/$1');

$routes->get('/join', 'Join::list');
$routes->get('/join/(:num)', 'Join::join/$1');

$routes->get('/task/(:num)', 'Task::index/$1');

$routes->get('/task/create/(:num)', 'Task::create/$1');
$routes->post('/task/store', 'Task::store');
// $routes->get('task/delete/(:num)', 'Task::delete/$1');
// $routes->post('/task/edit/(:num)', 'Task::edit/$1');
// $routes->get('/task/edit/(:num)', 'Task::edit/$1');
// $routes->post('/task/update/(:num)', 'Task::update/$1');
$routes->get('/task/upload/(:num)', 'Task::upload/$1');

$routes->get('task/download/(:num)', 'Task::download/$1');

$routes->post('/task/upload', 'Task::saveUpload');

$routes->get('/task/nilai/(:num)', 'Task::nilai/$1');
$routes->post('/task/nilai', 'Task::simpanNilai');
$routes->get('/nilai', 'Nilai::index');

$routes->get('/extra/peserta/(:num)', 'Extra::peserta/$1');
$routes->get('/extra/reminder', 'Extra::reminder');
$routes->get('/extra/statistik/(:num)', 'Extra::statistik/$1');

$routes->get('/task/laporan-semua', 'Task::laporanSemua');

$routes->get('/export/pdf-project', 'Export::pdfProject');
$routes->get('/export/excel-project', 'Export::excelProject');
$routes->get('/export/pdf-tugas/(:num)', 'Export::pdfTugas/$1');
$routes->get('/export/excel-tugas/(:num)', 'Export::excelTugas/$1');
$routes->get('/export/pdf-laporan-tugas', 'Export::pdfLaporanTugas');
$routes->get('/export/excel-laporan-tugas', 'Export::excelLaporanTugas');

$routes->get('/api/tugas-kalender', 'Dashboard::apiTugasKalender');

$routes->get('/admin/index', 'Admin::index');

$routes->get('/admin/projects', 'Admin::index');

// CRUD untuk dosen
$routes->get('admin/users/dosen', 'Admin::usersDosen');
$routes->get('admin/users/create', 'Admin::createUser');
$routes->post('admin/users/store', 'Admin::storeUser');
$routes->get('admin/users/edit/(:num)', 'Admin::editUser/$1');
$routes->post('admin/users/update/(:num)', 'Admin::updateUser/$1');
$routes->get('admin/users/delete/(:num)', 'Admin::deleteUser/$1');

// Tambah rute mahasiswa juga pakai create/edit sama, bedanya role saat input
$routes->get('admin/users/mahasiswa', 'Admin::usersMahasiswa');

$routes->get('admin/monitor/projects', 'Admin::monitorProjects');
$routes->get('admin/monitor/tasks', 'Admin::monitorTasks');
$routes->get('admin/report/rekap', 'Admin::reportRekap');
$routes->get('report/rekap-excel', 'Admin::reportRekapExcel');
