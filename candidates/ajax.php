<?php
include "../includes/connection.php";
if(isset($_GET['q'])){
  $ref_id=$_GET['q'];
  $sql = "SELECT * FROM reference WHERE ref_id = $ref_id";
  $q=mysqli_query($conn,$sql);
  $qry=$q->fetch_assoc();
  
  /*
  
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($ref_id,$name, $phone, $email,$company_name,$position);
  $stmt->fetch();
  $stmt->close();
  
  
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Position</label>
  <input type="name" name="positon" class="form-control" id="referee"placeholder="'.$qry['position'].'">
</div> */
  
  echo '
  <form method="post" action="ajax.php" class="form-control>
  
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Company Name</label>
  <input type="text"  name="company" class="form-control" id="company" placeholder="'.$qry['company_name'].'">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Referee Name</label>
  <input type="text" name="name" class="form-control" id="referee"placeholder="'.$qry['ref_name'].'">
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Company Email</label>
  <input type="email" name="email" class="form-control" id="email" placeholder="'.$qry['email'].'">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Position</label>
  <input type="text" name="pos" class="form-control" id="email" placeholder="'.$qry['position'].'">
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Company Telephone</label>
  <input type="text" name="phone" class="form-control" id="telephone" placeholder="'.$qry['phone'].'">
</div> 
<input type="text"  name="id" class="form-control" id="company" value="'.$ref_id.'" class="hidden" hidden >
<div class="mb-3">
<button type="submit" name= "update" class="btn btn-primary w-100">Update</button>
</div>

</form>
';
  }
if(isset($_POST['update'])){
    $conditions=['ref_name','position','email','phone','company name'];
    $id=$_POST["id"];
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
   if ($condition='ref_name'){
           
            if($_POST['name']){
                $name=$_POST['name'];
                global $id ,$update;
                $update="UPDATE `reference` SET `ref_name`= '$name' WHERE `ref_id`='$id'";
               
        $exec=mysqli_query($conn,$update);
        }
   
        if ($condition='position'){
            if($_POST['pos']){
                $pos=$_POST['pos'];
                global $id ,$update;
                $update="UPDATE `reference` SET `position`= '$pos' WHERE `ref_id`='$id'";
               
        $exec=mysqli_query($conn,$update);
            }
        }
        if ($condition='email'){
            if($_POST['email']){
                $email=$_POST['email'];
                global $id ,$update;
                $update="UPDATE `reference` SET `email`= '$email' WHERE `ref_id`='$id'";
                
        $exec=mysqli_query($conn,$update);
            }
        }
        if ($condition='phone'){
            if($_POST['phone']){
                $phone=$_POST['phone'];
                global $id ,$update;
                $update="UPDATE `reference` SET `phone`= '$phone' WHERE `ref_id`='$id'";
                
        $exec=mysqli_query($conn,$update);
            }
        }
       if ($condition='company_name'){
            if($_POST['company']){
                $company=$_POST['company'];
                global $id ,$update;
                $update="UPDATE `reference` SET `company_name`= '$company' WHERE `ref_id`='$id'";
             
        $exec=mysqli_query($conn,$update);
            }
        }
     
        header("Location:candview.php");
       
    }
}

   
}
?>