<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Topic;
use App\Answer;
use App\Question;
use App\Funcao;
use DB;

class UserResultReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
        
        $users = User::where('role', '!=', 'A')->get();
        $funcao = Funcao::all();
        $topic = Topic::findOrFail(1);
        $answers = Answer::where('topic_id', $topic->id)->get();
        $students = User::where('id', '!=', Auth::id())->get();
        $c_que = Question::where('topic_id', 1)->count();

        $filtStudents = collect();
        foreach ($students as $student) {
          foreach ($answers as $answer) {
            if ($answer->user_id == $student->id) {
              $filtStudents->push($student);
            }
          }
        }

        $filtStudents = $filtStudents->unique();
        $filtStudents = $filtStudents->flatten();

        return view('admin.user_result.index', compact('filtStudents', 'answers', 'c_que', 'topic','users','funcao'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$user_name)
    { 

        $funcao_id = $request->input('funcao_id');
        $user_id = $request->input('user_id');

        $answers = Answer::where('user_id',$user_id)->get();
        $topics = DB::table('topics')
        ->join('matrizs', 'topics.id', '=', 'matrizs.topics_id')
        ->where('matrizs.funcaos_id', $funcao_id)
        ->get();

        return view('admin.user_result.show', compact('answers', 'topics','user_name'));
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
    }
}
