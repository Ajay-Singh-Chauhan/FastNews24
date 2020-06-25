<?php include 'header.php';
 ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <h2 class="page-heading">
                    <?php   $limit=3;
                      include "config.php";
                      if (isset($_GET['cat_id'])) {
                        $cat_id=$_GET['cat_id'];
                      }

                      if(isset($_GET['page'])){
                        $page_num=$_GET['page'];
                      }
                      else{
                        $page_num=1;
                      }
                      $offset=($page_num-1)*$limit;

                      $sql2="select * from post
                      left join category on post.category = category.category_id
                      left join user on post.author = user.user_id
                      where post.category={$cat_id}
                      order by post.post_id desc limit {$offset},{$limit}";

                    $res1=mysqli_query($con,$sql2) or die("query failed".mysqli_connect_error());
                    $r1=mysqli_fetch_assoc($res1); echo strtoupper($r1['category_name']);?> CATEGORY </h2>
                  <?php
                  $res=mysqli_query($con,$sql2) or die("query failed".mysqli_connect_error());
                  if($res){
                    while ($row=mysqli_fetch_assoc($res)) {
                  ?>

             <div class="post-content">
                 <div class="row">
                     <div class="col-md-4">
                         <a class="post-img" href="single.php?post_id=<?php echo $row['post_id'] ?>"><img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/></a>
                     </div>
                     <div class="col-md-8">
                         <div class="inner-content clearfix">
                             <h3><a href='single.php?post_id=<?php echo $row['post_id'] ?>'><?php echo $row['title']; ?></a></h3>
                             <div class="post-information">
                                 <span>
                                     <i class="fa fa-tags" aria-hidden="true"></i>
                                     <a href='category.php?cat_id=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                                 </span>
                                 <span>
                                     <i class=" fa fa-user" aria-hidden="true"></i>
                                     <a href='author.php?a_id=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
                                 </span>
                                 <span>
                                     <i class="fa fa-calendar" aria-hidden="true"></i>
                                   <?php echo $row['post_date']; ?>
                                 </span>
                             </div>
                             <p class="description">
                                 <?php echo substr($row['description'],0,130)."..."; ?>
                             </p>
                             <a class='read-more pull-right' href='single.php?post_id=<?php echo $row['post_id'] ?>'>read more</a>
                         </div>
                     </div>
                 </div>
             </div>
                    <?php }
                              }

                            $sql1="select post_id from post where category={$cat_id}";

                            $result=mysqli_query($con,$sql1) or die("query failed ..".mysqli_connect_error());
                            $total_data=mysqli_num_rows($result);
                            $total_page= ceil($total_data/$limit);

                          echo "<ul class='pagination'>";

                            if($page_num>1){
                              $v=$page_num-1;
                              echo "<li><a href='category.php?page=$v&cat_id=$cat_id'>Previous</a></li>";
                            }
                          for($i=1;$i<=$total_page;$i++){
                            if($page_num==$i){
                              $active="active";
                            }else {
                              $active="";
                            }
                              echo "<li class=$active><a href='category.php?page=$i&cat_id=$cat_id'>$i</a></li>";
                          }
                          if ($page_num<$total_page) {
                              $v=$page_num+1;
                            echo "<li><a href='category.php?page=$v&cat_id=$cat_id'>Next</a></li>";
                          }
                          echo "</ul>";
                       ?>
                </div>
              <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
