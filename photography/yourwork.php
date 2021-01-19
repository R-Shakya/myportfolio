<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: http://localhost/myportfolio/photography/index.html');
}
$username=$_SESSION['username'];

$mysqli = new mysqli('127.0.0.1', 'root', '', 'brightlens', NULL);

$sql = " select * from signup where username='$username' ";
$result1=$mysqli->query($sql);
$row1 = $result1->fetch_assoc();

$sql = " select * from photo where username='$username' ";
$result2=$mysqli->query($sql);


$mysqli->close();
?>

<!DOCTYPE html>
<html>

<head lang="en">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    function split_string(text) {
        var res = text.split("#");
        document.getElementById("photo_name").value = res[0];
        document.getElementById("genre").value = res[1];
        document.getElementById("description").value = res[2];
        document.getElementById("img").src = res[3];
    };

    function fill_input() {
        var photo_id = document.getElementById("photo_id").value;
        var req = new XMLHttpRequest();
        req.open("GET", "http://localhost/photography/filltext.php?photo_id=" + photo_id, true);
        req.send();
        req.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == "lol") {
                    alert("LOL");
                } else {
                    split_string(this.responseText);
                }
            }
        };
    };
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
                    <li class="nav-item active">
                        <a href="#" class="nav-link">Hello <?php echo $username ?> </a>
                    </li>
                    <li class="nav-item active">
                        <a href="view.php" class="nav-link">View</a>
                    </li>
                    <li class="nav-item active">
                        <a href="logout.php" class="nav-link">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- End : Header -->

    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col">
                                    <center>
                                        <h4>ADD</h4>
                                    </center>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <center>
                                        <img id="img" src="imgs/logo/brightlens.png" width="200px" height="100px">
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
                                    <div class="form-group">
                                        <input id="img_link" type="file" name="img_link" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Photo ID</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input id="photo_id" name="photo_id" type="text" class="form-control"
                                                placeholder="ID">
                                            <input type="button" class="btn btn-primary" value="Go"
                                                onclick="fill_input()">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <label for="">Photo Name</label>
                                    <div class="form-group">
                                        <input id="photo_name" name="photo_name" type="text" class="form-control"
                                            placeholder="photo Name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Username</label>
                                            <div class="form-group">
                                                <input id="username" name="username" type="text" class="form-control"
                                                    value="<?php echo $row1["username"]; ?>" placeholder="username"
                                                    readonly="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Full Name</label>
                                            <div class="form-group">
                                                <input id="fullname" name="fullname" type="text" class="form-control"
                                                    value="<?php echo $row1["fullname"]; ?>" placeholder="fullname"
                                                    readonly="true">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Genre</label>
                                    <div class="form-group">
                                        <select name="genre" id="genre" size="5" class="form-control">
                                            <option value="Landscape">Landscape</option>
                                            <option value="Wildlife">Wildlife</option>
                                            <option value="Aerial">Aerial</option>
                                            <option value="Sports">Sports</option>
                                            <option value="Portrait">Portrait</option>
                                            <option value="Architectural">Architectural</option>
                                            <option value="Wedding">Wedding</option>
                                            <option value="God">God</option>
                                            <option value="Person">Person</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Photo Description</label>
                                    <div class="form-group">
                                        <textarea class="form-control" name="description" id="description" cols="30"
                                            rows="2" placeholder="Book Description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <input name="role" type="submit" class="btn btn-success btn-block btn-lg"
                                        value="Add">
                                </div>
                                <div class="col-4">
                                    <input name="role" type="submit" class="btn btn-warning btn-block btn-lg"
                                        value="Update">
                                </div>
                                <div class="col-4">
                                    <input name="role" type="submit" class="btn btn-danger btn-block btn-lg"
                                        value="Delete">
                                </div>
                            </div>

                        </div>
                    </div>
                    <br><br>
                </div>

                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col">
                                    <center>
                                        <h4>Your List</h4>
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
                                                <th scope="col">ID</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                for($i=1;$i<=$result2->num_rows;$i++){
                                                    $row = $result2->fetch_assoc();
                                                ?>
                                            <tr>
                                                <td><?php echo $row['photo_id']; ?></td>
                                                <td>
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-lg-9">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h5><?php echo $row['photo_name']; ?></h5>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <label>Username -
                                                                            <?php echo $row['username']; ?></label>
                                                                        <label> | Genre -
                                                                            <?php echo $row['genre']; ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <label>Description -
                                                                            <?php echo $row['discription']; ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <img class="img-fluid"
                                                                    src="<?php echo $row['img_link']; ?>" width="200px">
                                                            </div>
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
                        <a href="#" target="_blank" class="footerlinks">Simple Snippets</a>

                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- End : footer -->

    <?php
        if(isset($_GET['true']) && $_GET['true']!=""){
            echo '<script>alert("'.$_GET['true'] .'")</script>'; 
        }
        if(isset($_GET['false']) && $_GET['false']!=""){
            echo '<script>alert("'.$_GET['false'] .'")</script>';
        }
    ?>
</body>

</html>