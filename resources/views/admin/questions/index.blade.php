@extends('layouts.admin', [
  'page_header' => 'Adicionar Questões',
  'page_icon' => 'fa fa-question-circle-o',
  'dash' => '',
  'users' => '',
  'funcao' => '',
  'matriz' => '',
  'quiz' => '',
  'questions' => 'active',
  'top_re' => '',
  'all_re' => '',
  'sett' => ''
])

@section('content')
  <div class="row">
    @if ($topics)
      @foreach ($topics as $key => $topic)
        <div class="col-md-4">
          <div class="quiz-card">
            <h3 class="quiz-name">
              <span class="glyphicon glyphicon-star icone" aria-hidden="true"></span> {{$topic->title}}
            </h3>
            <p title="{{$topic->description}}">
              {{str_limit($topic->description, 120)}}
            </p>
            <div class="row">
              <div class="col-xs-6 pad-0">
                <ul class="topic-detail">
                  <li>Tempo por Questão <i class="fa fa-long-arrow-right"></i></li>
                  <li>Total Marks <i class="fa fa-long-arrow-right"></i></li>
                  <li>Questões Total <i class="fa fa-long-arrow-right"></i></li>
                  <li>Tempo Total <i class="fa fa-long-arrow-right"></i></li>
                </ul>
              </div>
              <div class="col-xs-6">
                <ul class="topic-detail right">
                  <li>{{$topic->per_q_mark}}</li>
                  <li>
                    @php
                        $qu_count = 0;
                    @endphp
                    @foreach($questions as $question)
                      @if($question->topic_id == $topic->id)
                        @php 
                          $qu_count++;
                        @endphp
                      @endif
                    @endforeach
                    {{$topic->per_q_mark*$qu_count}}
                  </li>
                  <li>
                    {{$qu_count}}
                  </li>
                  <li>
                    {{$topic->timer}} minutos
                  </li>
                </ul>
              </div>
            </div>
            <a href="{{route('questions.show', $topic->id)}}" class="btn btn-wave">
                <i class="fa fa-plus"></i>  Adicionar Questão
            </a>
            <a data-target="#deleteans{{ $topic->id }}" data-toggle="modal" class="btn btn-danger">
              <i class="fa fa-times-circle"> </i>   Excluir Questão
            </a>
          </div>

          <div id="deleteans{{ $topic->id }}" class="delete-modal modal fade" role="dialog">
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
                          {!! Form::open(['method' => 'DELETE', 'action' => ['TopicController@deleteperquizsheet', $topic->id]]) !!}
                            {!! Form::reset("Não", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                            {!! Form::submit("Sim", ['class' => 'btn btn-danger']) !!}
                          {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                  </div>
        </div>
      @endforeach
    @endif
  </div>
@endsection
