<div id ="footer">
    <div class="container">
      <div class="row">
        <?php
        include "config.php";
        $sql="select footerdesc from settings";
        $res=mysqli_query($con,$sql);
        if($res){

          while($row=mysqli_fetch_assoc($res)){

        ?>
          <div class="col-md-12">
              <span><?php echo $row['footerdesc']; ?></a></span>
          </div>
        <?php }
         }
          else{
          echo "query failed";
        } ?>
      </div>
    </div>
</div>
</body>
</html>
