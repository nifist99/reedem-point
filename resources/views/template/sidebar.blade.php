<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

      @auth

        <li class="nav-item @if($link=='dashboard') active @endif">
          <a class="nav-link" href="{{url('dashboard')}}">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>

        <li class="nav-item nav-category">Menu</li>

        {{-- SETTINGAN DARI CMS MENUS --}}
        @foreach (Nfs::menu(Session::get('id')) as $menu_access)

            @php
              $sub = Nfs::submenuSidebar(Session::get('id'),$menu_access->cms_menus_id);
            @endphp

            @if(count($sub) == 0)
                <li class="nav-item @if($link==$menu_access->url) active @endif">
                  <a class="nav-link" href="{{url($menu_access->url.'/'.Nfs::Encrypt($menu_access->cms_menus_id))}}" >
                    <i class="menu-icon mdi {{$menu_access->icon}}"></i>
                    <span class="menu-title">{{$menu_access->name}}</span>
                  </a>
                </li>
            @else
                <li class="nav-item @if($link==$menu_access->url) open active @endif">
                  <a class="nav-link" data-bs-toggle="collapse" href="#{{$menu_access->url}}" aria-expanded="false" aria-controls="{{$menu_access->url}}">
                    <i class="menu-icon mdi {{$menu_access->icon}}"></i>
                    <span class="menu-title">{{$menu_access->name}}</span>
                    <i class="menu-arrow"></i> 
                  </a>
                  <div class="collapse" id="{{$menu_access->url}}">
                    <ul class="nav flex-column sub-menu">
                      @foreach($sub as $submenu)
                        <li class="nav-item @if($link==$submenu->url) active @endif"> 
                          <a class="nav-link" href="{{url($submenu->url.'/'.Nfs::Encrypt($submenu->cms_menus_id))}}">
                            {{$submenu->name}}
                          </a>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </li>
            @endif
            
        @endforeach

        {{-- account setting --}}
{{-- 
        <li class="menu-item @if($link=='account' or $link=='password') open active @endif">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Account Settings">Account Settings</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item @if($link=='account') active @endif ">
              <a href="{{url('account')}}" class="menu-link">
                <div data-i18n="Account">Account</div>
              </a>
            </li>
            <li class="menu-item @if($link=='password') active @endif">
              <a href="{{url('password')}}" class="menu-link">
                <div data-i18n="Notifications">Change Password</div>
              </a>
            </li>
          </ul>
        </li> --}}

      @endauth

      @if(Session::get('cms_role_id') ==1 or Session::get('cms_role_id') ==2 )
        @auth
        
        <li class="nav-item nav-category">Menu Admin</li>

        <li class="nav-item @if($link=='cms_role') active @endif">
          <a class="nav-link" href="{{url('admin/role')}}">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Roles Management</span>
          </a>
        </li>

        <li class="nav-item @if($link=='users') active @endif">
          <a class="nav-link" href="{{url('admin/users')}}">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Users Management</span>
          </a>
        </li>

        <li class="nav-item @if($link=='cms_settings') active @endif">
          <a class="nav-link" href="{{url('admin/settings')}}">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Settings</span>
          </a>
        </li>

        <li class="nav-item @if($link=='cms_logs') active @endif">
          <a class="nav-link" href="{{url('admin/logs')}}">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Log Users Access</span>
          </a>
        </li>

          
        @endauth
      @endif


      @if(Session::get('cms_role_id') ==1)
        @auth

        <li class="nav-item nav-category">Menu Superadmin</li>

        <li class="nav-item @if($link=='cms_menus') active @endif">
          <a class="nav-link" href="{{url('admin/menus')}}">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Menu Management</span>
          </a>
        </li>

        <li class="nav-item @if($link=='cms_modules') active @endif">
          <a class="nav-link" href="{{url('admin/modules')}}">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Module Generator</span>
          </a>
        </li>


        <li class="nav-item @if($link=='cms_emails') active @endif">
          <a class="nav-link" href="{{url('admin/emails')}}">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Email Templates</span>
          </a>
        </li>

        <li class="nav-item @if($link=='cms_document') active @endif">
          <a class="nav-link" href="{{url('admin/document')}}">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Documentation</span>
          </a>
        </li>

        @endauth
      @endif

    </ul>
  </nav>