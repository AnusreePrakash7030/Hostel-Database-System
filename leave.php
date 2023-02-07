<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
           $full_name = $_POST["full_name"];
           $branch = $_POST["branch"];
           $reason = $_POST["reason"];
           $date = $_POST["date"];
           
           $errors = array();
           
           if (empty($admsn_no) OR empty($full_name) OR empty($branch) OR empty($reason) OR empty($date)) {
            array_push($errors,"All fields are required");
           }
            if (!filter_var($admsn_no, FILTER_VALIDATE_INT)) {
                array_push($errors, "Admission Number is not valid");
            }
           require_once "database.php";
            $sql = "INSERT INTO leave_form (admsn_no,full_name,branch,reason,date) VALUES (?, ?, ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sssss", $admsn_no,$full_name,$branch,$reason,$date);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Form submitted successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }
        ?>
        <h1>LEAVE FORM</h1>
        <form action="leave.php" method="post">
            <div class="form-group">
                <input type="admsn_no" class="form-control" name="admsn_no" placeholder="Admission Number:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="full_name" placeholder="Full Name:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="branch" placeholder="Branch">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="reason" placeholder="Reason">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="date" placeholder="Date">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                <a href="index.php" class="btn btn-primary">Back</a>
            </div>


        </form>

    </div>

</body>

</html>