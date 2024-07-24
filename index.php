<?php
    //creating connection
    $conn = mysqli_connect('192.168.56.102','vm','123456789','iit_g23ai2028');

    //if click on button take filed value & insert to db
    if(isset($_POST['btn'])){
        $stdname = $_POST['stdname'];
        $stdreg = $_POST['stdreg'];

        if(!empty($stdname) && !empty($stdreg)){
            $query = "INSERT INTO student(stdname,stdreg) VALUES('$stdname',$stdreg)";
            $createQuery = mysqli_query($conn, $query);
            if($createQuery){
              echo "<div class='alert alert-success'>Data successfully inserted.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Field Should not be empty</div>";
        }
    }
?>

<!-- code for delete -->
<?php
  if(isset($_GET['delete'])){
    $stdid = $_GET['delete'];
    $query = "DELETE FROM student WHERE id={$stdid}";
    $deleteQuery = mysqli_query($conn, $query);
    if($deleteQuery){
      echo "<div class='alert alert-success'>Data successfully deleted</div>";
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
      body {
        background-color: #f8f9fa;
      }
      .header {
        text-align: center;
        padding: 20px;
        background-color: #007bff;
        color: white;
        margin-bottom: 30px;
      }
      .footer {
        text-align: center;
        padding: 10px;
        background-color: #343a40;
        color: white;
        position: fixed;
        bottom: 0;
        width: 100%;
      }
      .container {
        margin-top: 30px;
      }
      .form-container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      }
      .table-container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      }
      .btn {
        margin: 5px;
      }
    </style>
    <title>PHP CRUD</title>
  </head>
  <body>
    <div class="header">
      <h1>Assignment 1</h1>
      <p>Student Name: Shubham Raj, Roll No: G23AI2028</p>
    </div>

    <div class="container">
      <div class="form-container shadow mb-4">
        <form method="post" class="d-flex flex-column">
            <input class="form-control mb-3" type="text" name="stdname" placeholder="Enter Name">
            <input class="form-control mb-3" type="number" name="stdreg" placeholder="Enter Reg Number">
            <input class="btn btn-success" type="submit" value="Submit" name="btn">
        </form>
      </div>

      <div class="form-container shadow mb-4">
        <form method="post" class="d-flex flex-column">
            <?php
              if(isset($_GET['update'])){
                $stdid = $_GET['update'];
                $query = "SELECT * FROM student WHERE id={$stdid}";
                $getData = mysqli_query($conn, $query);

                while($rx = mysqli_fetch_assoc($getData)){
                  $stdid = $rx['id'];
                  $stdname = $rx['stdname'];
                  $stdreg = $rx['stdreg'];
            ?>
            <input class="form-control mb-3" type="text" name="stdname" value="<?php echo $stdname ?>" >
            <input class="form-control mb-3" type="number" name="stdreg" value="<?php echo $stdreg ?>">
            <input class="btn btn-primary" type="submit" value="Update" name="update-btn">
            <?php 
                }
              }
            ?>
            <?php
              if(isset($_POST['update-btn'])){
                $stdname = $_POST['stdname'];
                $stdreg = $_POST['stdreg'];

               if(!empty($stdname) && !empty($stdreg)){
                $query = "UPDATE student SET stdname='$stdname', stdreg=$stdreg WHERE id=$stdid";
                $updateQuery = mysqli_query($conn, $query);
               }
              }
            ?>
        </form>
      </div>

      <div class="table-container shadow">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>STD ID</th>
              <th>STD NAME</th>
              <th>Reg No</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              $query = "SELECT * FROM student";
              $readQuery = mysqli_query($conn, $query);

              if($readQuery->num_rows > 0){
                while($rd = mysqli_fetch_assoc($readQuery)){
                  $stdid = $rd['id'];
                  $stdname = $rd['stdname'];
                  $stdreg = $rd['stdreg'];
            ?>
            <tr>
              <td><?php echo $stdid ?></td>
              <td><?php echo $stdname ?></td>
              <td><?php echo $stdreg ?></td>
              <td><a href="index.php?update=<?php echo $stdid ?>" class="btn btn-info">Update</a></td>
              <td><a href="index.php?delete=<?php echo $stdid ?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php
                }
              } else {
                echo "<tr><td colspan='5'>No data to show</td></tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="footer">
      <p>IITJ Assignment 1</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
