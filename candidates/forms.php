<?php
if (isset($_POST['password'])) {
  // Get the user's ID and new password from the form
  $currentPassword = $_POST['password'];
  $newPassword = $_POST['newpassword'];
  $reenterPassword = $_POST['renewpassword'];


  // Update the user's password in the database
  $query="SELECT * FROM `passwords` WHERE `password` =$currentPassword && `email`='$email'";
  $row=mysqli_query($conn,$query);
  $check =$row->num_rows;
  if ($check==1){
    if($newPassword==$reenterPassword){
  $query = "UPDATE `login` SET `password` = '$newPassword'";
  $result = mysqli_query($conn, $query);

  if ($result) {
      echo "Password updated successfully.";
  } else {
      echo "Password update failed: " . mysqli_error($conn);
  }
}else{
  echo "passwords dont match";
}
}else {
  echo "wrong password";
}
  
}
if(isset($_POST['update'])){
  $conditions=['first_name','last_name','email','phone','position'];
  foreach ($conditions as $condition){
      
   /*   switch($condition){
          case "ref_name":
              if($_POST['name']){
                  $name=$_POST['name'];
                  update($name,$condition,$id);
              }
              case "position":
                  if($_POST['email']){
                      $name=$_POST['email'];
                      update($name,$condition,$id);
                  }
                  
              case "email":
                  if($_POST['email']){
                      $name=$_POST['email'];
                      update($name,$condition,$id);
                  }
                  
              case "phone":
                  if($_POST['phone']){
                      $name=$_POST['phone'];
                      update($name,$condition,$id);
                  }
                  
              case "company_name":
                  if($_POST['company']){
                      $name=$_POST['company'];
                      update($name,$condition,$id);
                  }
      }*/
$update="";
 if ($condition='first_name'){
         
          if($_POST['firstName']){
              $name=$_POST['firstName'];
              global $id ,$update;
              $update="UPDATE `candidates` SET `first_name`= '$name' WHERE `candidate_id`='$id'";
             
      $exec=mysqli_query($conn,$update);
      }
 
      elseif ($condition='last_name'){
          if($_POST['lastName']){
              $pos=$_POST['lastName'];
              global $id ,$update;
              $update="UPDATE `candidates` SET `last_name`= '$pos' WHERE `candidate_id`='$id'";
             
      $exec=mysqli_query($conn,$update);
          }
      }
      elseif ($condition='email'){
        if($_POST['email']){
            $pos=$_POST['email'];
            global $id ,$update;
            $update="UPDATE `candidates` SET `email`= '$mail' WHERE `candidate_id`='$id'";
           
      $exec=mysqli_query($conn,$update);
        }
      }
     
      elseif ($condition='phone'){
          if($_POST['phone']){
              $phone=$_POST['phone'];
              global $id ,$update;
              $update="UPDATE `candidates` SET `phone`= '$phone' WHERE `candidate_id`='$id'";
              
      $exec=mysqli_query($conn,$update);
          }
      }
     elseif ($condition='position'){
          if($_POST['position']){
              $company=$_POST['position'];
              global $id ,$update;
              $update="UPDATE `candidates` SET `position`= '$company' WHERE `candidate_id`='$id'";
           
      $exec=mysqli_query($conn,$update);
          }
      }
     
      elseif ($condition='address'){
        if($_POST['address']){
            $company=$_POST[''];
            global $id ,$update;
            $update="UPDATE `candidates` SET `address`= '$company' WHERE `candidate`='$id'";
         
      $exec=mysqli_query($conn,$update);
        }
  if($exec){
      header("Location:candview.php");
     
  }
  else  echo "Error updating reference";
  }
}
  }
 
}
  ?>