<?PHP
include("classes/TaskManager.php");
$t1 = new TaskManager();

 if(isset($_POST['save'])){
    // print_r($_POST['save']);
       $t1->store($_POST);
 }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS LINK-->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" href="css/fontawesome.min.css">
   <link rel="stylesheet" href="css/style.css">
    <title>Task Manager</title>
</head>
<body>

    <div class="container">
        <div class="row py-3">
           <div class="col-lg-8 offset-lg-2 shadow p-4">
            <div class="title">
                <h2 class="display-3 text-primary">Task Manager</h2>
                <p class="lead">This is is a simple project.We are going to use HTML,Bootstrap,PHP and MYSQL.</p>
            </div>
            <div class="alltask py-4">
                <h2 class="display-3 text-primary">All Tasks </h2> 
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Task Name</th>
                        <th>Task Image</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>

                    <?php 
                    $data = $t1->show();
                    $i = 1;
                    while($row = mysqli_fetch_assoc($data)){ ?>

                    <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $row['task_name']?></td>

                        <td>
                            <img src="upload/<?php echo $row['task_img'];?>" alt="" width="100px" height="80px">
                        </td>
                        
                        <td><?php echo date("d-M-Y",strtotime($row['task_date']));?></td>
                    
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']?>"  class="btn btn-info">
                            <i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="delete.php?id=<?php echo $row['id']?>"  class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php 
                        }
                    ?>
                </table>
             
                </div>
                <div class="addTask">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <h2 class="display-3 text-primary">Add Tasks </h2>

                        <!-- Display Message-- -->

                        <?php 
                        if(isset($_SESSION['message'])){?>
                    
                        <div class="alert alert-<?php echo $_SESSION['type']?> alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['message'];?>
  
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    
                        </<?php
                                unset($_SESSION['message']);
                                }
                                
                                ?>

                        <div class="form-group mb-3">
                            <label for="addTask">Add Task</label>
                            <input type="text" name="add_task" id="addTask" placeholder="Enter task details" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="taskImage">Task Image</label>
                            <input type="file" name="task_image" id="taskImage"  class="form-control mb-3">
                        </div>

                        <div class="form-group mb-3">
                            <label for="addDate">Add Date</label>
                            <input type="date" name="add_date" id="addDate" class="form-control">
                          </div>
                          <div class="form-group mb-3">
                            <!-- <input type="submit" name="save" class="btn btn-dark" value="Add Task"> -->
                            <button type="submit" name="save" value="submit">Add Task</button>
                          </div>
                    </form>
                </div>
                
                </div>
            </div>
           </div>
       
<!--JS LINK-->
    <script src="js/jqury.3.6.4.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> -->
    
    <script src="js/index.js"></script>
   
</body>
</html>

