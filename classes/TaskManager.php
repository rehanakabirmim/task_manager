<?php 
include("config/config.php");

class TaskManager extends Connection{

//Add Task
public function store($allData){
    $taskName = $allData['add_task'];
   
    $imageName = $_FILES['task_image']['name'];
    $temImageName = $_FILES['task_image']['tmp_name'];

    $taskDate =$allData['add_date'];
    
//  kjhh
    
    $sql = "INSERT INTO tasks (task_name, task_img, task_date) VALUES ('$taskName', '$imageName', '$taskDate')";
    

    $result = $this->con->query($sql);
    if($result){
        echo "Data Inserted Successfully!";
        move_uploaded_file( $temImageName,"upload/". $imageName);
    }

}
// Show Tasks
public function show(){
   return $result= $this->con->query("SELECT * FROM `tasks`");
}

}





?>