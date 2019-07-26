<!-- Main content -->
<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-light" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <h4 class="h4 mb-0 text-dark text-uppercase d-none d-lg-inline-block">
                <?= checkPage("admin") ?>
            </h4>
            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="<?= $_SESSION["admin"] -> firstName ?>" src="<?= BASE_URL ?>/assets/app/images/users/profile/small/<?= $_SESSION["admin"] -> small ?>">
                            </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold"><?= $_SESSION["admin"] -> firstName ?> <?= $_SESSION["admin"] -> lastName ?></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="models/app/users/logout.php" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>