<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use DB;
use App\Topic;
use App\Funcao;
use App\Matriz;

class MatrizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()       
    {
        $funcaos = Funcao::where('id', '>', '1')->get();
        $topics = Topic::all();

        $matriz = DB::table('matrizs')
            ->join('funcaos', 'funcaos.id', '=', 'matrizs.funcaos_id')
            ->join('topics', 'topics.id', '=', 'matrizs.topics_id')
            ->select('matrizs.*', 'funcaos.nome', 'topics.title')
            ->orderBy('funcaos.nome', 'asc')
            ->get();

        return view('admin.questions.matriz',compact('topics','funcaos','matriz'));

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
    public function store(Request $request,$id)
    {

          $input = $request->all();


            Matriz::create([
                'funcaos_id' => $input['funcaos_id'],
                'topics_id' => $id,
            ]);
            
            return back()->with('added', 'Ocupação/Cargo, Adicionado com sucesso!');
     
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matriz = Matriz::findOrFail($id);
        $matriz->delete();
        return back()->with('deleted', 'Excluido, com sucesso!');
    }

}
