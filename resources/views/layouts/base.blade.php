<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=شي, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - لوحة القيادة</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
 

        
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <header>
        <!-- Navbar -->

        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Navbar brand -->
                <a class="navbar-brand" href="#">Brand</a>

                <!-- Icons -->
                <ul class="navbar-nav d-flex flex-row me-1">
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link text-white" href="#"><i class="fas fa-envelope mx-1"></i> Contact</a>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link text-white" href="#"><i class="fas fa-cog mx-1"></i> Settings</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false"> <i class="fas fa-user mx-1"></i> Welcome {{ Auth::user()->name }}!
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="#">My account</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">Log out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <main>
        <div class="row">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark text-white">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span
                                    class="ms-1 d-none d-sm-inline  text-white">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i> <span
                                    class="ms-1 d-none d-sm-inline  text-white">Product</span> </a>

                        </li>
                        <li>
                            <a href="{{ route('productDetails') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline  text-white">Product
                                    Deatals</span></a>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span
                                    class="ms-1 d-none d-sm-inline text-white">Cards</span></a>

                        </li>
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-grid"></i> <span
                                    class="ms-1 d-none d-sm-inline text-white">Invoice</span> </a>

                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span
                                    class="ms-1 d-none d-sm-inline text-white">Customers</span> </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                                class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">loser</span>
                        </a>

                    </div>

                </div>

            </div>
            <div class="col-sm-8">
                @yield('content')
            </div>

        </div>


    </main>
    <footer></footer>
</body>

</html>
