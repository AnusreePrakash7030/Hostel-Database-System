<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="start.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Contact.php">Contact</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            $admsn_no = $_POST["admsn_no"];
            $f_Name = $_POST["f_name"];
            $l_Name = $_POST["l_name"];
            $dept = $_POST["dept"];
            $address = $_POST["address"];
            $district = $_POST["district"];
            $state = $_POST["state"];
            $menu = $_POST["menu"];
            $ph_no = $_POST["ph_no"];

            $errors = array();
            if (!filter_var($admsn_no, FILTER_VALIDATE_INT)) {
                array_push($errors, "Admission Number is not valid");
            }
            require_once "database.php";
            $sql = "SELECT * FROM student WHERE admsn_no = '$admsn_no'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                array_push($errors, "Admission number already exists!");
            }
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "INSERT INTO student (admsn_no,f_name,l_name,dept,address,district,state,menu,ph_no) VALUES ( ?, ?, ?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sssssssss", $admsn_no, $f_name, $l_name, $dept, $address, $district, $state, $menu, $ph_no);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";

                } else {
                    die("Something went wrong");
                }
            }
        }
        ?>

        <h1>STUDENT DETAILS</h1>
        <form action="profile.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="admsn_no" placeholder="admission number:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="f_name" placeholder="First Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="l_name" placeholder="Last Name">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="dept" placeholder="Department">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="Address">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="district" placeholder="District">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="state" placeholder="State">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="ph_no" placeholder="Phone Number">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="menu" placeholder="Veg/Non-Veg">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                <a href="index.php" class="btn btn-primary">Back</a>
            </div>
    </div>
    </form>

    </div>

</body>

</html>