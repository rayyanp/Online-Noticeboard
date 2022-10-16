<?php
include 'header.php';
// Ascending Order
if(isset($_POST['ASC']))
{
    $asc_query = "SELECT * FROM posts ORDER BY created ASC";
    $result = executeQuery($asc_query);
}

// Descending Order
elseif (isset ($_POST['DESC'])) 
    {
          $desc_query = "SELECT * FROM posts ORDER BY created DESC";
          $result = executeQuery($desc_query);
    }
    
    // Default Order
 else {
        $default_query = "SELECT * FROM posts";
        $result = executeQuery($default_query);
}

?>
<section id="container">
  <div class="col-md-8 m-auto block">
  <h3>Notices for you</h3><br>
      <form action="view_posts.php" method="post">
        <input type="submit" class = "btn btn-info" name="ASC" value="Ascending">
        <input type="submit" class = "btn btn-info" name="DESC" value="Descending"><br><br>
    <table class="table-main">
      <tr>
        <th>Title</th>
        <th>Content</th>
        <th>Images</th>
        <th>Created</th>
      </tr>
      <?php
function executeQuery($query)
{
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"noticeboard");
    $result = mysqli_query($connection, $query);
    return $result;
}
        while($row = mysqli_fetch_assoc($result)){
      ?>
      <tr>
        <td><?php echo $row['title'];?></td>
        <td><?php echo $row['content'];?></td>
        <td><img src="<?php echo $row['image'];?>" class="img" width="100px" height="100px"></td>
        <td>Created:<?php echo $row['created'];?><br>By: Anonymous</td>
      </tr>
      <?php
          }
      ?>
    </table>
    </form>
  </div>
</div>
</section>
<?php
include 'footer.php';
?>