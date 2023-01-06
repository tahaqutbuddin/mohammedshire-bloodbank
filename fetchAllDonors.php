<?php
require_once './Controllers/donorController.php';

$limit = 10;
$page = 1;
if($_POST['page'] > 1)
{
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}

if($_POST['query'] != '')
{
  $search = htmlentities($_POST["query"]);
}else { $search = NULL; }


$statement = getAllDonors( $search, 0 , 0);
if($statement == NULL) 
    $total_data = 0;
else
    $total_data = $statement->rowCount();


$statement1 = getAllDonors($search , $start  , $limit );
if($statement1 == NULL) 
    $total_filter_data = 0;
else{
    $total_filter_data = $statement1->rowCount();
    $result = $statement1->fetchAll();
}

$output='';

if($total_data > 0)
{
  foreach($result as $row)
  {
    $output .= '
    <div class="col-md-3 m-1 p-2 border border-secondary rounded">
      <div class="member align-start d-flex p-1 m-1">
        <div class="m-1" >
          <img src="'.$row["picture"].'" style="max-width:100%" alt="">
        </div>

        <div class="info">
          <h4>'.ucfirst($row["firstName"] .' '.$row["lastName"]).'</h4>
          <span>tel:'.$row["phone"].'</span>
          <h3>'.$row["bloodtype"].'</h3>
          <h3>'.$row["district"].'</h3>
        </div>
      </div>
    </div>
    ';
  }

}
else
{
  $output .= '
  <div class="col-md-12 m-1">
      <div class="alert alert-danger" role="alert">No Data Available</div>
    </div>
  ';
}


$output .= '
<div align="center">
  <ul  class="pagination">
';
  

if($total_data > 0)
{

  $total_links = ceil($total_data/$limit);
  $previous_link = '';
  $next_link = '';
  $page_link = '';


  if($total_links > 4)
  {
    if($page < 5)
    {
      for($count = 1; $count <= 5; $count++)
      {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
    else
    {
      $end_limit = $total_links - 5;
      if($page > $end_limit)
      {
        $page_array[] = 1;
        $page_array[] = '...';
        for($count = $end_limit; $count <= $total_links; $count++)
        {
          $page_array[] = $count;
        }
      }
      else
      {
        $page_array[] = 1;
        $page_array[] = '...';
        for($count = $page - 1; $count <= $page + 1; $count++)
        {
          $page_array[] = $count;
        }
        $page_array[] = '...';
        $page_array[] = $total_links;
      }
    }
  }
  else
  {
    for($count = 1; $count <= $total_links; $count++)
    {
      $page_array[] = $count;
    }
  }

  for($count = 0; $count < count($page_array); $count++)
  {
    if($page == $page_array[$count])
    {
      $page_link .= '
      <li class="page-item active">
        <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
      </li>
      ';

      $previous_id = $page_array[$count] - 1;
      if($previous_id > 0)
      {
        $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
      }
      else
      {
        $previous_link = '
        <li class="page-item disabled">
          <a class="page-link" href="#">Previous</a>
        </li>
        ';
      }
      $next_id = $page_array[$count] + 1;
      if($next_id > $total_links)
      {
        $next_link = '
        <li class="page-item disabled">
          <a class="page-link" href="#">Next</a>
        </li>
          ';
      }
      else
      {
        $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
      }
    }
    else
    {
      if($page_array[$count] == '...')
      {
        $page_link .= '
        <li class="page-item disabled">
            <a class="page-link" href="#">...</a>
        </li>
        ';
      }
      else
      {
        $page_link .= '
        <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
        ';
      }
    }
  }

  $output .= $previous_link . $page_link . $next_link;
  $output .= '
    </ul>
  </div>
  ';
}

echo $output;

?>
