<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;
use DB;
use App\Funcao;

class FuncaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcoes = Funcao::all();
        return view('admin.funcao.index',compact('funcoes'));

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
        $request->validate([
            'nome' => 'required|string|max:255',
          ]);
  
          $input = $request->all();

          Funcao::create([
            'nome' => $input['nome'],
          ]);
  
          return back()->with('added', 'Ocupação/Cargo, Salvo com sucesso!');
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
        $funcao = Funcao::findOrFail($id);

        $request->validate([
          'nome' => 'required|string|max:255',
        ]);

        $input = $request->all();

         
          $funcao->update([
            'nome' => $input['nome'],
          ]);
        
        return back()->with('updated', 'Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $funcao = Funcao::findOrFail($id);
        $funcao->delete();
        return back()->with('deleted', 'Excluido com sucesso!');
    }

}
