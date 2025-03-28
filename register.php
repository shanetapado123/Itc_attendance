<?php session_start();       // Start the session ?> 
<?php include "header.php" ?>
<?php
if (isset($_POST['signup'])) {
  $employeeid = $_POST['employeeid'];
  $name = $_POST['name'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];
  $department = $_POST['department'];
  $gender = $_POST['gender'];
  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];
  $folder = "./images/" . $filename;
  $basicpay = $_POST['basic'];
  $query = "INSERT INTO employeeid(emId,itc_name,itc_address,itc_contact,itc_department,itc_gender,basic) VALUES('{$employeeid}','{$name}','{$address}','{$contact}','{$department}','{$gender}','{$basicpay}')";
  $addUser = mysqli_query($conn, $query);
  if (!$addUser) {
    echo "This EmployeeID is already taken!" . mysqli_error($conn);
  } else {
        if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>&nbsp; Image uploaded successfully!</h3>";
        } else {
        echo "<h3>&nbsp; Failed to upload image!</h3>";
        }
        header('location: admindashboard.php');
  }
}
?>

<?php
if (isset($_POST['cancel'])) {
  //session_destroy();            //  destroys session 
  header('location: admindashboard.php');
}
?>

    </div>

<h1 class="text-center mt-3">ITC Employee Registration</h1>
<hr>
<div class="container col-4 border rounded bg-light mt-5" style='--bs-bg-opacity: .5;'>
  <h2 class="text-center">Sign Up</h2>
  <small class="text-muted">Pleasse fill in this form to create an employee account!</small>
  <hr>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="employeeid" class="form-label">Employee ID</label>
      <input type="employeeid" class="form-control" name="employeeid" placeholder="Enter your Employee ID" autocomplete="on">
      <small class="text-muted">Year  + Department Code + #Employee + Date Hire(MMDD)</small>
      <br><small class="text-muted">Eg. 2401011023</p>
    </div>

    <div class="mb-3">
      <label for="name" class="form-label">Employee Name</label>
      <input type="name" class="form-control" name="name" placeholder="Enter your Employee Name" autocomplete="off">
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <input type="address" class="form-control" name="address" placeholder="Enter your address" autocomplete="off">
    </div>

    <div class="mb-3">
      <label for="contact" class="form-label">Contact</label>
      <input type="contact" class="form-control" name="contact" placeholder="Enter your contact #" autocomplete="off">
    </div>

      <div class="mb-3">
      <label for="department" class="form-label">Department</label>
      <label for="department">Choose an Department:</label>
      <select name="department" id="options">
            <option value="Robinson">Robinson</option>
            <option value="Mr. DIY">Mr. DIY</option>
            <option value="Penshoppe">Penshoppe</option>
            <option value="RRJ">RRJ</option>
        </select>
    </div>

      <div class="mb-3">
      <label for="gender">Choose an Gender:</label>
      <select name="gender" id="options">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>

     <div class="mb-3">
      <label for="basic" class="form-label">Basic Payment</label>
      <input type="basic" class="form-control" name="basic" placeholder="Enter your Basic Payment" autocomplete="off">
    </div>   
     <div class="mb-3">
      <label for="startdate" class="form-label">Start Date</label>
      <input type="date" class="form-control" name="startdate" placeholder="Enter Joining Date" autocomplete="off">
    </div>
    <div class="mb-3">
      <input type="submit" name="signup" value="Sign Up" class="btn btn-primary">
      <input type="submit" name="cancel" value="Cancel" class="btn btn-danger">
    </div>
  </form>
</div>


