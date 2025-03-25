<?php session_start();       // Start the session ?>  
<?php include "header.php" ?>
<?php
if (isset($_POST['clockin'])) {

  date_default_timezone_set('Asia/Manila');
  $timestamp = time();
  $am_pm = date('a', $timestamp);
  $status='Clock In';
  $clock=date('h:i:s');
  $cstatus=$am_pm;
  $date=date("Y-m-d");
  $department = $_SESSION['department']; 
  $employeeid = $_SESSION['empId'];
  $name = $_SESSION['name']; 
  $query = "INSERT INTO clockinout(emId,itc_name,itc_status,itc_clock,itc_ampm,itc_department,itc_date) VALUES('{$employeeid}','{$name}','{$status}','{$clock}','{$cstatus}','{$department}','{$date}')";
  $addUser = mysqli_query($conn, $query);

  if (!$addUser) {
    echo "This EmployeeID is already taken!" . mysqli_error($conn);
  } else {
    echo "Not Connected";
    header('location: index.php');
  }
}
?>
<?php
if (isset($_POST['clockout'])) {

  date_default_timezone_set('Asia/Manila');
  $timestamp = time();
  $am_pm = date('a', $timestamp);
  $status='Clock Out';
  $clock=date('h:i:s');
  $cstatus=$am_pm;
  $date=date("Y-m-d");
  $department = $_SESSION['department']; 
  $employeeid = $_SESSION['empId'];
  $name = $_SESSION['name']; 
  $query = "INSERT INTO clockinout(emId,itc_name,itc_status,itc_clock,itc_ampm,itc_department,itc_date) VALUES('{$employeeid}','{$name}','{$status}','{$clock}','{$cstatus}','{$department}','{$date}')";
  $addUser = mysqli_query($conn, $query);

  if (!$addUser) {
    echo "This EmployeeID is already taken!" . mysqli_error($conn);
  } else {
    echo "Not Connected";
    header('location: index.php');
  }
}
?>

<?php
if (!isset($_SESSION['empId'])) {         // condition Check: if session is not set. 
  header('location: login.php');   // if not set the user is sendback to login page.
}
?>

<?php
if (isset($_POST['signout'])) {
  session_destroy();            //  destroys session 
  header('location: index.php');
}
?>



<div class="container col-12 border rounded mt-3">
  <h1 class=" mt-3 text-center">Welcome, This is your dashboard!! </h1>
  <hr>
  <h2> <?php echo $_SESSION['name']; ?> </h2>
  <p><img src="images/user logo.jpeg" alt="register image" width="15%" height="15%" style="float: right;"></p>
  <h3> <script type="text/javascript">
        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
            document.getElementById('clock').innerHTML = strTime;
        }
        setInterval(updateClock, 1000);
        </script>
      </head>
      <body onload="updateClock()">
      <div name="clock" id="clock"></div></h3>

  <table class="table table-striped table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th scope="col">EmployeeID</th>
        <th scope="col">Name</th>
        <th scope="col">Address</th>
        <th scope="col">Contact</th>
        <th scope="col">Department</th>
        <th scope="col">Gender</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td> <?php echo $_SESSION['empId']; ?></td>
        <td> <?php echo $_SESSION['name']; ?></td>
        <td> <?php echo $_SESSION['address']; ?></td>
        <td> <?php echo $_SESSION['contact']; ?></td>
        <td> <?php echo $_SESSION['department']; ?></td>
        <td> <?php echo $_SESSION['gender']; ?></td>
      </tr>
    </tbody>
  </table>




  <form action="" method="POST">
   <button type="submit" name='signout' class=" btn btn-warning mb-3"> Sign Out</button>
    <button type="submit" name='clockin' class=" btn btn-success mb-3" style="float: right;"> Clock In</button>
    <button type="submit" name='clockout' class=" btn btn-danger mb-3" style="float: right;"> Clock Out</button>
  </form>


  </div>

<?php include "footer.php" ?>

