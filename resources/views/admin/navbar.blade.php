<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/admin') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="{{ Route::currentRouteName() == 'new-appointments' ? 'active' : '' }}">
                    <a href="/admin/appointments/open">Nieuwe afspraken <span class="sr-only">(current)</span></a>
                </li>

                <li class="{{ Route::currentRouteName() == 'all-appointments' ? 'active' : '' }}"><a href=" /admin/appointments/all ">Alle afspraken</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right ">

                <li>
                    <a href="/ "><span class="glyphicon glyphicon-calendar " aria-hidden="true "></span> Agenda
                            </a>
                </li>


                <li class="dropdown ">
                    <a href="# " class="dropdown-toggle " data-toggle="dropdown " role="button " aria-expanded="false
                    " aria-haspopup="true ">
                                    {{ Auth::user()->name }} <span class="caret "></span>
                                </a>

                    <ul class="dropdown-menu ">
                        <li>
                            <a href="{{ route( 'logout') }} " onclick="event.preventDefault(); document.getElementById(
                    'logout-form').submit(); ">
                                            Uitloggen
                                        </a>

                            <form id="logout-form " action="{{ route( 'logout') }} " method="POST " style="display: none; ">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>