<?php 
require_once __DIR__.'/Controllers/donorController.php';
if( (!isset($_SESSION["adminid"])) )
{
  header("Location:login.php");
}
?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="./assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Home Page - Sneat</title>

    <meta name="description" content="" />

    
<?php
require_once __DIR__.'/../admin/Includes/headerFiles.php';
?>
    
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        
        <!-- Menu -->
        <?php require_once __DIR__.'/Includes/navbar.php'; ?>

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
             
            
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="dropdown-item" href="logout.php">
                  <i class="bx bx-power-off me-2"></i>
                  <span class="align-middle">Log Out</span>
                  </a>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Welcome Back <strong>@<?= $_SESSION["username"]; ?>!</strong> 🎉</h5>
                          <p class="mb-4">
                            You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                            your profile.
                          </p>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="./assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 order-1">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 mb-3">
                      <div class="card">
                        <div class="card-body">
                          
                          <span class="card-title text-primary">Total Donors</span>
                          <h3 class="card-title text-nowrap mb-1"><?= $totalDonors; ?></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-md-6 col-lg-6 order-1">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 mb-3">
                      <div class="card">
                        <div class="card-body">
                          
                          <span class="card-title text-primary">Total Defaulters</span>
                          <h3 class="card-title text-nowrap mb-1"></h3>
                        </div>
                      </div>
                    </div>
                    <!-- </div>
    <div class="row"> -->
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <?php require_once __DIR__.'/Includes/footerFiles.php'; ?>
  </body>
</html>
