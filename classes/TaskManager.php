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

////Edit Task
public function update($allData,$tid){
    $taskName = $allData['add_task'];
   
    $imageName = $_FILES['task_image']['name'];
    $temImageName = $_FILES['task_image']['tmp_name'];

    $taskDate =$allData['add_date'];
    
    
    $sql = "UPDATE `tasks`  SET `task_name`='$taskName',`task_img`= '$imageName',`task_date`='$taskDate' WHERE id='$tid'";
    

    $result = $this->con->query($sql);
    if($result){
        $_SESSION['message']= "Data Updated Successfully!";
        $_SESSION['type']="success";
        if(isset($imageName)){
        move_uploaded_file( $temImageName,"upload/". $imageName);
        }
        header("location: index.php");
    }
    

}






}

?>