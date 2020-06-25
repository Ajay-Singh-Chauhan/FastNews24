<?php include 'header.php';
include 'config.php';
?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                      <?php
                        if (isset($_GET['post_id'])) {
                          $p_id=$_GET['post_id'];
                          $sql="select * from post
                          left join category on post.category = category.category_id
                          left join user on post.author = user.user_id
                          where post.post_id = $p_id";

                          $res=mysqli_query($con,$sql) or die("query failed".mysqli_connect_error());
                        if($res){
                          while ($row=mysqli_fetch_assoc($res)) {

                       ?>
                        <div class="post-content single-post">
                            <h3><?php echo $row['title']; ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?cat_id=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>

                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?a_id=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date']; ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/>
                            <p class="description">
                                <?php echo $row['description']; ?>
                            </p>
                        </div>
                      <?php
                    }}}
                        ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
