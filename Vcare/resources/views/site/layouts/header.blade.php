<nav class="navbar navbar-expand-lg navbar-expand-md bg-blue sticky-top shadow">
    <div class="container">
        <div class="navbar-brand">
            <a class="fw-bold text-white m-0 text-decoration-none h3" href="{{route("home.index")}}">VCare</a>
        </div>
        <button class="navbar-toggler btn-outline-light border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <div class="d-flex gap-3 flex-wrap justify-content-center" role="group">
                    <a type="button" class="btn navigation--button text-white" href="{{route("home.index")}}">Home</a>
                    <a type="button" class="btn navigation--button text-white" href="{{route("majors.index")}}">majors</a>
                    <a type="button" class="btn navigation--button text-white" href="{{route("doctors.index")}}">Doctors</a>
                    @if (Auth::user())
                    <a type="button" class="btn navigation--button text-white" href="{{route("booking.show")}}">Bookings</a>
                    @endif
                    @if (Auth::guard('admin')->user())
                    <a type="button" class="btn navigation--button text-white" href="{{route("admin.dashboard")}}">Dashboard</a>
                    @endif
                    @if (!Auth::user()&&!Auth::guard('admin')->user())
                    <a type="button" class="btn navigation--button text-white" href="{{route("login.index")}}">login</a>          
                    @endif
                </div>
            </div>
            <div class="navbar align-self-center d-flex gap-3">
                <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                        <div class="input-group-text">
                            <i class="fa fa-fw fa-search"></i>
                        </div>
                    </div>
                </div>
                <a class="nav-icon d-none d-lg-inline" href="#">
                    <i class="fa fa-fw fa-search text-light"></i>
                </a>
                @if (Auth::user())
                <a class="nav-icon position-relative text-decoration-none" href="{{ route('profile') }}">
                    <i class="fas fa-user text-light"></i>
                    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                </a>
                <a class="nav-icon position-relative text-decoration-none" href="{{route('auth.logout')}}">
                    <i class="fa-solid fa-right-from-bracket text-light"></i>
                    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                </a>
                @endif
            </div>
        </div>
    </div>
</nav>