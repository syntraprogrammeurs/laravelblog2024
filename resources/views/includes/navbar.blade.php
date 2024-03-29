<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
<!-- Navbar Brand-->
<a class="navbar-brand ps-3" href="index.html">FS DEVELOPERS</a>
<!-- Sidebar Toggle-->
<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
        class="fas fa-bars"></i></button>
<!-- Navbar Search-->
<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    <div class="input-group">
        <input name="search" class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
               aria-describedby="btnNavbarSearch" value="{{old('search')}}"/>
        @if(isset($fillableFields) && !empty($fillableFields))
            <div class="d-flex bg-white align-items-center">
                @foreach($fillableFields as $fillableField)
                    <div class="form-check me-2">
                        <input type="checkbox" class="form-check-input" value="{{$fillableField}}" id="{{$fillableField}}" name="fields[]" {{in_array($fillableField, (array)Request::get('fields',[])) ? 'checked': ''}}>
                        <label for="{{$fillableField}}" class="form-check-label">{{ucfirst($fillableField)}}</label>

                    </div>
                @endforeach
            </div>
        @endif
        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
    </div>
</form>
<!-- Navbar-->
<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
           aria-expanded="false">
            <img width="50" height="50" class="rounded-circle border border-2 border-white" src="{{asset(Auth::user()->photo ? 'assets/img/users/' . Auth::user()->photo->file : 'http://placeholder.it/30x30')}}" alt="{{Auth::user()->name}}">
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#!">Settings</a></li>
            <li><a class="dropdown-item" href="#!">Activity Log</a></li>
            <li>
                <hr class="dropdown-divider"/>
            </li>
            <li>
                <a class="dropdown-item" href="#" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </li>
</ul>
</nav>
