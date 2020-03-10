<?php

use JasperPHP\JasperPHP as JasperPHP;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/compilar', function () {
    // Crear el objeto JasperPHP
    $jasper = new JasperPHP;
    
    // Compilar el reporte para generar .jasper
    $jasper->compile(base_path() . '/vendor/cossou/jasperphp/examples/invoice.jrxml')->execute();
   
    /*$input = base_path() . '/vendor/cossou/jasperphp/examples/invoice.jrxml';
    $output = $jasper->list_parameters($input)->execute();

    foreach($output as $parameter_description)
        print $parameter_description . '<pre>';*/
    return view('welcome');
});

Route::get('/reporte', function () {
    // Crear el objeto JasperPHP
    $jasper = new JasperPHP;
    $output = base_path() . '/vendor/cossou/jasperphp/examples/invoice.pdf';
    // Generar el Reporte
    $jasper->process(
        // Ruta y nombre de archivo de entrada del reporte
        base_path() . '/vendor/cossou/jasperphp/examples/invoice.jasper', 
        false, // Ruta y nombre de archivo de salida del reporte (sin extensión)
        array('pdf'), // Formatos de salida del reporte
        array(),
        array(
            "driver" => 'mysql',
            "username" => env('DB_USERNAME'),
            "password" => env('DB_PASSWORD'),
            "host" => env('DB_HOST'),
            "database" => env('DB_DATABASE'),
            "port" => env('DB_PORT'),
           // "jdbc_driver" => 'com.mysql.jdbc.Driver',
            //"jdbc_url" => 'jdbc:mysql://127.0.0.1/prueba_laravel',
           // "jdbc_dir" => 'C:\xampp\htdocs\pruebalaravel\vendor\cossou\jasperphp\src\JasperStarter\jdbc'
        ),
        false,
        false
    )->execute();


    //exec($jasper->output().' 2>&1', $out);
    //print_r($out);

    return response()->file($output)->deleteFileAfterSend();
});
