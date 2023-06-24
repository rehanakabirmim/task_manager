<?php
    include("classes/TaskManager.php");
    $t1 = new TaskManager();

    $id = $_GET['id'];

    if(isset($_GET['id'])){
        $data=$t1->edit($id);
        $row=mysqli_fetch_assoc($data);
    }
    if(isset($_POST['upd_task'])){
        $t1->update($_POST,$id);
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
            
           
                <div class="addTask">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <h2 class="display-3 text-primary">Update Tasks </h2>

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
                            <input type="text" name="new_task" id="addTask" placeholder="Enter task details"
                             class="form-control" value="<?php echo $row['task_name'];?>">
                        </div>

                        <div class="form-group mb-3">
                            <label for="taskImage">Task Image</label>
                            <img src="upload/<?php echo $row['task_img']?>" alt="" width="60px" height="60px">
                            <input type="file" name="task_image" id="taskImage"  class="form-control mt-3">
                            <input type="hidden" name="old__image" id="taskImage"  class="form-control mt-3" value="<?php echo $row['task_img'];?>">
                        </div>

                        <div class="form-group mb-3">
                            <label for="addDate">Add Date</label>
                            <input type="date" name="new_date" id="addDate" class="form-control" value="<?php echo $row['task_name'];?>">
                          </div>
                          <div class="form-group mb-3">
                            <input type="submit" name="upd_task" class="btn btn-info" value="Update Task"></div>
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

