<?php
require 'session.php';
require 'connect.php';
if(login()){
  if($_SESSION['username'] != "admin"){
    header('location:home.php');
  }
}
else{
  header('location:index.php');
}

if(isset($_GET['delete'])){
  if($_GET['delete']=="true"){
    $array = array();
    $id = $_GET['id'];
    $sql = "DELETE  FROM `userdetails` WHERE `Id` = '$id'";
    mysqli_query($db,$sql);
    $sql1 = "SELECT `blog_id` FROM `blogs` WHERE `blogger_id` = '$id'";
    $result1 = mysqli_query($db,$sql1);
    while($row1 = mysqli_fetch_assoc($result1)){
      $array[] = $row1['blog_id'];
    }
    $ids = join("','",$array);   

    $sql2 = "DELETE FROM `blog_detail` WHERE `blog_id` IN ('$ids')";
    mysqli_query($db, $sql2);

    $sql3 = "DELETE FROM `userdetails` WHERE `blogger_id` = 'id'";
    mysqli_query($db, $sql3);

  }
}


elseif(isset($_GET['act'])){
  if($_GET['act'] == "true"){
        $id = $_GET['id'];

    $sql = "UPDATE `userdetails` SET `status`='Y' WHERE `Id` = '$id' ";
    mysqli_query($db,$sql);
  }
}

elseif(isset($_GET['deact'])){
  if($_GET['deact'] == "true"){
        $id = $_GET['id'];

    $sql = "UPDATE `userdetails` SET `status`='N' WHERE `Id` = '$id' ";
    mysqli_query($db,$sql);
  }
}


$sql = "SELECT `Id`, `userName` , `status` FROM `userdetails`";
$result = mysqli_query($db,$sql);
$num_rows = mysqli_num_rows($result);
?>


<html>
<head>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/style.css">
       <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
       <nav>

    <div class="nav-wrapper">
      <a href="index.php" class="brand-logo">Blogger</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <?php if(login()){
          echo "<li>Hi ".$_SESSION['username']."</li>";
        }?>

        <li><a href="signout.php">Sign Out</a></li>
      </ul>
    </div>
  </nav>

</head>
<body>
  <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
     <script type="text/javascript" src="js/materialize.min.js"></script>
     <script>
      $('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrain_width: false, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: false, // Displays dropdown below the button
      alignment: 'left' // Displays dropdown with edge aligned to the left of button
    }
  );
       
     </script>


<center>
<div style="width : 60%; margin : 2%; padding : 5%;">
 <table class="striped centered">
        <thead>
          <tr>
              <th data-field="id" style="width:15%;">BloggerId</th>
              <th data-field="name" style="width:45%;">Username</th>
              <th data-field="status" style="width:25%;">Status</th>
          </tr>
        </thead>

        <tbody>
            <?php
              for($i=0;$i<$num_rows;$i++){
              $row = mysqli_fetch_assoc($result);
              $blogger_id = $row['Id'];
              if($row['userName'] == "admin"){
                continue;
              }
              echo '<tr>
            <td>'.$blogger_id.'</td>
            <td>'.$row['userName'].'</td>';
            if($row['status'] == "N"){
              echo '<td>'."Inactive".'</td>';}
            else{
              echo '<td>'."Active".'</td>';
            }
echo '<td>';
//echo $row['Id'];
echo "<a class='dropdown-button btn' data-activates='dropdown1'>Action</a>".$blogger_id."

  <ul id='dropdown1' class='dropdown-content'>";
   if($row['status'] == "N"){
    echo "<li><a href='?act=true&id=".$blogger_id."'>Activate</a></li>";
    echo "<li>".$blogger_id."</li>";}
    else{
    echo "<li><a href='?deact=true&id=".$blogger_id."'>Deactivate</a></li>";
        echo "<li>".$blogger_id."</li>";}

 echo "<li><a href='?delete=true&id=".$blogger_id."'>Delete</a></li>
    
  </ul>";
  echo '</td>';
          echo '</tr>';
        }?>

        </tbody>
      </table>
</div>
</center>

</body>
</html>