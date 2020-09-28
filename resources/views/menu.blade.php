<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Menu Principal</li>
    @if ($auth->role == 'A')
      <!-- Optionally, you can add icons to the links -->
      <li class="{{$dash}}"><a href="{{url('/admin')}}" title="Dashboard">  <i class="fa fa-bar-chart"></i> <span>Dashboard</span></a></li>
      <li class="{{$users}}"><a href="{{url('/admin/users')}}" title="Colaborador"><i class="fa fa-users"></i> <span>Colaboradores</span></a></li>
      <li class="{{$funcao}}"><a href="{{url('/admin/funcao')}}" title="Cargo"><i class="fa fa-address-card-o"></i> <span>Ocupações - Cargo</span></a></li>
      <li class="{{$quiz}}"><a href="{{url('admin/topics')}}" title="Competências"><i class="fa fa-gears"></i> <span>Competências</span></a></li>          
      <li class="{{$questions}}"><a href="{{url('admin/questions')}}" title="Questões"><i class="fa fa-question-circle-o"></i> <span>Questões</span></a></li>
      <li class="{{$matriz}}"><a href="{{url('admin/matriz')}}" title="Matriz de Competências"><i class="fa fa-file-text"></i> <span>Matriz de Competências</span></a></li> 
      <!-- <li class="{{$top_re}}"><a href="{{url('/admin/top_report')}}" title="Top Resultado Colaborador"><i class="fa fa-user"></i> <span>Top Resultado Colaborador</span></a></li> -->
      <li class="{{$user_re}}"><a href="{{url('/admin/user_result')}}" title="Resultado Por Colaborador"><i class="fa fa-user-circle-o"></i> <span>Resultado por Colaborador</span></a></li> 
      <li class="{{$all_re}}"><a href="{{url('/admin/all_reports')}}" title="Resultados"><i class="fa fa-tags"></i> <span>Resultados por Tópicos</span></a></li>
       
      <li class="{{$sett}}"><a href="{{url('/admin/settings')}}" title="Configurações"><i class="fa fa-gear"></i> <span>Configurações</span></a></li>
      

      <li class="treeview {{ Nav::isRoute('pages.index') }} {{ Nav::isRoute('pages.add') }} {{ Nav::isRoute('pages.edit') }} {{ Nav::isRoute('faq.index') }} {{ Nav::isRoute('faq.add') }} {{ Nav::isRoute('faq.edit') }} {{ Nav::isRoute('copyright.index') }} {{ Nav::isRoute('set.facebook') }} {{ Nav::isRoute('customstyle') }} {{ Nav::isRoute('mail.getset') }} {{ Nav::isRoute('socialicons.index')}}">
        <a href="#">
          <i class="fa fa-user"></i> <span>Outras Configurações</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Nav::isRoute('pages.index') }} {{ Nav::isRoute('pages.add') }} {{ Nav::isRoute('pages.edit') }}"><a href="{{route('pages.index')}}"><i class="fa fa-circle-o"></i>Pages</a>
           </li>

           <li class="{{ Nav::isRoute('faq.index') }} {{ Nav::isRoute('faq.add') }} {{ Nav::isRoute('faq.edit') }}"><a href="{{route('faq.index')}}"><i class="fa fa-circle-o"></i>FAQ</a>
           </li>
            <!-- <li class="{{ Nav::isRoute('copyright.index') }}"><a href="{{route('copyright.index')}}"><i class="fa fa-circle-o"></i>Copyright</a>
           </li>

            <li class="{{ Nav::isRoute('set.facebook') }}"><a href="{{route('set.facebook')}}"><i class="fa fa-circle-o"></i>Social Login Setting</a>
           </li>

           <li class="{{ Nav::isRoute('socialicons.index')}}"><a href="{{route('socialicons.index')}}"><i class="fa fa-circle-o"></i>Social Icon</a>
           </li>
            <li class="{{ Nav::isRoute('mail.getset') }}"><a href="{{route('mail.getset')}}"><i class="fa fa-circle-o"></i>Mail Setting</a>
           </li>
           </li>
            <li class="{{ Nav::isRoute('customstyle') }}"><a href="{{route('customstyle')}}"><i class="fa fa-circle-o"></i>Custom Style Settings</a>
           </li> -->

        </ul>


      </li>
      <!-- 
      <li class="{{ Nav::isRoute('admin.payment') }}"><a href="{{route('admin.payment')}} " title="Payment History"><i class="fa fa-money"></i> <span>Histórico de Pagamentos</span></a></li> -->

    @elseif ($auth->role == 'S')
      <li><a href="{{url('/admin/my_reports')}}" title="Meu Histórico"><i class="fa fa-file-text-o"></i> <span>Meu Históricos</span></a></li>

      <li><a href="{{url('/admin/profile')}}" title="Meu Perfil"><i class="fa fa-file-text-o"></i> <span>Meu Perfil</span></a></li>

       {{-- <li><a href="{{url('/admin/payment')}}" title="Histórico Pagamentos"><i class="fa fa-money"></i> <span>Payment History</span></a></li> --}}
    @endif
  </ul>
  <!-- /.sidebar-menu -->