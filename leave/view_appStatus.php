<?php
session_start();



    include_once 'dbconnect.php';

    $id = $_SESSION['userAccessLevel'];
    $name = NULL;
    $email = NULL;
    $type = NULL;

    $query = "SELECT* FROM users WHERE id='$id'";

    if ($conn->query($query) == TRUE) {

        $result = $conn->query($query);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

//            echo $row['id'];
            $name = $row['name'];
            $email = $row['email'];
            $type = $row['type'];
        }
    }

    $checkUpdate=0;
                    
    if (isset($_POST['submit_btn'])) {

        

        $subject = $_POST['subject'];
        $description = $_POST['description'];
        $days = $_POST['days'];

        $insertSql = "INSERT INTO applications(`subject`, `description`, `user_id`, `days`, `status`) VALUES ($subject', '$description', '$id', '$days', 'Pending')";
        if ($conn->query($insertSql) == TRUE) {
            $checkUpdate = 1;
        } else {
            die($conn->error);
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
            <title>Side navbar manu - Bootsnipp.com</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
            <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
            <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
            <link href="css/style.css" type="text/css" rel="stylesheet">
            <style type="text/css">
                .navbar-login
                {
                    width: 305px;
                    padding: 10px;
                    padding-bottom: 0px;
                }

                .navbar-login-session
                {
                    padding: 10px;
                    padding-bottom: 0px;
                    padding-top: 0px;
                }

                .icon-size
                {
                    font-size: 87px;
                }
            </style>
            <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
            <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        </head>
        <body>
            <div class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container"> 
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span> 
                        </button>
                        <a target="_blank" href="#" class="navbar-brand">View Status</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Leave
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="home.php?id=<?php echo $id; ?>">Apply</a></li>
                                    <li><a href="#">View Status</a></li>
                                </ul>
                            </li>              
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-user"></span> 
                                    <strong><?php echo $name; ?></strong>
                                    <span class="glyphicon glyphicon-chevron-down"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="navbar-login">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <p class="text-center">
                                                        <span class="glyphicon glyphicon-user icon-size"></span>
                                                    </p>
                                                </div>
                                                <div class="col-lg-8">
                                                    <p class="text-left"><strong><?php echo $name; ?></strong></p>
                                                    <p class="text-left small"><?php echo $email; ?></p>

                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <div class="navbar-login navbar-login-session">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p>
                                                        <a href="logout.php" class="btn btn-danger btn-block">Logout</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="container" style="margin-top: 100px;">
                <div class="row">
                    <h2 class="text-center">Application Status</h2>
                        <hr>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">SL#</th>
                                    <th class="text-center">Application-ID</th>
                                    <th class="text-center">Status</th>
                                </tr>

                            </thead>
                            <?php
                            $select = "SELECT* FROM applications where user_id='$id'";
                            $result = $conn->query($select);

                            if ($result->num_rows > 0) {
                                $i = 1;
                                while ($app = $result->fetch_assoc()) {
                                    ?>
                                    <tbody>
                                        <tr class="text-center">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $app['ap_id']; ?></td>
                                            <td><?php echo $app['status']; ?></td>
                                            
                                        </tr>
                                    </tbody>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>



        </body>
    </html>
   