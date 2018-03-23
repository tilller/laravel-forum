<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
           <span class="sr-only" >Toggle Navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
       <!-- branding Image -->
       <a class="navbar-brand" href="{{url('/')}}">
         LaraBBS
       </a>
      </div>
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Od Navbar -->
          <ul class="nav navbar-nav">
            <li class="{{ active_class(if_route('topics.index'))}}"><a href="{{route('topics.index')}}">话题列表</a></li>
            <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 1))) }}"><a href="{{route('categories.show',1)}}">分享</a></li>
            <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 2))) }}"><a href="{{route('categories.show',2)}}">教程</a></li>
            <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 3))) }}"><a href="{{route('categories.show',3)}}">问答</a></li>
            <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 4))) }}"><a href="{{route('categories.show',4)}}">公告</a></li>
          </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                <li> <a href="{{route('login')}}"> 登录</a></li>
                <li> <a href="{{route('register')}}"> 注册</a></li>
                @else
                <li>
                  <a href="{{route('topics.create')}}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                  </a>
                  {{--消息通知 --}}
                  <li>
                         <a href="{{ route('notifications.index') }}" class="notifications-badge" style="margin-top: -2px;">
                             <span class="badge badge-{{ Auth::user()->notifications_count > 0 ? 'hint' : 'fade' }} " title="消息提醒">
                                 {{ Auth::user()->notifications_count }}
                             </span>
                         </a>
                     </li>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown"data-toggle="dropdown" role="button" >
                    <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                      <img style="width:44px; height:44px;border-radius: 50%" src="{{Auth::user()->avatar}}" alt="">
                    </span>
                    {{Auth::user()->name}}<span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="meun">
                          <li>
                                <a href="{{ route('users.show', Auth::id()) }}">
                                   <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                    个人中心
                                </a>
                          </li>
                           <li>
                               <a href="{{ route('users.edit', Auth::id()) }}">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                   编辑资料
                               </a>
                           </li>
                    <li>
                          <a href="{{route('logout')}}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit()">
                            <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                          退出登录
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                    </li>
                  </ul>
                </li>
              @endguest
            </ul>
      </div>
    </div>
</nav>
