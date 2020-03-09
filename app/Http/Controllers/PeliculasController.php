<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Pelicula;

class PeliculasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Pelicula::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //echo $request->pais;

        $query = DB::table('peliculas')->insertGetId(
            ['pelicula' => $request->pelicula, 
            'director' => $request->director,
            'pais' => $request->pais
            ]
        );

        if($query){
            $response = array(
                'status' => '200',
                'message' => 'Pelicula insertada con exito'
            );

            
        }else{
            $response = array(
                'status' => '400',
                'message' => 'Fallo al insertar la pelicula'
            );
        }

        echo json_encode($response);
        //return Pelicula::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Pelicula::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $query = DB::table('peliculas')
            ->where('id', $id)
            ->update(['pelicula' => $request->pelicula, 
            'director' => $request->director,
            'pais' => $request->pais
            ]);

        if($query){
            $response = array(
                'status' => '200',
                'message' => 'Pelicula modificada con exito'
            );
        }
       
        echo json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $query = DB::table('peliculas')->where('id', '=', $id)->delete();
        if ($query){
            $response = array(
                'status' => '200',
                'message' => 'Pelicula eliminada con exito'
            );
        };

        echo json_encode($response);
    }
}
