<?php 
require_once __DIR__.'/Controllers/donorController.php'; 
if( (!isset($_SESSION["adminid"])) )
{
  header("Location: login.php");
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

    <title>Donors List</title>

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
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search By code, name"
                    aria-label="Search..."
                    id="search_box"
                    name="search_box"
                  />
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

            <a href="addDonor.php" class="btn btn-outline-primary rounded-pill btn-lg"><strong>Add New Donor</strong></a>
            <br/>
            <br/>
                <!-- Basic Bootstrap Table -->
                  <div class="card">
                    <button type="button" class="btn btn-primary">
                      All Donors
                      <span class="badge bg-white text-primary rounded-pill"><?php if(isset($totalDonors)){echo $totalDonors;}else{echo '0';} ?></span>
                    </button>
                    <div class="table-responsive text-nowrap" id="dynamic_content">
                          <!-- Data Fetched using AJAX -->
                    </div>
                  </div>
                <!--/ Basic Bootstrap Table -->
            
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



    
    <div class="modal fade" id="deleteModal" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <form method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Delete Donor?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <input type="hidden" id="donor-id" name="donor_id">
                  Are you sure you want to delete this Donor details? 
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" name="deleteDonor" class="btn btn-success">Yes, Confirm</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- / Layout wrapper -->
    <?php require_once './Includes/footerFiles.php'; ?>

    <script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"fetchAllDonors.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      load_data(page, query);
    });

    $(document).on('click','.launch-modal',function(){
     var val = $(this).siblings("input").val();
     $("#donor-id").val(val);
    });

    $('#search_box').keyup(function(){
      var query = $('#search_box').val();
      load_data(1, query);
    });

  });
</script>
  </body>
</html>
