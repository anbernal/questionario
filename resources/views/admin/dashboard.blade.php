@extends('layouts.admin', [
  'page_header' => 'Dashboard',
  'page_icon' => 'fa fa-bar-chart',
  'dash' => 'active',
  'users' => '',
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

<!---->
  <div class="dashboard-block">
    
    
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <div class="small-box bg-gray">
              <div class="inner">
                <h3>{{$user}}</h3>
                <p>Total Colaboradores</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{url('/admin/users')}}" class="small-box-footer">
                Mais Informações <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>{{$user_faltantes}}</h3>
                <p>Total Pendentes</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-times"></i>
              </div>
              <a href="{{url('/admin/users')}}" class="small-box-footer">
                Mais Informações <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-12">
        <div class="row">
          
        <div class="col-md-3">
            <div class="info-box">
              <!-- Apply any bg-* class to to the icon to color it -->
              <span class="info-box-icon bg-blue"><i class="fa fa-tags"></i></span>
              <div class="info-box-content">
                <span class="info-box-text" style="font-size: 12px">Total Tópicos</span>
                <span class="info-box-number">{{$quiz}}</span>
                <a href="{{url('/admin/topics')}}" class="small-box-footer">
                Mais Informações <i class="fa fa-arrow-circle-right"></i>
              </a>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
          
          <div class="col-md-3">
            <div class="info-box">
              <!-- Apply any bg-* class to to the icon to color it -->
              <span class="info-box-icon bg-darken-2"><i class="fa fa-question"></i></span>
              <div class="info-box-content">
                <span class="info-box-text" style="font-size: 12px">Total Questões</span>
                <span class="info-box-number">{{$question}}</span>
              <a href="{{url('/admin/questions')}}" class="small-box-footer">
                Mais Informações <i class="fa fa-arrow-circle-right"></i>
              </a>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>

          <div class="col-md-3">
            <div class="info-box">
              <!-- Apply any bg-* class to to the icon to color it -->
              <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>
              <div class="info-box-content">
                <span class="info-box-text" style="font-size: 12px">Total Concluídos</span>
                <span class="info-box-number">{{$usuario_respendondido}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>

          <div class="col-md-3">
            <div class="info-box">
              <!-- Apply any bg-* class to to the icon to color it -->
              <span class="info-box-icon bg-orange"><i class="fa fa-clock-o"></i></span>
              <div class="info-box-content">
                <span class="info-box-text" style="font-size: 12px">Tempo médio Tópico</span>
                <span class="info-box-number">6 min</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>

        </div>
      </div>
  </div>


<div class="row">
      <div class="col-md-12">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h4 class="box-title">Ultimos Usuários</h4>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <ul class="users-list clearfix">
              @if ($user_latest)
                @foreach ($user_latest as $user)
                  <li>
                    <a class="users-list-name" href="#" title="{{$user->name}}">{{$user->name}}</a>
                    <span class="users-list-date">{{$user->created_at->diffForHumans()}}</span>
                  </li>
                @endforeach
              @endif
            </ul>
            <!-- /.users-list -->
          </div>
          <!-- /.box-body -->
         
          <div class="box-footer text-center">
            <a href="{{url('admin/users')}}" class="uppercase">Todos Usuários</a>
          </div>
       
          <!-- /.box-footer -->
        </div>
      </div>
    </div>
  </div>
@endsection
