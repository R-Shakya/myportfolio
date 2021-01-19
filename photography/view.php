<?php

session_start();

$mysqli = new mysqli('127.0.0.1', 'root', '', 'brightlens', NULL);

$sql = " select * from photo ";
$result=$mysqli->query($sql);

$mysqli->close();
?>

<!DOCTYPE html>
<html>

<head lang="en">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>View-BrightLens</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- datatables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable();
    });
    </script>
</head>

<body>
    <!-- Start : Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.html">
                <img src="imgs/logo/brightlens.png" width="100px" height="50px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a href="events.html" class="nav-link">Events</a>
                    </li>
                    <li class="nav-item active">
                        <a href="aboutus.html" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item active">
                        <a href="terms.html" class="nav-link">Terms</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <?php
                    if(!isset($_SESSION['username'])){
                        echo '<li class="nav-item active">
                                 <a href="login.html" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item active">
                                <a href="signup.html" class="nav-link">Sign Up</a>
                            </li>';
                    }
                    else{
                        echo '<li class="nav-item active">
                                <a href="#" class="nav-link">Hello '.$_SESSION['username'].'</a>
                            </li>
                            <li class="nav-item active">
                                <a href="logout.php" class="nav-link">Logout</a>
                            </li>';
                    }
                    ?>

                </ul>
            </div>
        </nav>
    </header>
    <!-- End : Header -->

    <form action="yourwork1.php" method="POST" enctype="multipart/form-data">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col">
                                    <center>
                                        <h4>Our Work</h4>
                                    </center>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $data=$result->num_rows;
                                                $datarow=($data/6)+1;
                                                for($i=1;$i<=$datarow;$i++){
                                                ?>
                                            <tr>
                                                <td>
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <?php
                                                                for($j=1;$j<=6;$j++){
                                                                if($row = $result->fetch_assoc()){
                                                            ?>
                                                            <div class="col-lg-2">
                                                                <div class="row">
                                                                    <div class="col-12 text-center">
                                                                        <label><?php echo $row['photo_name']; ?></label>
                                                                        <label> |
                                                                            <?php echo $row['username']; ?></label>
                                                                        <label> | <?php echo $row['genre']; ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <img class="img-fluid"
                                                                            src="<?php echo $row['img_link']; ?>"
                                                                            width="200px">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12 text-center">
                                                                        <label><?php echo $row['discription']; ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                                }
                                                                else{
                                                                break;
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Start : footer -->
    <footer>
        <div id="footer2" class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <p style="color: whitesmoke;">&copy All rights Reserved.
                        <a href="#" target="_blank" class="footerlinks">CodeShiner</a>

                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- End : footer -->
</body>

</html>