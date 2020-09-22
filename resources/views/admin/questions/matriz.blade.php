@extends('layouts.admin', [
  'page_header' => 'Matriz de Competência',
  'page_icon' => 'fa fa-file-text',
  'dash' => '',
  'quiz' => '',
  'users' => '',
  'funcao' => '',
  'matriz' => 'active',
  'questions' => '',
  'top_re' => '',
  'all_re' => '',
  'user_re' => '',
  'sett' => ''
])

@section('content')


<div class="row">
    @if ($topics)
      @foreach ($topics as $key => $topic)
        <div class="col-md-4">
          <div class="quiz-card">
            <h4 class="quiz-name">
              <span class="glyphicon glyphicon-star icone" aria-hidden="true"></span> 
                {{$topic->title}}
            </h4>
            <p title="{{$topic->description}}">
            </p>
            <div class="row">
                
                <hr>
                <div class="col-md-12">
                      <div class="alert alert-info" role="alert">
                          <a href="" class="alert-link" data-toggle="modal" data-target="#{{$topic->id}}modalCadastar"> Clique aqui </a>
                          para adicionar uma função.  
                      </div>
                      
                        @foreach ($matriz as $key => $mat)
                              @if ($mat->title == $topic->title)
                                <span class="label label-primary">{{$mat->nome}} &nbsp;&nbsp; 
                                    <a data-target="#{{$mat->id}}deleteans" data-toggle="modal" class="badge">
                                      <i class="fa fa-close"> </i> 
                                      </a>
                                </span>  
                                <br>  
                              @endif
                              <div id="{{$mat->id}}deleteans" class="delete-modal modal fade" role="dialog">
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
                                        {!! Form::open(['method' => 'DELETE', 'action' => ['MatrizController@destroy', $mat->id]]) !!}
                                          {!! Form::reset("Não", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                                          {!! Form::submit("Sim", ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                      </div>
                                    </div>
                                  </div>
                                </div>      


                        @endforeach
                  </div>
              <!-- Modal Adicionar Função -->
           <div id="{{$topic->id}}modalCadastar" class="modal fade" role="dialog">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Adicionar Função para Competência </h4>
                  </div>
                  {!! Form::open(['method' => 'POST', 'action' => ['MatrizController@store',$topic->id]]) !!}
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-8">
                          <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            {!! Form::label('nome', 'Ocupação/Cargo') !!}
                            <span class="required">*</span>
                            <select name="funcaos_id" class="form-control select2">
                                <option value=0>Selecione...</option>
                            @if ($funcaos)
                                @php($n = 1)
                                  @foreach ($funcaos as $key => $funcao)
                              <option value={{$funcao->id}}>{{$funcao->nome}}</option> 
                              @endforeach
                              @endif
                            </select>  
                            <small class="text-danger">{{ $errors->first('nome') }}</small>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <div class="btn-group pull-right">
                        {!! Form::submit("Adicionar", ['class' => 'btn btn-wave']) !!}
                      </div>
                    </div>
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
            <!-- Fim Modal CAdastrar -->
            </div>
          </div>
        </div>
      @endforeach
      <hr>
    @endif
    <hr>
  </div>

@endsection

@section('scripts')
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=9z77wjhpwrx6pvh3r3oeiky25krlx0jzd8m69yte73hjrrgg"></script>
  <script>
  tinymce.init({
                selector: 'textarea',
                plugins: 'table,textcolor,image,lists,link,code,wordcount,advlist, autosave',
                theme: 'modern',
                menubar: 'none',
                height : '200',
                toolbar: 'restoredraft,bold italic underline | fontselect |  fontsizeselect | forecolor backcolor |alignleft aligncenter alignright alignjustify| bullist,numlist | link image'
  });
</script>
  <script>
  @endsection
