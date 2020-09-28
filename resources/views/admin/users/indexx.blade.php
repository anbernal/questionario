@extends('layouts.admin', [
  'page_header' => 'COLABORADORES',
  'page_icon' => 'fa fa-users',
  'dash' => '',
  'users' => 'active',
  'funcao' => '',
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
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
        <i class="fa fa-plus"> </i>  Novo
      </button>
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#AllDeleteModal">
        <i class="fa fa-times-circle"> </i>  Excluir Todos
      </button>
    </div>
    <!-- All Delete Button -->
    <div id="AllDeleteModal" class="delete-modal modal fade" role="dialog">
      <!-- All Delete Modal -->
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
            {!! Form::open(['method' => 'POST', 'action' => 'DestroyAllController@AllUsersDestroy']) !!}
                {!! Form::reset("Não", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                {!! Form::submit("Sim", ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    <!-- Create Modal -->
    <div id="createModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Novo</h4>
          </div>
          {!! Form::open(['method' => 'POST', 'action' => 'UsersController@store']) !!}
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name', 'Nome') !!}
                    <span class="required">*</span>
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Digite o nome']) !!}
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', 'E-mail') !!}
                    <span class="required">*</span>
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'ex: info@examplo.com.br', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {!! Form::label('password', 'Senha') !!}
                    <span class="required">*</span>
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder'=>'Digite a Senha', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                     
                      {!! Form::label('role', 'Ocupação/Cargo') !!}
                      <span class="required">*</span>

                      <select name="role" class="form-control select2">
                          <option value=0>Selecione...</option>
                      @if ($funcoes)
                          @php($n = 1)
                            @foreach ($funcoes as $key => $funcao)
                        <option value={{$funcao->id}}>{{$funcao->nome}}</option> 
                        @endforeach
                        @endif
                      </select>                     
                      <small class="text-danger">{{ $errors->first('role') }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    {!! Form::label('mobile', 'Celular No.') !!}
                    {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'ex: (99) 9 9999-9999)', 'required' => 'required']) !!}
                  </div>
                  <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                    {!! Form::label('city', 'Cidade') !!}
                    {!! Form::text('city', null, ['class' => 'form-control', 'placeholder'=>'Digite a cidade']) !!}
                    <small class="text-danger">{{ $errors->first('city') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    {!! Form::label('address', 'Endereço') !!}
                    {!! Form::textarea('address', null, ['class' => 'form-control', 'rows'=>'5', 'placeholder' => 'Digite o endereço']) !!}
                    <small class="text-danger">{{ $errors->first('address') }}</small>
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
    <div class="content-block box">
      <div class="box-body table-responsive">
        <table id="example1" class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Nome Completo</th>
              <th>E-mail</th>
              <th>Ocupação</th>
              <th>Acão</th>
            </tr>
          </thead>
          <tbody>
            @if ($users)
              @php($n = 1)
              @foreach ($users as $key => $user)
                <tr>
                  <td>
                    {{$n}}
                    @php($n++)
                  </td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td> 
                  @foreach ($funcoes as $fun)
                    @if($fun->id == $user->role)
                        {{$fun->nome}}
                    @endif
                  @endforeach
                  </td>
                  <td>
                    <!-- Edit Button -->
                    <a type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#{{$user->id}}EditModal"><i class="fa fa-edit"></i> Editar</a>
                    <!-- Delete Button -->
                    <a type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#{{$user->id}}deleteModal"><i class="fa fa-close"></i> Excluir</a>
                    <div id="{{$user->id}}deleteModal" class="delete-modal modal fade" role="dialog">
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
                            {!! Form::open(['method' => 'DELETE', 'action' => ['UsersController@destroy', $user->id]]) !!}
                                {!! Form::reset("Não", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                                {!! Form::submit("Sim", ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <!-- edit model -->
                <div id="{{$user->id}}EditModal" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Editar Colaborador </h4>
                      </div>
                      {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UsersController@update', $user->id]]) !!}
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name', 'Nome') !!}
                                <span class="required">*</span>
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Digite o nome']) !!}
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                              </div>
                              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email', 'E-mail') !!}
                                <span class="required">*</span>
                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'ex: info@exemplo.com.br', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                              </div>
                              {{-- <label for="">Change Password: </label>
                              <input type="checkbox" name="changepass"> --}}
                              {{-- <input type="radio" value="1" name="changepass" id="ch1">&nbsp;Yes
                               <input type="radio" value="0" name="changepass" checked id="ch2">&nbsp;No --}}
                               <br>
                              <div id="pass" class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                {!! Form::label('password', 'Senha') !!}
                                <span class="required">*</span>
                               
                                <input class="form-control" type="password" value="" placeholder="Digite a Senha" name="password">
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                              </div>
                              {!! Form::label('role', 'Ocupação/Cargo') !!}
                              <span class="required">*</span>
                              <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                  <select name="role" class="form-control select2">
                                      <option value={{$funcao->id}}>{{$funcao->nome}}</option> 
                                  @if ($funcoes)
                                      @php($n = 1)
                                        @foreach ($funcoes as $key => $funcao)
                                    <option value={{$funcao->id}}>{{$funcao->nome}}</option> 
                                    @endforeach
                                    @endif
                                  </select>                     
                                  <small class="text-danger">{{ $errors->first('role') }}</small>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                {!! Form::label('mobile', 'Celular.') !!}
                                
                                {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'ex: (11) 9 9999-9999']) !!}
                                <small class="text-danger">{{ $errors->first('mobile') }}</small>
                              </div>
                              <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                {!! Form::label('city', 'Cidade') !!}
                                {!! Form::text('city', null, ['class' => 'form-control', 'placeholder'=>'Digite a cidade']) !!}
                                <small class="text-danger">{{ $errors->first('city') }}</small>
                              </div>
                              <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                {!! Form::label('address', 'Endereço') !!}
                                {!! Form::textarea('address', null, ['class' => 'form-control', 'rows'=>'5', 'placeholder' => 'Digite o endereço']) !!}
                                <small class="text-danger">{{ $errors->first('address') }}</small>
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
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
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
