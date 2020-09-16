@extends('layouts.app')

@section('head')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <script>
    window.Laravel =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
@endsection

@section('top_bar')
  <nav class="navbar navbar-default navbar-static-top">
    <div class="logo-main-block">
      <div class="container">
        @if ($setting)
          <a href="{{ url('/') }}" title="{{$setting->welcome_txt}}">
            <img src="{{asset('/images/logo/'. $setting->logo)}}" class="img-responsive" alt="{{$setting->welcome_txt}}">
          </a>
        @endif
      </div>
    </div>
    <div class="nav-bar">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="navbar-header">
              <!-- Branding Image -->
              @if($setting)
                <a class="tt" title="Quiz Home" href="{{url('/')}}"><h4 class="heading">{{$setting->welcome_txt}}</h4></a>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                  <li><a href="{{ route('login') }}" title="Entrar">Entrar</a></li>
                  <li><a href="{{ route('register') }}" title="Cadastrar-me">Cadastrar-me</a></li>
                @else
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                      {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      @if ($auth->role == 'A')
                        <li><a href="{{url('/admin')}}" title="Dashboard">Dashboard</a></li>
                      @elseif ($auth->role == 'S')
                        <li><a href="{{url('/admin/my_reports')}}" title="Dashboard">Dashboard</a></li>
                      @endif
                      <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Sair
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                      </li>
                    </ul>
                  </li>
                 
                @endguest
                  <li><a href="{{url('pages/how-it-works')}}">Regulamento</a></li>
                  <li><a href="{{url('pages/about-us')}}">Sobre</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
@endsection

@section('content')
<div class="container">
  @if ($auth)
    <div class="quiz-main-block">
      <div class="row">
        @if ($topics)
          @foreach ($topics as $topic)
            <div class="col-md-4">
              <div class="topic-block">
                <div class="card blue-grey darken-1">
                  <div class="card-content white-text">
                    <span class="card-title">{{$topic->title}}</span>
                    <p title="{{$topic->description}}">{{str_limit($topic->description, 150)}}</p>
                    <div class="row">
                      <div class="col-xs-6 pad-0">
                        <ul class="topic-detail">
                          <li>Questões <i class="fa fa-long-arrow-right"></i></li>
                          <li>Tempo <i class="fa fa-long-arrow-right"></i></li>
                        </ul>
                      </div>
                      <div class="col-xs-6">
                        <ul class="topic-detail right">
                          <li>
                            @php
                                $qu_count = 0;
                            @endphp
                            @foreach($questions as $question)
                           
                              @php
                                var_dump($question->id);
                                var_dump($topic->id);
                                var_dump($question->topic_id);
                              @endphp
                              @if($question->topic_id == $topic->id)
                                @php 
                                  $qu_count++;
                                @endphp
                              @endif
                            @endforeach
                            {{$qu_count}}
                          </li>
                          <li>
                            {{$topic->timer}} min.
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>


               <div class="card-action text-center">
                  
                  @if (Session::has('added'))
                    <div class="alert alert-success sessionmodal">
                      {{session('added')}}
                    </div>
                  @elseif (Session::has('updated'))
                    <div class="alert alert-info sessionmodal">
                      {{session('updated')}}
                    </div>
                  @elseif (Session::has('deleted'))
                    <div class="alert alert-danger sessionmodal">
                      {{session('deleted')}}
                    </div>
                  @endif

                    @if($auth->topic()->where('topic_id', $topic->id)->exists())
                      <a href="{{route('start_quiz', ['id' => $topic->id])}}" class="btn btn-primary" title="Iniciar Avaliação">Iniciar Avaliação</a>
                    @else
                      {!! Form::open(['method' => 'POST', 'action' => 'PaypalController@paypal_post']) !!} 
                        {{ csrf_field() }}
                        <input type="hidden" name="topic_id" value="{{$topic->id}}"/>
                          <a href="{{route('start_quiz', ['id' => $topic->id])}}" class="btn btn-primary" title="Iniciar Avaliação">Iniciar Avaliação</a>
                      {!! Form::close() !!}
                    @endif
                  </div>


                {{--   <div class="card-action">
                    @php 
                      $a = false;
                      $que_count = $topic->question ? $topic->question->count() : null;
                      $ans = $auth->answers;
                      $ans_count = $ans ? $ans->where('topic_id', $topic->id)->count() : null;
                      if($que_count && $ans_count && $que_count == $ans_count){
                        $a = true;
                      }
                    @endphp
                    <a href="{{$a ? url('start_quiz/'.$topic->id.'/finish') : route('start_quiz', ['id' => $topic->id])}}" class="btn btn-block" title="Start Quiz">Start Quiz
                    </a>
                  </div> --}}
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  @endif
  @if (!$auth)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="home-main-block">
              @if ($setting)
                <h1 class="main-block-heading text-center">{{$setting->welcome_txt}}</h1>
              @endif
                <blockquote>
                  Por favor, faça o <a href="{{ route('login') }}">Login</a> Para Iniciar o Quiz >>>
                </blockquote>
            </div>
        </div>
    </div>
  @endif
</div>


@endsection

@section('scripts')

<script>
   $( document ).ready(function() {
       $('.sessionmodal').addClass("active");
       setTimeout(function() {
           $('.sessionmodal').removeClass("active");
      }, 4500);
    });
</script>


 @if($setting->right_setting == 1)
  <script type="text/javascript" language="javascript">
   // Right click disable
    $(function() {
    $(this).bind("contextmenu", function(inspect) {
    inspect.preventDefault();
    });
    });
      // End Right click disable
  </script>
@endif

@if($setting->element_setting == 1)
<script type="text/javascript" language="javascript">
//all controller is disable
      $(function() {
      var isCtrl = false;
      document.onkeyup=function(e){
      if(e.which == 17) isCtrl=false;
}

      document.onkeydown=function(e){
       if(e.which == 17) isCtrl=true;
      if(e.which == 85 && isCtrl == true) {
     return false;
    }
 };
      $(document).keydown(function (event) {
       if (event.keyCode == 123) { // Prevent F12
       return false;
  }
      else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
     return false;
   }
 });
});
     // end all controller is disable
 </script>


@endif
@endsection
