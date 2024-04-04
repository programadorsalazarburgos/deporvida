<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Programa;
use response;
use Image;

class PostProgramasController extends Controller {

    public function __construct() {


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);
    }

    public function vista() {

        return view("postprogramas.appprogramas");
    }

    public function index() {

        $programas = Programa::all();
        return response()->json(
                        $programas->toArray()
        );
    }

    public function ObtenerRoles() {

        $roles = Role::all();
        return response()->json(
                        $roles->toArray()
        );
    }

    public function CrearPrograma(Request $request) {


        $file = $request->file('file');
        $nombre1 = time() . "-" . $file->getClientOriginalName();
        $file->move('programa', $nombre1);
        $image = Image::make(sprintf('programa/%s', $nombre1))->resize(870, 420)->save();
        $path = 'programa/';
        $path .= $nombre1;
        $programa = new Programa();
        $programa->nombre_programa = $request->input('nombre_programa');
        $programa->descripcion_programa = $request->input('descripcion_programa');
        $programa->image = $path;
        $programa->save();
        return response()->json(
                        $programa->toArray()
        );
    }

    public function ObtenerPrograma($id) {


        $programa = Programa::where('programas.id', '=', $id)->firstOrfail();

        return response()->json(
                        $programa->toArray()
        );
    }

    public function EditarPrograma(Request $request, $id) {

        if ($request->file == "undefined") {
            $programa = Programa::findOrfail($id);

            $programa->nombre_programa = $request->input('nombre_programa');
            $programa->descripcion_programa = $request->input('descripcion_programa');
            $programa->save();
            return response()->json(
                            $programa->toArray()
            );
        } else {

            $file = $request->file('file');
            $nombre1 = time() . "-" . $file->getClientOriginalName();
            $file->move('programa', $nombre1);
            $image = Image::make(sprintf('programa/%s', $nombre1))->resize(550, 366)->save();
            $path = 'programa/';
            $path .= $nombre1;

            $programa = Programa::findOrfail($id);
            $programa->nombre_programa = $request->input('nombre_programa');
            $programa->descripcion_programa = $request->input('descripcion_programa');
            $programa->image = $path;
            $programa->save();
            return response()->json(
                            $programa->toArray()
            );
        }
    }

    public function EliminarPrograma($id) {

        $programa = Programa::findOrfail($id);
        $programa->delete();
        return response()->json(
                        $programa->toArray()
        );
    }

}
