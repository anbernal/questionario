@extends('layouts.admin', [
  'page_header' => 'RESULTADO POR COLABORADOR',
  'page_icon' => 'fa fa-user',
  'dash' => '',
  'users' => '',
  'funcao' => '',
  'matriz' => '',
  'quiz' => '',
  'questions' => '',
  'top_re' => 'active',
  'all_re' => '',
  'user_re' => '',
  'sett' => ''
])

@section('content')
<div class="margin-bottom">
<div class="info-box">
  <span class="info-box-icon bg-blue"><i class="fa fa-check"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Colaborador</span>
    <span class="info-box-number">{{$user_name}}</span>
  </div>
</div>

<a  href="{{url('/admin/user_result')}}" class="btn btn-wave"><i class="fa fa-arrow-circle-left"></i>&nbsp&nbsp Voltar</a>
  </div>
  <div class="row">
    @if ($topics)
      @foreach ($topics as $key => $topic)
        <div class="col-md-4">
          <div class="quiz-card">
            <h3 class="quiz-name">{{$topic->title}}</h3>
            <p title="{{$topic->description}}">
              {{str_limit($topic->description, 200)}}
            </p>
            <div class="row">
              <div class="col-xs-6 pad-0">
                <ul class="topic-detail">
                  <li>Muito Bom <i class="fa fa-long-arrow-right"></i></li>
                  <li>Bom <i class="fa fa-long-arrow-right"></i></li>
                  <li>Regular <i class="fa fa-long-arrow-right"></i></li>
                  <li>Ruim <i class="fa fa-long-arrow-right"></i></li>
                </ul>
              </div>
              <div class="col-xs-6">
                <ul class="topic-detail right">
                  <li>
                    @php
                    $respA = 0;
                  @endphp
                  @foreach ($answers as $answer)
                  @if ($answer->topic_id == $topic->topics_id && $answer->user_answer == "A")
                      @php

                      $respA++;
                      @endphp
                    @endif
                  @endforeach
                  {{$respA}}
                  </li>
                  <li>
                    @php
                    $respB = 0;
                  @endphp
                  @foreach ($answers as $answer)
                    @if ($answer->topic_id == $topic->topics_id && $answer->user_answer == "B")
                      @php
                      $respB++;
                      @endphp
                    @endif
                  @endforeach
                  {{$respB}}
                  </li>
                  <li>
                    @php
                    $respC = 0;
                  @endphp
                  @foreach ($answers as $answer)
                    @if ($answer->topic_id == $topic->topics_id && $answer->user_answer == "C")
                      @php
                      $respC++;
                      @endphp
                    @endif
                  @endforeach
                  {{$respC}}
                  </li>
                  <li>
                  @php
                    $respD = 0;
                  @endphp
                  @foreach ($answers as $answer)
                    @if ($answer->topic_id == $topic->topics_id && $answer->user_answer == "D")
                      @php
                      $respD++;
                      @endphp
                    @endif
                  @endforeach
                  {{$respD}}
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    @endif
  </div>
@endsection
