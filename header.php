<!DOCTYPE html>
<?php
include "config.php";
$page_name=basename($_SERVER['PHP_SELF']);

switch ($page_name) {
  case 'author.php':
    if(isset($_GET['a_id'])){
      $sql_title = " select * from post p
      left join user u on p.author = u.user_id
      where p.author = {$_GET['a_id']}";

      $res=mysqli_query($con,$sql_title) or die("title query failed".mysqli_connect_error());
      $row=mysqli_fetch_assoc($res);
      $page_title="Post by ".$row['first_name']." ".$row['last_name'];
      }
      else {
      $page_title="Author is not found ";
      }
      break;

      case 'category.php':
      if(isset($_GET['cat_id'])){
        $sql_title="select * from post
        left join category on post.category = category.category_id
        where post.category={$_GET['cat_id']}";

      $res=mysqli_query($con,$sql_title) or die("title query failed".mysqli_connect_error());
      $row=mysqli_fetch_assoc($res);
      $page_title= strtoupper($row['category_name']);

      }
        else {
          $page_title="Category not found";
             }
        break;

      case 'search.php':
      if(isset($_GET['search'])){
        $search=mysqli_real_escape_string($con,$_GET['search']);
        $page_title= strtoupper($search);
      }
        else {
        $page_title="Search not found";
        }
        break;

      case 'single.php':
      if(isset($_GET['post_id'])) {
        $p_id=$_GET['post_id'];

        $sql_title="select * from post
        where post.post_id = $p_id";

        $res=mysqli_query($con,$sql_title) or die("query failed".mysqli_connect_error());
        $row=mysqli_fetch_assoc($res);
        $page_title= strtoupper($row['title']);

      }
        else {
         $page_title="News title is not found";
        }
        break;



  default:
  $page_title="News-Site";
    break;
}


 ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container --><?php
    include "config.php";
    $sql="select logo from settings";
    $res=mysqli_query($con,$sql);
    if($res){

      while($row=mysqli_fetch_assoc($res)){
         ?>
  <div class="row">
      <!-- LOGO -->
      <div class="col-md-2">
          <a href="post.php"><img class="logo" src="admin/images/<?php echo $row['logo']; ?>"></a>
      </div>
      <!-- /LOGO -->
  </div>
<?php }} ?>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <?php

              if(isset($_GET['cat_id'])){
                $cat_id=$_GET['cat_id'];
              }else {
                  $cat_id=0;
              }

              include "config.php";
              $sql="select category_id,category_name from category where post>0 ";
              $result=mysqli_query($con,$sql);
              if($result){

             ?>
                <ul class='menu'>
                  <li><a  href="<?php echo $hostname; ?>" >Home</a></li>
                  <?php
                  while ($row=mysqli_fetch_assoc($result)) {
                    if ($cat_id==$row['category_id']) {
                    $active="active";
                    }
                    else {
                      $active="";
                    }

                    echo "<li><a class='{$active}' href='category.php?cat_id={$row['category_id']} '>{$row['category_name']}</a></li>";
                    } ?>
                </ul>
              <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
