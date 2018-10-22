    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="/" class="simple-text logo-normal">
          Admin PRC Rancagua
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{ Request::is('home*') ? 'active':'' }}">
            <a class="nav-link" href="/home">
              <i class="material-icons">home</i>
              <p>Inicio</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('poligons*') ? 'active':'' }}">
            <a class="nav-link" href="/poligons">
              <i class="material-icons">bubble_chart</i>
              <p>PRC (Poligonos)</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('areas*') ? 'active':'' }}">
            <a class="nav-link" href="/areas">
              <i class="material-icons">map</i>
              <p>Areas</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('account*') ? 'active':'' }}">
            <a class="nav-link" href="/account">
              <i class="material-icons">person</i>
              <p>Mi Cuenta</p>
            </a>
          </li>
         <li class="nav-item d-lg-block d-md-none">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="material-icons">logout</i>
              <p>Salir</p>
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
          <!-- <li class="nav-item active-pro ">
                <a class="nav-link" href="./upgrade.html">
                    <i class="material-icons">unarchive</i>
                    <p>Upgrade to PRO</p>
                </a>
            </li> -->
        </ul>
      </div>
    </div>