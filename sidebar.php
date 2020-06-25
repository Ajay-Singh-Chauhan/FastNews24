<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        include "config.php";

        $sql="select * from post p
        left join category c on p.category=c.category_id
        left join user u on p.author = u.user_id
        order by p.post_id desc
        limit 4";

        $res=mysqli_query($con,$sql) or die("query failed".mysqli_connect_error());
        $row=mysqli_fetch_assoc($res);

        if($res){
          while ($row=mysqli_fetch_assoc($res)) {
         ?>

        <div class="recent-post">
            <a class="post-img" href="single.php?post_id=<?php echo $row['post_id']; ?>">
                <img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?post_id=<?php echo $row['post_id']; ?>"><?php echo $row['title']; ?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cat_id=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                  <?php echo $row['post_date']; ?>
                </span>
                <a class="read-more" href="single.php?post_id=<?php echo $row['post_id'] ?>">read more</a>
            </div>
        </div>
        <?php }}  ?>
    </div>
    <!-- /recent posts box -->
</div>
