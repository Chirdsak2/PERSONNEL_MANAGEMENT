<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">บริหารจัดการบุคลากร</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">เกี่ยวกับ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">บุคลากร</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">การจัดการ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Link
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Link</a>
                </li>
            </ul>
            {{-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> --}}
            <ul class="navbar-nav ml-auto"> <!-- ทำให้เนื้อหาอยู่ชิดขวา -->
                <li class="nav-item">
                    <span class="nav-link">{{ session('prefix_name_th') }}{{ session('firstname') }} {{ session('lastname') }}</span>
                    <!-- แสดงชื่อ-นามสกุล -->
                </li>
            </ul>
            {{-- @auth <!-- ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่ -->
                 <li class="nav-item">
                     <span class="nav-link">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
                 </li>
             @endauth --}}
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ออกจากระบบ
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
