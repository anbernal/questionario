@extends('layouts.admin', [
  'page_header' => 'OCUPAÇÃO | CARGO',
  'page_icon' => 'fa fa-address-card-o',
  'dash' => '',
  'users' => '',
  'funcao' => 'active',
  'matriz' => '',
  'quiz' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'user_re' => '',
  'sett' => ''
])
@section('content')
@include('message')
  @if ($auth->role == 'A')
  <div class="margin-bottom">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCadastar">
      <i class="fa fa-plus"> </i>  Nova
    </button>
    <button type="button" class="btn btn-danger" >
      <i class="fa fa-times-circle"> </i>  Excluir Todas
    </button>
  </div>
  <div class="content-block box">
      <div class="box-body table-responsive">
        <table id="example1" class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Ocupação | Cargo</th>
              <th>Acão</th>
            </tr>
          </thead>
          <tbody>
            @if ($funcoes)
              @php($n = 1)
              @foreach ($funcoes as $key => $funcao)
                <tr>
                  <td>
                    {{$n}}
                    @php($n++)
                  </td>
                  <td>{{$funcao->nome}}</td>
                  <td>
                    <!-- Edit Button -->
                    <a type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#{{$funcao->id}}editarModal"><i class="fa fa-edit"></i> Edital</a>
                    <!-- Delete Button -->
                    <a type="button" class="btn btn-danger btn-xs"  data-toggle="modal" data-target="#{{$funcao->id}}deleteModal"><i class="fa fa-close"></i> Exluir</a>
                    <div id="{{$funcao->id}}deleteModal" class="delete-modal modal fade" role="dialog">
                      <!-- Delete Modal -->
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                            <h4 class="modal-heading">EXCLUIR </h4>
                            <p>Tem certeza que deseja excluir ?</p>
                          </div>
                          <div class="modal-footer">
                            {!! Form::open(['method' => 'GET', 'action' => ['FuncaoController@destroy', $funcao->id]]) !!}
                                {!! Form::reset("NÃO", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                                {!! Form::submit("SIM", ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                 <!-- Modal Editar -->
                <div id="{{$funcao->id}}editarModal" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Editar</h4>
                      </div>
                      {!! Form::model($funcao, ['method' => 'POST', 'action' => ['FuncaoController@update', $funcao->id]]) !!}
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-8">
                              <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                {!! Form::label('nome', 'Ocupação/Cargo') !!}
                                <span class="required">*</span>
                                {!! Form::text('nome', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter your name']) !!}
                                <small class="text-danger">{{ $errors->first('nome') }}</small>
                              </div>                                             
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <div class="btn-group pull-right">
                            {!! Form::submit("Atualizar", ['class' => 'btn btn-wave']) !!}
                          </div>
                        </div>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
                <!-- Fim Modal Editar -->
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal Cadastar -->
    <div id="modalCadastar" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Nova</h4>
          </div>
          {!! Form::open(['method' => 'POST', 'action' => 'FuncaoController@store']) !!}
            <div class="modal-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                    {!! Form::label('nome', 'Ocupação/Cargo') !!}
                    <span class="required">*</span>
                    {!! Form::text('nome', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Digite a funcão']) !!}
                    <small class="text-danger">{{ $errors->first('nome') }}</small>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="btn-group pull-right">
                {!! Form::reset("Limpar", ['class' => 'btn btn-default']) !!}
                {!! Form::submit("Salvar", ['class' => 'btn btn-wave']) !!}
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!-- Fim Modal CAdastrar -->
   
  @endif
@endsection
@section('scripts')


<script>
  $('#ch1').click(function(){
    $('#pass').show();
  });

  $('#ch2').click(function(){
    $('#pass').hide();
  });
</script>

@endsection
