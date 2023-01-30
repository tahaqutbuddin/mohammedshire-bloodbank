<?php
require_once './Controllers/loginController.php';
require_once './Includes/functions.php';

$allDistricts = getAllDistrictsData(["id","name"]);
$districts = "";
$districts .= "<option value='' selected>Select District</option>";
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

 <?php require './Includes/navbar.php';  ?>


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
                          <select class="form-control py-3" id="districts">
                          <?= $districts; ?>
                        </select>
                        </div>
                      </div>

                          <!-- blood select -->
                      <div class="col-md-3 m-1">
                        <div class="form-group">
                          <select class="form-control py-3" id="bloodtype">
                            <option selected value="">Select Blood Type</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB-">AB-</option>
                            <option value="AB+">AB+</option>
                          </select>
                        </div>
                      </div>

                      <!-- button -->
                     <div class="col-md-4 m-1">
                      <button class="btn btn-success w-100" id="searchButton" type="button" class="btn text-white">Search Donor
                      </button>
                      <button class="btn btn-success mt-1 w-100" id="resetAll" type="button" class="btn text-white">Reset All</button>
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

    function load_data(page, arr = {'empty':'1'})
    {
      $.ajax({
        url:"fetchAllDonors.php",
        method:"POST",
        data:{page:page,query:arr},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click',"#searchButton",function(){
      var type = $("#bloodtype").val();
      var dist = $("#districts").val();
      var query = {bloodtype:type,district:dist};
      load_data(1,query);
    });

    $(document).on('click',"#resetAll",function(){
      load_data(1);
    });

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var type = $("#bloodtype").val();
      var dist = $("#districts").val();
      var query = {bloodtype:type,district:dist};
      load_data(page, query);
    });

    // $(document).on('click','.launch-modal',function(){
    //  var val = $(this).siblings("input").val();
    //  $("#user-id").val(val);
    // });

  });
</script>

</html>