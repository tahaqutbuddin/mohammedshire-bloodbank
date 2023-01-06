<?php
require_once './Includes/functions.php';

$allDistricts = getAllDistrictsData(["id","name"]);
$districts = "";
$districts .= "<option value=''>Select District</option>";
foreach ($allDistricts as $dist)
{
  $districts .= "<option value='".$dist["id"]."'>".ucfirst($dist["name"])."</option>";
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation</title>
</head>
<body>

  <nav class="navbar navbar-expand-md navbar-light bg-danger pt-3 pb-3">
    <div class="container">
      <!-- navbar brand / title -->
      <a class="navbar-brand" href="index.html">
        <span class="text-white fw-bold">
          <i class="bi bi-book-half"></i>
          Soobe Blood-Hub
        </span>
      </a>
      <!-- toggle button for mobile nav -->
      <button class="navbar-toggler rounded border border-success" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="bi bi-list-nested display-4"></i></span>
      </button>

      <!-- navbar links -->
      <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
        <ul class="navbar-nav ">
          <li class="nav-item ">
            <a class="nav-link text-white " href="index.html">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="search-donors.html">DONORS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">CONTACT US</a>
          </li>
          <li class="nav-item m-1">
            <a class="btn btn-danger border w-100" href="registration.html"> SIGN UP
              <i class="bi bi-person-plus"></i>
              </a>
          </li>
          <li class="nav-item  d-md-inline m-1">
            <!-- <a class="btn btn-secondary" href="#pricing">buy nowss</a> -->
            <a class="btn btn-success btn-rounded w-100" data-bs-toggle="modal" data-bs-target="#modalLoginForm">
                Log In   <i class="bi bi-box-arrow-in-right"></i></a>
          </li>
          <!-- modal login form -->
        <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <i class="fas fa-envelope prefix grey-text"></i>
                            <input type="email" id="defaultForm-email" class="form-control validate">
                            <label data-error="wrong" data-success="right" for="defaultForm-email">Your email</label>
                        </div>
        
                        <div class="md-form mb-4">
                            <i class="fas fa-lock prefix grey-text"></i>
                            <input type="password" id="defaultForm-pass" class="form-control validate">
                            <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
                        </div>
        
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-success w-100 d-block">
                            <a class="nav-link text-white" href="#contact">Log In</a> </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end  modal form -->
          
        </ul>
      </div>
    </div>
  </nav>
<!-- end nav bar  -->


    <!-- form start here -->
    <section class="vh-100 gradient-custom">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-warning text-center display-4"> Find Blood Donor </div>
          </div>
          <div class="row text-center">
            <div class="col-md-12">
              <div class="row">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <!-- district select -->
                      <div class="col-md-4 m-1">
                        <div class="form-group">
                          <select class="form-control py-3" id="">
                          <?= $districts; ?>
                        </select>
                        </div>
                      </div>

                          <!-- blood select -->
                      <div class="col-md-3 m-1">
                        <div class="form-group">
                          <select class="form-control py-3" id="">
                            <option selected>Select Blood Type</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB-">AB-</option>
                            <option value="AB-">AB-</option>
                          </select>
                        </div>
                      </div>

                      <!-- button -->
                     <div class="col-md-4 m-1">
                      <button class="btn btn-success w-100">
                        <a href="" class="btn text-white">Search Donor</a>
                      </button>
                     </div>


                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>

          <!-- members row -->
          <div class="team">
            <div class="row"  id="dynamic_content">
                  <!-- Data Fetched using AJAX -->
            </div>
          </div>



        </div>
    </section>



    
</body>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="./assets/js/popper.js"></script>
<script src="./assets/js/boostrap.js"></script>

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

    // $(document).on('click','.launch-modal',function(){
    //  var val = $(this).siblings("input").val();
    //  $("#user-id").val(val);
    // });

    // $('#search_box').keyup(function(){
    //   var query = $('#search_box').val();
    //   load_data(1, query);
    // });

  });
</script>

</html>