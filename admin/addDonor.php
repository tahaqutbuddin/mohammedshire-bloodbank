<?php 
require_once __DIR__.'/Controllers/donorController.php'; 
if( (!isset($_SESSION["userid"])) && (!isset($_SESSION["adminid"])) )
{
  header("Location:./login.php");
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

    <title>Add New Client - Cliental List</title>

    <meta name="description" content="" />

    <?php require_once './Includes/headerFiles.php'; ?>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <?php require_once './Includes/navbar.php'; ?>

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
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                 
                </div>
              </div>
              <!-- /Search -->

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

                <!-- Form controls -->
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <div class="card mb-4">
                    <h5 class="card-header bg-primary text-white">Add New Client</h5>
                    <div class="card-body">
                    <form method="POST">
                        <br/>

                      <?php 
                      if(isset($message) && (strlen($message)>0))
                      {
                        echo $message;
                      }
                      ?>

                      <div class="form-floating">
                        <input type="text" class="form-control" name="code" id="floatingInput" value="<?= $clientCode ?>"  readonly>
                        <label for="floatingInput">Client Code</label>
                      </div>
                      <br/>

                      <div class="form-floating">
                        <input type="text" class="form-control" name="name" id="floatingInput" placeholder="e.g Martin Luther"  required>
                        <label for="floatingInput">Client Name</label>
                      </div>

                      <br/>

                      <div class="form-floating">
                        <input type="text" class="form-control" name="phone" maxlegnth="17" id="floatingInput1" placeholder="e.g +923348035145" required>
                        <label for="floatingInput1">Client Contact No</label>
                      </div>

                      <br/>

                      <div class="form-floating">
                        <input type="number" class="form-control" step="any" name="total" id="floatingInput2" placeholder="e.g 100" required>
                        <label for="floatingInput2">Total Amount to Transfer</label>
                      </div>

                      <br/>

                      <div class="form-floating">
                        <input type="number" class="form-control" step="any" name="amount_given" id="floatingInput3" placeholder="e.g 80" required>
                        <label for="floatingInput3">Amount Given by Client</label>
                      </div>

                      <div class="row mt-3">
                        <div class="d-grid gap-2 col-lg-6 mx-auto">
                          <button type="submit" name="addClient" class="btn btn-primary btn-lg" type="button">Store Client Details</button>
                        </div>
                      </div>

                    </form>


                    </div>
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
    <?php require_once './Includes/footerFiles.php'; ?>


  </body>
</html>
