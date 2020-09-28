@extends('layouts.admin', [
  'page_header' => "RESULTADO POR USUÁRIOS",
  'page_icon' => 'fa fa-user-circle-o',
  'dash' => '',
  'users' => '',
  'funcao' => '',
  'matriz' => '',
  'quiz' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'user_re' => 'active',
  'sett' => ''
])

@section('content')
  <div class="content-block box">
    <div class="box-body table-responsive">
      <table id="topTable" class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Colaborador</th>
            <th>Cargo | Ocupação</th>          
            <th>E-mail</th>
            <th style="text-align: center;">Resultado</th>
          </tr>
        </thead>
        <tbody>
            @if ($users)
              @php $n = 1;
              @endphp
              @foreach ($users as $user)
                <tr>
                  <td>
                  {{$n}}
                  @php $n++; @endphp
                  </td>
                  <td>{{$user->name}}</td>
                  <td>
                  @php
                    $qu_count = 0;
                    $dados = array();
                  @endphp
                  @foreach($funcao as $fun)
                    @if($fun->id == $user->role)
                     @php
                    
                      $dados = array("user_name" => $user->name, "funcao_id" => $fun->id, "user_id" => $user->id);
                      @endphp
                        {{$fun->nome}}
                    @endif
                  @endforeach
                  </td>
                  <td>{{$user->email}}</td>
                  <td style="text-align: center;">
                    <a href="{{route('user_result.show', $dados )}}" type="button" class="btn btn-info btn-xs"><i class="fa fa-plus-circle"></i>&nbsp&nbsp Veja mais</a>
                    
                  </td>
                </tr>
              @endforeach
            @endif
        </tbody>
      </table>
    </div>
  </div>
@endsection
