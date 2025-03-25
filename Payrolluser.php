<?php require './includes/common.php'; ?>
<?php include 'database.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Index | Payroll</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
      <?php include './includes/header.php'; ?>
      
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="thumbnail">
                <img src="./img/view.png" alt="">
                <div class="caption">
                    <form action="" method="POST">
                        <input type="search" class="form-control" id="EmpId" name="searchid" placeholder="Search" autocomplete="off">
                        <small class="text-muted">Filter: Employee ID, Name, Date, Department</small>
                        <p>
                            Start Date:
                            <input type="date" class="form-control" name="start_date" placeholder="Search" autocomplete="off">
                            End Date: <input type="date" class="form-control" name="end_date" placeholder="Search" autocomplete="off">
                        </p>
                        <button type="submit" name="search" class="btn btn-success mb-3" style="float: right;">Filter</button>
                        <small class="text-muted">Filter Date Range</small>
                    </form>
                </div>
            </div>   
          </div>

          <?php
          // SQL query to retrieve users data
          $sql = "SELECT * FROM clockinout LIMIT 1";

          // Execute the query
          $result = $conn->query($sql);
          $totalWorkedHours = 0.00;

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          if (isset($_POST['search'])) {
              $keyword = mysqli_real_escape_string($conn, $_POST['searchid']);  // Sanitize inputs
              $start_date = $_POST['start_date'];
              $end_date = $_POST['end_date'];

              // SQL query with search filter
              $sql = "SELECT e.emId, e.itc_name, e.itc_department, e.basic, 
                             c.itc_date, c.itc_amin, c.itc_amout, c.itc_pmin, c.itc_pmout
                      FROM employeeid e
                      LEFT JOIN clockinout c ON e.emId = c.emId
                      WHERE (e.emId LIKE '%$keyword%' 
                          OR e.itc_name LIKE '%$keyword%' 
                          OR e.itc_department LIKE '%$keyword%')
                      AND c.itc_date BETWEEN '$start_date' AND '$end_date'";
          } else {
              // Default query (without filter)
              $sql = "SELECT e.emId, e.itc_name, e.itc_department, e.basic, 
                             c.itc_date, c.itc_amin, c.itc_amout, c.itc_pmin, c.itc_pmout
                      FROM employeeid e
                      LEFT JOIN clockinout c ON e.emId = c.emId";
          }

          $result = $conn->query($sql); // Execute the updated query

          ?>

          <div class="col-md-8">
            <h3>Employee Work Hours</h3>
            
            <?php if ($result->num_rows > 0): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Basic Pay</th>
                            <th>Date</th>
                            <th>Total Worked Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>      
                            
                            <?php
                            // Check if the clock-in/out values exist before creating DateTime objects
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

                            $total = $totalHours + $totalHours2;
                            $totalWorkedHours += $total;
                            $idko = $row['emId'];
                            ?>

                            <tr>
                                <td><?php echo $row["emId"]; ?></td>
                                <td><?php echo $row["itc_name"]; ?></td>
                                <td><?php echo $row["itc_department"]; ?></td>
                                <td><?php echo $row["basic"]; ?></td>
                                <td><?php echo $row["itc_date"]; ?></td>
                                <td><?php echo number_format($total, 2); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No Working Hours Found.</p>
                <?php
                    $total = 0.00;
                    $idko = "0";
                ?>
            <?php endif; ?>

          </div>
        </div>
    
        <p><strong>Total Worked Hours:</strong> <?php echo number_format($totalWorkedHours, 2); ?></p>
    </div>
    <div class="container col-4 border rounded bg-light mt-5" style='--bs-bg-opacity: .5;'>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-danger">
                    <div class="panel-heading">Salary Management</div>
                    <div class="panel-body">
                        <form action="pay.php" method="GET">
                            <div class="form-group">
                                <label>Enter Employee ID:</label>
                                <input type="text" class="form-control" value=<?php echo $idko; ?> name="id" required>
                            </div>
                            <div class="form-group">
                                <label for="leave">Leave:</label>
                                <input type="text" class="form-control" placeholder="Total Leave Days." name="leave" required> 
                            </div>
                            <div class="form-group">
                                <label for="Conveyence">No. of Hours Worked</label>
                                <input type="text" class="form-control" value=<?php echo number_format($total, 2); ?> name="totalworked" required>
                            </div>
                            <div class="form-group">
                                <label for="overtime">Overtime:</label>
                                <input type="text" class="form-control" placeholder="Overtime in Hours" name="overtime" required>
                            </div>
                            <div class="form-group">
                                <label for="Conveyence">Conveyance</label>
                                <input type="text" class="form-control" placeholder="Conveyance" name="conveyence" required>
                            </div>

                            <h3 class="text-danger" style="text-align:center;">
                                <?php if (isset($_GET['error'])) { echo $_GET['error']; } ?>
                            </h3>

                            <div>
                                <input type="submit" name="submit" value="Pay" class="btn btn-primary btn-lg">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
