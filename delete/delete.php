<?php 
require('../inc/db.php');
?>
<?php 
   if(isset($_POST['id'])){
    $id = $_POST['id'];
   }
   $sql="DELETE FROM user_detail WHERE id = '$id'";

   $query = mysqli_query($conn,$sql);


?>