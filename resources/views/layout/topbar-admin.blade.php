

<nav class="main-header">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <span class="logo-mini"><img src="{{ storage('web-img/icon-admin.png') }}"></span>
        <span class="logo-lg"><img src="{{ storage('web-img/logo-admin.png') }}"></span>
    </a>
    <div class="navbar navbar-static-top">
        <a href="#" onclick="toggleSidebar()" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i>&nbsp;&nbsp;Return to {{ config('app.name') }}</a>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ Auth::user()->headshot() }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{  Auth::user()->headshot() }}" class="img-circle" alt="User Image">
                            <p>
                                {{ Auth::user()->username }}
                                <small>{{ Auth::user()->adminRank() }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('users.profile', ['id' => Auth::user()->id, 'username' => Auth::user()->username]) }}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Logout</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
