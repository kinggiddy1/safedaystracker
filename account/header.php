    <nav class="top-app-bar navbar navbar-expand navbar-dark" style="background-color: #EC407A;">
    <div class="container-fluid px-4">
        <!-- Drawer toggle button-->
        <button class="btn btn-lg btn-icon order-1 order-lg-0" id="drawerToggle" href="javascript:void(0);"><i class="material-icons">menu</i></button>
        <!-- Navbar brand-->
        <a class="navbar-brand me-auto" href="dashboard.php"><div class="">SAFE DAYS TRACKER</div></a>
        <!-- Navbar items-->
        <div class="d-flex align-items-center mx-3 me-lg-0">
            <!-- Navbar-->
            <ul class="navbar-nav d-none d-lg-flex">
                <li class="nav-item"><span class="nav-link" href="">Hello <?php echo $userData['names']; ?></a></li>
            </ul>
            <!-- Navbar buttons-->
            <div class="d-flex">
                <div class="dropdown dropdown-notifications d-none d-sm-block">
                    <button class="btn btn-lg btn-icon dropdown-toggle me-3" id="dropdownMenuMessages" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">mail_outline</i></button>
                </div>

                <div class="dropdown"><a href="logout.php">
                    <button class="btn btn-lg btn-icon dropdown-toggle" id="dropdownMenuProfile" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">person</i></button>
                    <ul class="dropdown-menu dropdown-menu-end mt-3" aria-labelledby="dropdownMenuProfile">
                        <li>
                            <a class="dropdown-item" href="#!">
                                <i class="material-icons leading-icon">logout</i>
                                <div class="me-3">Logout</div>
                            </a>
                        </li>
                    </ul>
                </div></a>
            </div>
        </div>
    </div>
    </nav>