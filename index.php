<?php
    // Creating connection
    $conn = mysqli_connect('192.168.56.102', 'vm', '123456789', 'iit_g23ai2028');

    // Initialize toast message
    $toastMessage = '';

    // If click on button, take field value & insert to db
    if (isset($_POST['btn'])) {
        $stdname = $_POST['stdname'];
        $stdreg = $_POST['stdreg'];

        if (!empty($stdname) && !empty($stdreg)) {
            $query = "INSERT INTO student(stdname, stdreg) VALUES('$stdname', $stdreg)";
            $createQuery = mysqli_query($conn, $query);
            $toastMessage = $createQuery ? "success-toast" : "error-toast";
        } else {
            $toastMessage = "error-toast";
        }
    }

    // If delete request
    if (isset($_GET['delete'])) {
        $stdid = $_GET['delete'];
        $query = "DELETE FROM student WHERE id={$stdid}";
        $deleteQuery = mysqli_query($conn, $query);
        $toastMessage = $deleteQuery ? "success-toast" : "error-toast";
    }

    // If update request
    if (isset($_POST['update-btn'])) {
        $stdname = $_POST['stdname'];
        $stdreg = $_POST['stdreg'];
        $stdid = $_POST['stdid']; // Hidden field to get the ID

        if (!empty($stdname) && !empty($stdreg)) {
            $query = "UPDATE student SET stdname='$stdname', stdreg=$stdreg WHERE id=$stdid";
            $updateQuery = mysqli_query($conn, $query);
            $toastMessage = $updateQuery ? "success-toast" : "error-toast";
        } else {
            $toastMessage = "error-toast";
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-bottom: 80px; /* Add padding to prevent footer overlap */
        }
        .header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 20px;
            margin-bottom: 30px;
            border-bottom: 5px solid #0056b3;
        }
        .header h1 {
            margin: 0;
            font-size: 2rem;
        }
        .header .subject {
            font-size: 1rem;
        }
        .header .assignment {
            font-size: 1.5rem;
            margin-top: 10px;
        }
        .navbar {
            margin-bottom: 30px;
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar .name, .navbar .roll-no {
            font-size: 1.2rem;
        }
        .navbar .social-icons a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
        .navbar .social-icons i {
            font-size: 1.5rem;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 15px;
            position: fixed;
            bottom: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer .text a {
            color: white;
            text-decoration: none;
        }
        .footer .social-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
        .footer .social-links i {
            font-size: 1.5rem;
        }
        .container {
            margin-top: 30px;
        }
        .form-container, .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        .form-container input, .form-container .btn {
            margin: 5px 0;
        }
        .btn-success, .btn-primary {
            width: 100%;
        }
        @media (max-width: 576px) {
            .header {
                padding: 15px;
            }
            .form-container, .table-container {
                padding: 15px;
            }
        }
    </style>
    <title>VM G23AI2028 IITJ</title>
</head>
<body>
    <div class="header">
        <p class="assignment"><b>Virtualization and Cloud Computing</b>
        <br/>Assignment 1 | <span>Batch-02</span> |
            <span>Trimester - 2</span>
        </p> 
        <a href="https://iitj.ac.in/" target="_blank" class="text-white"><h5>IITJ</h5></a>
    </div>

    <div class="navbar">
        <div class="name">Name: Shubham Raj</div>
        <div class="roll-no">Roll No: G23AI2028</div>
        <div class="social-icons">
            <a href="https://www.linkedin.com/in/shubham14p3/" target="_blank" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
            <a href="https://github.com/shubham14p3" target="_blank" title="GitHub"><i class="bi bi-github"></i></a>
            <a href="https://www.shubhamraj.dev/" target="_blank" title="Personal Website"><i class="bi bi-person"></i></a>
        </div>
    </div>

    <div class="container">
        <!-- Insert Form -->
        <div class="form-container shadow mb-4">
            <form method="post" class="d-flex flex-column">
                <input class="form-control mb-3" type="text" name="stdname" placeholder="Enter Name" required>
                <input class="form-control mb-3" type="number" name="stdreg" placeholder="Enter Reg Number" required>
                <input class="btn btn-success" type="submit" value="Submit" name="btn">
            </form>
        </div>

        <!-- Update Form -->
        <div class="form-container shadow mb-4">
            <form method="post" class="d-flex flex-column">
                <?php
                  if (isset($_GET['update'])) {
                    $stdid = $_GET['update'];
                    $query = "SELECT * FROM student WHERE id={$stdid}";
                    $getData = mysqli_query($conn, $query);

                    while ($rx = mysqli_fetch_assoc($getData)) {
                      $stdid = $rx['id'];
                      $stdname = $rx['stdname'];
                      $stdreg = $rx['stdreg'];
                ?>
                <input type="hidden" name="stdid" value="<?php echo htmlspecialchars($stdid) ?>">
                <input class="form-control mb-3" type="text" name="stdname" value="<?php echo htmlspecialchars($stdname) ?>" required>
                <input class="form-control mb-3" type="number" name="stdreg" value="<?php echo htmlspecialchars($stdreg) ?>" required>
                <input class="btn btn-primary" type="submit" value="Update" name="update-btn">
                <?php 
                    }
                  }
                ?>
            </form>
        </div>

        <!-- Table -->
        <div class="table-container shadow">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STD ID</th>
                        <th>STD NAME</th>
                        <th>Reg No</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      $query = "SELECT * FROM student";
                      $readQuery = mysqli_query($conn, $query);

                      if ($readQuery->num_rows > 0) {
                        while ($rd = mysqli_fetch_assoc($readQuery)) {
                          $stdid = $rd['id'];
                          $stdname = $rd['stdname'];
                          $stdreg = $rd['stdreg'];
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($stdid) ?></td>
                        <td><?php echo htmlspecialchars($stdname) ?></td>
                        <td><?php echo htmlspecialchars($stdreg) ?></td>
                        <td><a href="?update=<?php echo htmlspecialchars($stdid) ?>" class="btn btn-warning btn-sm">Update</a></td>
                        <td><a href="?delete=<?php echo htmlspecialchars($stdid) ?>" class="btn btn-danger btn-sm">Delete</a></td>
                    </tr>
                    <?php
                        }
                      } else {
                    ?>
                    <tr>
                        <td colspan="5" class="text-center">No data found</td>
                    </tr>
                    <?php
                      }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Toast Notifications -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="success-toast" class="toast bg-success text-white" role="alert">
            <div class="toast-body">
                Operation successful!
            </div>
        </div>
        <div id="error-toast" class="toast bg-danger text-white" role="alert">
            <div class="toast-body">
                Operation failed!
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="text">
            <a href="https://www.shubhamraj.dev/" target="_blank">Shubham Raj</a>
        </div>
        <div class="social-links">
            <a href="https://www.linkedin.com/in/shubham14p3/" target="_blank" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
            <a href="https://github.com/shubham14p3" target="_blank" title="GitHub"><i class="bi bi-github"></i></a>
            <a href="https://www.shubhamraj.dev/" target="_blank" title="Personal Website"><i class="bi bi-person"></i></a>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-tW4b5B/eVvE5nQ3Yo6C/2OmKTvB3dP8JTk6o6zF6rOev59aZWxZgOwhTEiG5eq5r" crossorigin="anonymous"></script>

    <!-- Custom Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastMessage = "<?php echo $toastMessage; ?>";
            if (toastMessage) {
                var toastElement = document.getElementById(toastMessage);
                if (toastElement) {
                    var toast = new bootstrap.Toast(toastElement);
                    toast.show();
                }
            }
        });
    </script>
</body>
</html>
