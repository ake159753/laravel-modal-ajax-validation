<nav class="navbar navbar-expand-lg navbar-light bg-info">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav" >
            <li class="nav-item @if(\Route::current()->getName() == 'welcome')active @endif">
                <a class="nav-link text-white @if(\Route::current()->getName() == 'welcome')font-weight-bold @endif" href="{{route('welcome')}}">Ajax</a>
            </li>
            <li class="nav-item @if(\Route::current()->getName() == 'datatables')active @endif">
                <a class="nav-link text-white @if(\Route::current()->getName() == 'datatables')font-weight-bold @endif" href="{{route('datatables')}}">Data Tables</a>
            </li>
            <li class="nav-item @if(\Route::current()->getName() == 'form')active @endif">
                <a class="nav-link  text-white @if(\Route::current()->getName() == 'form')font-weight-bold @endif" href="{{route('form')}}">Forms</a>
            </li>
        </ul>
    </div>
</nav>
