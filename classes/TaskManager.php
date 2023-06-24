<?php 
session_start();
include("config/config.php");

class TaskManager extends Connection{

//Add Task
public function store($allData){
    $taskName = $allData['add_task'];
   
    $imageName = $_FILES['task_image']['name'];
    $temImageName = $_FILES['task_image']['tmp_name'];

    $taskDate =$allData['add_date'];
    
    
    $sql = "INSERT INTO tasks (task_name, task_img, task_date) VALUES ('$taskName', '$imageName', '$taskDate')";
    

    $result = $this->con->query($sql);
    if($result){
        $_SESSION['message']= "Data Inserted Successfully!";
        $_SESSION['type']="success";
        move_uploaded_file( $temImageName,"upload/". $imageName);
    }
    else{
        $_SESSION['message']= "Data Not Inserted!";
        $_SESSION['type']="danger";
    }

}
// Show Tasks
public function show(){
   return $result= $this->con->query("SELECT * FROM `tasks`");
}


//Delete Task
public function destroy($tid){

    //Image delete from upload directory
    $fire = $this->con->query("SELECT * FROM `tasks` WHERE id='$tid'");

    if($fire){
        $row = mysqli_fetch_assoc($fire);
        $taskimage = $row['task_img'];
        unlink("upload/".$taskimage);
    }
    //Task Delete From Database
    $result = $this->con->query("DELETE FROM `tasks` WHERE id='$tid'");
    if($result){
        header("location:index.php");
    }

}
//Edit Task
public function edit($tid){

    //Image delete from upload directory
    return $fire = $this->con->query("SELECT * FROM `tasks` WHERE id='$tid'");


}

//Update Task
public function update($allData,$tid){
    $taskName = $allData['add_task'];
   
    $newName = $allData['new_task'];
    $newDate = $allData['new_date'];

    $old__imageName = $allData['old__image'];
    $new__imageName = $_FILES['task_image']['name'];
    $tmp__imageName = $_FILES['task_image']['tmp_name'];

    if($new__imageName != ''){
        $update_imageName = $new__imageName;
    }
    else{
        $update_imageName = $old__imageName;
    }
    if(file_exists("upload/".$_FILES['task_image']['name'])){
        $sql = "UPDATE `tasks`  SET `task_name`='$newName',`task_img`= '$update_imageName',`task_date`='$newDate' WHERE id='$tid'";
        $fire = $this->con->query($sql);
        header("location: index.php");
    }
    else{
        $sql = "UPDATE `tasks`  SET `task_name`='$newName',`task_img`= '$update_imageName',`task_date`='$newDate' WHERE id='$tid'";
        $fire = $this->con->query($sql);
        // header("location: index.php");
        if($fire){
            if($_FILES['task_image']['name'] != ""){
                move_uploaded_file($tmp__imageName, "upload/".$new__imageName);
                unlink("upload/".$old__imageName);
            }
            $_SESSION['message']= "Data Updated Successfully!";
            $_SESSION['type']="success";
            header("location: index.php"); 
        }
        else{
            $_SESSION['message']= "Data Not Updated!";
            $_SESSION['type']="danger";
            header("location: index.php"); 
        }
    }

}

}

?>