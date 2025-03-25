<?php session_start();       // Start the session ?> 
<?php include "header.php" ?>
<?php include 'database.php'; ?>
  <div class="container col-12 border rounded mt-3">
  <h1 class=" mt-3 text-center">Payroll Worked Hours </h1>
  <hr>
  <script type="text/javascript" src="saveAsExcel.js"></script>

  <form action="" method="POST">
   <button type="submit" name='dashboard' class=" btn btn-primary mb-3">Admin Dashboard</button>
   <button type="button" value="Import as Excel" name='generate' class=" btn btn-success mb-3" onclick="saveAsExcel('tableToExcel', 'Payroll Worked.xls')">Import as Excel</button>
    
   <button type="submit" name='logout' class=" btn btn-danger mb-3" style="float: right;"> Logout</button>
   <p>
   Start Date: <input type="date" class="form-control" name="start_date" placeholder="Search" autocomplete="off">
   End Date: <input type="date" class="form-control" name="end_date" placeholder="Search" autocomplete="off">
   <button type="submit" name='search' class=" btn btn-success mb-3"style="float: right;">Filter</button>
   <small class="text-muted">Filter Date Range</small>
  </form>

<?php
if (isset($_POST['dashboard'])) {
  //session_destroy();            //  destroys session 
  header('location: admindashboard.php');
}
?>

<?php
if (isset($_POST['logout'])) {
  //session_destroy();            //  destroys session 
  header('location: index.php');
}
?>

<?php


// SQL query to retrieve users data
$sql = "SELECT * FROM clockinout";

// Execute the query
$result = $conn->query($sql);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['search'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];


// SQL query to retrieve users data
        $sql = "SELECT * FROM clockinout WHERE itc_date BETWEEN '$start_date' AND '$end_date'";

// Execute the query
$result = $conn->query($sql);


// Close the connection
$conn->close();}
$totalWorkedHours=0.00;
?>

<?php if ($result->num_rows > 0): ?>

  <table id="tableToExcel" class="table table-striped table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th scope="col"rowspan="1">EmployeeID</th>
        <th scope="col"rowspan="1">Name</th>
        <th scope="col"rowspan="1">Date</th>
        <th scope="col"rowspan="1">Shift</th>
        <th scope="col"rowspan="1">Department</th>
        <th scope="col"colspan="1">AM</th>
        <th scope="col"colspan="1">PM</th>
        <th scope="col"colspan="1">Total</th>
        </tr>
      </tr>
    </thead>
        <?php while ($row = $result->fetch_assoc()): ?>

        <?php
        
        
        $timeIn = new DateTime($row['itc_amin']);
        $timeOut = new DateTime($row['itc_amout']);
        $timeIn2 = new DateTime($row['itc_pmin']);
        $timeOut2 = new DateTime($row['itc_pmout']);
        // Calculate the interval
        $interval = $timeIn->diff($timeOut);
        $interval2 = $timeIn2->diff($timeOut2);

        // Convert interval to decimal hours
        $hours = $interval->h;
        $minutes = $interval->i;
        $totalHours = $hours + ($minutes / 60);

        $hours2 = $interval2->h;
        $minutes2 = $interval2->i;
        $totalHours2 = $hours2 + ($minutes2 / 60);

        $total=$totalHours+$totalHours2;
        $totalWorkedHours += $total;

        ?>
        
            <tr>

                <td><?php echo $row["emId"]; ?></td>
                <td><?php echo $row["itc_name"]; ?></td>
                <td><?php echo $row["itc_date"]; ?></td>
                <td><?php echo $row["itc_clock"]; ?></td>
                <td><?php echo $row["itc_department"]; ?></td>
                <td><?php echo number_format($totalHours, 2) ?></td>
                <td><?php echo number_format($totalHours2, 2) ?></td>
                <td class="nohours"><?php echo number_format($total, 2) ?></td>
                </tr>
        <?php endwhile; ?>
            <script>
        function sumColumn() {
            let total = 0;
            let prices = document.querySelectorAll(".nohours");

            prices.forEach(nohours => {
                total += parseFloat(nohours.textContent) || 0;
            });

            document.getElementById("total").innerHTML = `<strong>${total}</strong>`;
        }

        sumColumn(); // Call function to calculate sum
    </script>
   <p><strong>Total Worked Hours:</strong> <?php echo number_format($totalWorkedHours, 2); ?></p>
    </table>
  <?php else: ?>
    <p>No users found.</p>
      <?php
  // header('location: admindashboard.php'); ?>
<?php endif; ?>

  <p>
    <small class="text-muted">User: </small>
    <small> <?php echo $_SESSION['AdminId']; ?> </small>
</p>
  </div>
<?php include "footer.php" ?>