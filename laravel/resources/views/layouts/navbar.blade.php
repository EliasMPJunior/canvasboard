
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">

      <h5 class="my-0 mr-md-auto font-weight-normal">
        <a class="navbar-brand text-dark" href="{{ url('/') }}">
          <strong>{{ config('app.name', '') }}</strong><span class="ml-2 badge badge-pill badge-secondary"><i>beta</i></span>
        </a>
      </h5>

      <nav class="my-2 my-md-0 mr-md-5 float-right">
        @isset($front_control)
          @foreach ($front_control->menu_bar as $menu_bar)
        <a class="p-2 text-dark" href="{{ route($menu_bar->route) }}">{{ $menu_bar->name }}</a>
          @endforeach
        @endisset
      </nav>

      <nav class="navbar navbar-expand-lg">
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav">
          <!-- Authentication Links -->
          @guest
          <li class="nav-item">
            <a class="nav-link btn btn-outline-primary mx-2" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
            @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link btn btn-outline-dark mx-2" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
            @endif
          @else
          <li class="nav-item dropdown">
            <div class="btn-group" role="group">
              <button id="btnGroupUser" type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hello, {{ Auth::user()->name }}
              </button>
              <div class="dropdown-menu" aria-labelledby="btnGroupUser">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </div>
          </li>
          @endguest
        </ul>
        <!-- End Right Side Of Navbar -->
      </nav>

    </div>