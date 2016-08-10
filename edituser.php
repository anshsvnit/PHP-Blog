<?php
require 'session.php';
require 'connect.php';
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
?>
      </ul>
    </div>
  </nav>

</head>
<body>

 <table>
        <thead>
          <tr>
              <th data-field="id">BloggerId</th>
              <th data-field="name">Username</th>
              <th data-field="status">Status</th>
              <th data-field="action">Action</th>
          </tr>
        </thead>

        <tbody>
            <?php
              for($i=0;$i<$num_rows;$i++){
              $row = mysqli_fetch_assoc($result);
              echo '<tr>
            <td>'.$row['Id'].'</td>
            <td>'.$row['userName'].'</td>
            <td>'.$row['status'].'</td>
          </tr>';
        }?>
        </tbody>
      </table>



</body>
</html>