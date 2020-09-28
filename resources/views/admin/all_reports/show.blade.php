@extends('layouts.admin', [
  'page_header' => "Resultado do Tópico / {$topic->title}",
  'page_icon' => 'fa fa-file-text-o',
  'dash' => '',
  'users' => '',
  'funcao' => '',
  'matriz' => '',
  'quiz' => '',
  'questions' => '',
  'top_re' => '',
  'all_re' => 'active',
  'user_re' => '',
  'sett' => ''
])

@section('content')

<div class="container-fluid">
<div class="row">
        <div class="col-md-12">
          <div class="quiz-card">
            <h4 class="quiz-name">
              <span class="glyphicon glyphicon-star icone" aria-hidden="true"></span> 
              {{$topic->title}}
            </h4>
            
            <div class="row">  
              <div class="col-md-12">
              <div class="list-group-item active">
                
                  <h4 class="list-group-item-heading">Descrição do Tópico</h4>
                  <p class="list-group-item-text">{{$topic->description}}</p>
                  <hr>
                  <p class="list-group-item-text">Quantidade de Questões &nbsp;&nbsp;<span class="badge">
                 @php
                    $quantQuestoes = 0;
                  @endphp
                  @foreach ($answers as $answer)
                    @if ($answer->topic_id == $topic->id)
                      @php
                       $quantQuestoes++;
                      @endphp
                    @endif
                  @endforeach
                 {{$quantQuestoes}}
                  </span></p>
                  <p class="list-group-item-text" style="text-align: right;">
                  <a  href="{{url('/admin/all_reports')}}" class="btn btn-wave">Voltar</a>
                  </p>
              </div>
            </div>
          </div>
        </div>    
  </div>

</div>


  <div class="content-block box">
    <div class="box-body table-responsive">
      <table id="topTable" class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome Completo</th>
            <th>Muito Bom</th>            
            <th>Bom</th>
            <th>Regular</th>
            <th>Ruim</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
          @if ($answers)
            @foreach ($filtStudents as $key => $student)
              <tr>
                <td>
                  {{$key+1}}
                </td>
                <td>{{$student->name}}</td>
                <td>
                @php
                    $respA = 0;
                  @endphp
                  @foreach ($answers as $answer)
                    @if ($answer->topic_id == $topic->id && $answer->user_id == $student->id && $answer->user_answer == "A")
                      @php
                      $respA++;
                      @endphp
                    @endif
                  @endforeach
                  {{$respA}}
                
                </td>               
                <td>
                @php
                    $respB = 0;
                  @endphp
                  @foreach ($answers as $answer)
                    @if ($answer->topic_id == $topic->id && $answer->user_id == $student->id && $answer->user_answer == "B")
                      @php
                      $respB++;
                      @endphp
                    @endif
                  @endforeach
                  {{$respB}}
                </td>
                <td>
                  @php
                    $respC = 0;
                  @endphp
                  @foreach ($answers as $answer)
                    @if ($answer->topic_id == $topic->id && $answer->user_id == $student->id && $answer->user_answer == "C")
                      @php
                      $respC++;
                      @endphp
                    @endif
                  @endforeach
                  {{$respC}}
                </td>
                <td>
                @php
                    $respD = 0;
                  @endphp
                  @foreach ($answers as $answer)
                    @if ($answer->topic_id == $topic->id && $answer->user_id == $student->id && $answer->user_answer == "D")
                      @php
                      $respD++;
                      @endphp
                    @endif
                  @endforeach
                  {{$respD}}
                </td>
                <td>
                  <a data-toggle="modal" data-target="#delete{{ $topic->id }}" title="It will delete the answer sheet of this student" href="#" class="btn btn-sm btn-warning">
                    Reset Response
                  </a>

                  <div id="delete{{ $topic->id }}" class="delete-modal modal fade" role="dialog">
                      <!-- Delete Modal -->
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                            <h4 class="modal-heading">Are You Sure ?</h4>
                            <p>Do you really want to delete these record? This process cannot be undone.</p>
                          </div>
                          <div class="modal-footer">
                            {!! Form::open(['method' => 'DELETE', 'action' => ['AllReportController@delete', 'topicid' => $topic->id, 'userid' => $student->id] ]) !!}
                                {!! Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                                {!! Form::submit("Yes", ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>

                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
@endsection
