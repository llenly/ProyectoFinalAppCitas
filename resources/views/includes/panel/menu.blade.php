
{{-- menu lateral --}}
<h6 class="navbar-heading text-muted">Gestion</h6>
<ul class="navbar-nav">
    <li class="nav-item  active ">
        <a class="nav-link  active " href="./index.html">
            <i class="ni ni-tv-2 text-danger"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ url('/servicios') }}">
            <i class="ni ni-briefcase-24 text-blue"></i> Sevicios
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ url('/personalTrainers') }}">
            <i class="fas fa-stethoscope text-info"></i> PersonalTrainer
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ url('/clientes') }}">
            <i class="ni ni-single-02 text-warning"></i> Clientes
        </a>
    </li>
   
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
            <i class="fas fa-sign-in-alt"></i> Cerrar Session
        </a>

        <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
            @csrf

        </form>
    </li>
</ul>

<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-muted">Reportes</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-books text-default"></i> Citas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-chart-bar-32 text-warning"></i> Desempeño Medico Profesional
        </a>
    </li>
   
</ul>


