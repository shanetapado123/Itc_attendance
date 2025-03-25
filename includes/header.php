<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="adminreport.php">Admin Reports</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                    <?php
                if (isset($_SESSION['AdminId'])) {
                ?>
                <li><a href="past_record.php">Past Records</a></li>
                <li><a href = "logout.php">Logout</a></li>
                <?php
                    } else {
                        ?>
                        <li><a href="login.php">Login</a></li>
                        <?php
                        }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>         
            </ul>
        </div>
    </div>
</div>               