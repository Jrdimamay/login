<?php

include("Connections.php");

if(isset($_POST['submit'])){
    $search = $_POST['Search'];

    $sql = "SELECT * FROM dimamaytb WHERE Username = ?";
    $stmt = $connections->prepare($sql);
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM dimamaytb";
    $result = $connections->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css">
    <title>Admin</title>
</head>
<body>
 <nav class="navbar navbar-dark bg-dark">
    <span class="navbar-brand mb-0 h1">Admin</span>
    <form class="form-inline">
        <li class="nav-item dropdown mt-0 mr-4">
              <img src="img/image.png"class="rounded-circle " width="30" height="30"id="Menu"  aria-labelledby="navbarDropdownMenuLink" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="dropdown-menu dropdown-nu bg-dark mr-5 " aria-labelledby="navbarDropdownMenuLink">
          <form action="logout.php" method="POST"> 
             <!--<button type="submit" name="logout_btn" class="btn btn-dark">Logout</button> -->
             <a class="btn btn-dark mr-5" href="Signin.php" role="button">Logout</a>
          </form>
            </div>
        </li>
      </form>
  </nav>
  <nav>
    <form class="form-container" method="post">
        <input class="form-control" type="text" name="Search" placeholder="Search data" aria-label="Search">
        <button class="btn btn-dark" type="submit" name="submit">Search</button>
    </form>
  </nav>
  <?php
  include('connections.php');
  ?>

 <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="exampleModalLabel">Add Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="insert.php" method="POST">
          <div class="modal-body text-dark">
            <div class="form-group">
              <label> Username </label>
              <input type="text" name="Username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                    <label for="Firsname">Firstname</label>
                    <input type="text" name="Firstname" class="form-control" placeholder="Enter Firstname">
              </div>
              <div class="form-group col-md-6">
                  <label for="Lastname">Lastname</label>
                    <input type="text" name="Lastname" class="form-control" placeholder="Enter Lastname">
                  </div>
              </div> 
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="Email" class="form-control checking_Email" placeholder="Enter Email">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="Password" name="Password" class="form-control" placeholder="Enter Password">
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="Confirmpassword" class="form-control" placeholder="Confirm Password">
              </div>
        <div class="user-name">
        <label class="type-form" for="account_type">Account Types:</Label>
        <select class="account-type-btn" name="Account_type" id="Account_type">
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form> 
      </div>
    </div>
  </div>
 <div class="ad">
    <button type="button" class="btn-add" data-toggle="modal" data-target="#addadminprofile"> + Add Admin Profile</button>
</div>
    
      <div class="container my-5">
    <table class="table table-hover text-white table-transparent border-sm">
          <thead>
          <tr> 
            <th scope="col">Username</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Email</th>
            <th scope="col">Account_type</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
         <?php   
            if(isset($result) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) 
              {   
                echo "<tr>";
                echo "<td>" . $row['Username'] . "</td>";
                echo "<td> " . $row['Firstname'] . "</td>";
                echo "<td>" . $row['Lastname'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                 echo "<td><a class='btn btn-dark'>" . $row['Account_type'] . "</a></td>";
                echo "<td><a class='btn btn-primary'href='update.php?Email=" . $row['Email'] ."'>Update</a></td> ";
                echo "<td><a class='btn btn-danger'href='delete.php?Email=" . $row['Email'] ."'>Delete</a></td> ";
                echo "</tr>";
              }
            } else {
              echo "<p>No results found.</p>";
            }
          ?>
        </tbody>
    </table>
</div>

    </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
