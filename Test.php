<?php session_start();       // Start the session ?> 
<?php include "header.php" ?>

  <div class="container col-12 border rounded mt-3">
  <h1 class=" mt-3 text-center">Payroll Worked Hours </h1>
  <hr>
  <script type="text/javascript" src="saveAsExcel.js"></script>

  <form action="" method="POST">
   <button type="submit" name='dashboard' class=" btn btn-primary mb-3">Admin Dashboard</button>
   <button type="button" value="Import as Excel" name='generate' class=" btn btn-success mb-3" onclick="saveAsExcel('tableToExcel', 'Payroll Worked.xls')">Import as Excel</button>
    
   <button type="submit" name='logout' class=" btn btn-danger mb-3" style="float: right;"> Logout</button>
   <input type="searchid" class="form-control" id="EmpId" name="searchid" placeholder="Search" autocomplete="off">
   <small class="text-muted">Filter: Employee ID, Name, Department</small>
      <form method="POST">
          Start Date: <input type="date" name="start_date" required>
          End Date: <input type="date" name="end_date" required>
          <input type="submit" name="filter" value="Filter">
      </form>
  </form>




<?php
// Database Connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['filter'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Validate dates to prevent SQL Injection
    if (!empty($start_date) && !empty($end_date)) {
        // SQL Query to filter date range
        $sql = "SELECT * FROM clockinout WHERE itc_date BETWEEN ? AND ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result();

        // Display Results
        echo "<table border='1'>";
        echo "<tr><th>Employee ID</th><th>Name</th><th>Shift</th><th>Department</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['emId']}</td><td>{$row['itc_name']}</td><td>{$row['itc_clock']}</td><td>{$row['itc_department']}</td></tr>";
        }
        echo "</table>";

        $stmt->close();
    } else {
        echo "Please select both start and end dates.";
    }
}

$conn->close();
?>






  <p>
    <small class="text-muted">User: </small>
    <small> <?php echo $_SESSION['AdminId']; ?> </small>
</p>
  </div>
<?php include "footer.php" ?>