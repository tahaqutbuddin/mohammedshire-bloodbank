<?php 

if(!isset($_GET["record"] , $_GET["code"]))
{
    header("Location:".$_SERVER["HTTP_REFERER"]);
}else 
{
    if( strlen($_GET["code"]) != 128 )
    {
        header("Location:".$_SERVER["HTTP_REFERER"]);
    }
}
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

    <title>Edit Client Details - Cliental List</title>

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
                    <h5 class="card-header bg-primary text-white">Edit Client</h5>
                    <div class="card-body">
                    <br/>
                    <a href="defaulters.php" class="btn btn-md btn-outline-warning">Go Back</a>
                    <form method="POST">
                        <br/>

                      <?php 
                      if(isset($message) && (strlen($message)>0))
                      {
                        echo $message;
                      }
                      ?>

                      <div class="form-floating">
                        <input type="text" class="form-control" name="code" id="floatingInput" value="<?= $clientCode ?>" aria-describedby="floatingInputHelp" readonly>
                        <label for="floatingInput">Client Code</label>
                      </div>
                      <br/>

                      <div class="form-floating">
                        <input type="text" class="form-control" name="name" id="floatingInput" value="<?= $clientName ?>" aria-describedby="floatingInputHelp">
                        <label for="floatingInput">Client Name</label>
                      </div>

                      <br/>

                      <div class="form-floating">
                        <input type="number" class="form-control" name="total" id="floatingInput1" step="any" value="<?= $total ?>" aria-describedby="floatingInputHelp1">
                        <label for="floatingInput1">Total Amount to Transfer</label>
                      </div>

                      <br/>

                      <div class="form-floating">
                        <input type="number" class="form-control" name="amount_given" id="floatingInput2" step="any" value="<?= $amount ?>" aria-describedby="floatingInputHelp2">
                        <label for="floatingInput2">Amount Given by Client</label>
                      </div>

                      <div class="row mt-3">
                        <div class="d-grid gap-2 col-lg-6 mx-auto">
                          <button type="submit" name="saveClient" class="btn btn-primary btn-lg" >Save Details</button>
                          <button class="btn btn-outline-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete Client?</button>
                        
                        </div>
                      </div>

                    </form>


                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- / Content -->

            <div class="modal fade" id="deleteModal" tabindex="-1" style="display: none;" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <form method="POST">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalCenterTitle">Delete Client?</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col mb-3">
                          Are you sure you want to delete this Client details? 
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                      </button>
                      <button type="submit" name="deleteClient" class="btn btn-success">Yes, Confirm</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>


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


  