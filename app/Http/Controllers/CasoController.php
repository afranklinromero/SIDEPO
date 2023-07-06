<?php

namespace App\Http\Controllers;

use App\Models\Caso;
use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
/**
 * Class CasoController
 * @package App\Http\Controllers
 */
class CasoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
       
    }
    public function index()
    {
        $casos = Caso::paginate();

        return view('caso.index', compact('casos'))
            ->with('i', (request()->input('page', 1) - 1) * $casos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         
        $departamentos = Departamento::paginate();
        $municipios = Municipio::paginate();
        $caso = new Caso();
        
        if (request()->ajax()) {
        $municipios = Municipio::when(request()->input('departamento_id'), function($query) {
            $query->where('departamento_id', request()->input('departamento_id'));
        })->pluck('nombre', 'id');
    
        return response()->json($municipios);
    }
        return view('caso.create', compact('caso','departamentos','municipios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // request()->validate(
       //     ['archivo'=>'required|pdf|mimes:pdf|max:5000']
       // );

        //$caso = Caso::create($request->all());


        $req = new Caso();
        $req->caso= (strtoupper($request->caso));
        $req->ano= $request->ano;
        $req->placa= (strtoupper($request->placa));
        $req->vehiculo= (strtoupper($request->vehiculo));
        $req->marca=(strtoupper($request->marca));
        $req->tipo=(strtoupper($request->tipo));
        $req->color=(strtoupper($request->color));
        $req->modelo=$request->modelo;
        $req->chasis=(strtoupper($request->chasis));
        $req->hecho=(strtoupper($request->hecho));
        $req->nombre=(strtoupper($request->nombre));
        $req->apaterno=(strtoupper($request->apaterno));
        $req->amaterno=(strtoupper($request->amaterno));
        $req->estado=(strtoupper($request->estado));
        $req->fecha_denuncia=$request->fecha_denuncia;
        $req->grupo_designado=(strtoupper($request->grupo_designado));
        $req->asignado=(strtoupper($request->asignado));
        $req->regional=(strtoupper($request->departamento_id));
       
        $req->lugar=(strtoupper($request->lugar_id));
       
        
        $req->ci=$request->ci;
        $req->id_user=$request->id_user;

        //$req->archivo= $request->archivo->store('public');
        
        $req->save();
   
        
        
        return redirect()->route('casos.index')
            ->with('success', 'Caso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $caso = Caso::find($id);

        return view('caso.show', compact('caso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $caso = Caso::find($id);
        $departamentos = Departamento::paginate();
        $municipios = Municipio::paginate();
        if (request()->ajax()) {
            $municipios = Municipio::when(request()->input('departamento_id'), function($query) {
                $query->where('departamento_id', request()->input('departamento_id'));
            })->pluck('nombre', 'id');
        
            return response()->json($municipios);
        }
        return view('caso.edit',compact('caso','departamentos','municipios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Caso $caso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Caso $caso)
    {
        
        
       // request()->validate(Caso::$rules);

       
        $caso->ci= $request->ci;
        
        //$caso->archivo= $request->archivo->store('public');

        $caso->id_user=$request->id_user;

        $caso->caso= $request->caso;
        $caso->ano= $request->ano;
        $caso->placa= $request->placa;
        $caso->vehiculo= $request->vehiculo;
        $caso->marca=$request->marca;
        $caso->tipo=$request->tipo;
        $caso->color=$request->color;
        $caso->modelo=$request->modelo;
        $caso->chasis=$request->chasis;
        $caso->hecho=$request->hecho;
        $caso->nombre=$request->nombre;
        $caso->apaterno=$request->apaterno;
        $caso->amaterno=$request->amaterno;
        $caso->estado=$request->estado;
        $caso->fecha_denuncia=$request->fecha_denuncia;
        $caso->grupo_designado=$request->grupo_designado;
        $caso->asignado=$request->asignado;

        $caso->regional=$request->departamento_id;
       
        $caso->lugar=$request->municipio_id;
       
        
        $caso->ci=$request->ci;
    










        $caso->save();

        return redirect()->route('casos.index')
            ->with('success', 'Caso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $caso = Caso::find($id)->delete();

        return redirect()->route('casos.index')
            ->with('success', 'Caso deleted successfully');
    }

    public function pdf(Request $request, Caso $caso)
    {
        
    }

 
}