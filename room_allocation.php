<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style3.css">
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
            $room_no = $_POST["room_no"];
            $name = $_POST["name"];
            $class_branch = $_POST["class_branch"];
            $errors = array();
            require_once "database.php";
            $sql = "SELECT * FROM room WHERE room_no = '$room_no'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 4) {
                array_push($errors, "room full!");
            } else {
                $sql = "INSERT INTO room (room_no,name,class_branch) VALUES ( ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $room_no, $name, $class_branch);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Room allocated successfully.</div>";
                } else {
                    die("Something went wrong");
                }
            }
            }
        ?>
        <h1>ROOM ALLOCATION</h1>
        <form action="room_allocation.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="room_no" placeholder="room_no">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="class_branch" placeholder="branch">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Allocate" name="submit">
                <a href="index1.php" class="btn btn-primary">Back</a>
            </div>
        </form>
    </div>

</body>

</html>