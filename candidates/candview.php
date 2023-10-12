<?php 
session_start();
if ($_SESSION['username']=="" && $_SESSION['isadmin']==""){
  Header("Location:../index.php");
  
}  
include "../includes/connection.php";
$sql1="";

$email = $_SESSION['username'];

  
$sql1="SELECT * FROM `candidates` WHERE `email`= '$email'";
$query=mysqli_query($conn,$sql1);
$data=$query->fetch_assoc();
$id=$data["candidate_id"];
$name=$data["first_name"].' '.$data["last_name"];
$first =$data["first_name"];
$last =$data["last_name"];
$role= $data["position"];
$email=$data["email"];
$phone=$data["phone"];
$image=$data["image"];

$querypath="SELECT * FROM `media` WHERE `id` = '$id'";
$files=mysqli_query($conn,$querypath);
$path=$files->fetch_assoc();
$pic=$path['pic'];
$cv=$path['cv'];



if (isset($_POST['pass'])) {
  // Get the user's ID and new password from the form
  $currentPassword = $_POST['password'];
  $newPassword = $_POST['newpassword'];
  $reenterPassword = $_POST['renewpassword'];


  // Update the user's password in the database
  $query="SELECT * FROM `login` WHERE `email`='$email'";
  $row=mysqli_query($conn,$query);
  $rowdata=$row->fetch_assoc();
  $check =$row->num_rows;
  if ($check==1){
      if($rowdata['password']==$currentPassword){
      if($newPassword==$reenterPassword){
    $query = "UPDATE `login` SET `password` = '$newPassword' WHERE `email`='$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
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
}
if(isset($_POST['update'])){
  
    if(isset($_POST['role'])){
      $role=$_POST['role'];
      
      $query = "UPDATE `candidates` SET `position` = '$role' WHERE `candidate_id`='$id'";
      $result = mysqli_query($conn, $query);
    }
    if (isset($_POST['cv'])){
      $cvs=$_FILES["cv"];
      $cvname=$cvs["name"];
      /**** unlink here */
      $types=explode(".",$cvname);
      $cvsname=$id.'.'.$types[1];
      $cv="../uploads/cvs/".$cvsname;
      if(unlink($cv)){
        if(move_uploaded_file($cvs["tmp_name"],"../uploads/cvs/".$id.'.'.$types[1])){
          
      $updatecand=" UPDATE `media` SET`cv`='$cv' WHERE `id`='$id'";
      $query=mysqli_query($conn,$updatecand);
      }
        
       else{
         echo "failed to update file";
       }
      }else{
        echo "failed to remove media file";
      }
      }
    if (isset($_POST['pic'])){
      $pic=$_FILES["pic"];
      $cvname=$pic["name"];
      /**** unlink here */
      $type=explode(".",$cvname);
      $cvsname=$id.'.'.$type[1];
      $pics="../uploads/pics/".$cvsname;
      if(unlink($pics)){
       if( move_uploaded_file($cv["tmp_name"],"../uploads/pics/".$id.'.'.$type[1])){
          
      $updatecand=" UPDATE `media` SET `pic`='$pics' WHERE `id`='$id'";
      $query=mysqli_query($conn,$updatecand);
     
       }
       else{
         echo "failed to update";
       }
      }else{
        echo "failed to remove media";
      }


    }}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Candidate Profile</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body style="padding-top: 50px;">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="../assets/img/logo.png" alt="" id="prof">
        <span class="d-none d-lg-block">Reference Checking</span>
      </a>
     
    </div><!-- End Logo -->   

  </header><!-- End Header -->
 

  <main id="main" class="main" style="margin: 20px;">


    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?php  echo $pic?>"  id="pic"alt="Profile" class="rounded-circle">
              <h2><?php echo $name?></h2>

            </div>
          </div>

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column referees">

              <select class="form-select referee-options" aria-label="Default select example" onchange="showCustomer(this.value)">
                <option selected value="0" onchange="showRef(this.value)">SELECT REFEREE</option>
                
                <?php
                $sql="SELECT * FROM `reference` where `candidate_id`='$id'";
                                    $data=mysqli_query($conn,$sql);
                                    for ( $x=0; $x<$data->num_rows;$x++){
                                    $row=$data->fetch_assoc();
                                    $name=$row["ref_name"];
                                    $id=$row["ref_id"];
                                       echo ' <option value="'.$id.'">'.$name.'</option>';
                                      
                                        }
                                    
                                        ?>
                
                
              
              </select>

              <br>
             
              <div id="refs">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Company Name</label>
                <input type="email" class="form-control" id="company" placeholder="company name">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Referee Name</label>
                <input type="email" class="form-control" id="referee"placeholder="referee email">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Position</label>
                <input type="text" style="margin-left:auto; margin-top:0"  class="form-control" id="position">
              </div>
              
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Company Email</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Company Telephone</label>
                <input type="email" class="form-control" id="telephone">
              </div>
              
              <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Update</button>
              </div>
              </div>
            </div>
          </div>


        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                  <h5 class="card-title">Profile Details</h5>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">First Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $first?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Last Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $last?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Role</div>
                    <div class="col-lg-9 col-md-8"><?php echo $role?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone Number</div>
                    <div class="col-lg-9 col-md-8"><?php echo $phone?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $email?></div>
                  </div>

                  <!--<div class="row">
                    <div class="col-lg-3 col-md-4 label">Attached cv</div>
                    <div class="col-lg-9 col-md-8"><embed src="path/to/cv.pdf" type="application/pdf" width="100%" height="600px">
                    </div>>                
                   </div>-->
              
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <?php
                  
                  echo '
                  <form action="candview.php" method="post" enctype="multipart/form-data">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="'.$pic.' "  id="pic" alt="Profile">
                      <br><input type="file" id="pict" name="pic" accept=".png, .jpeg, .jpg"  style="margin-top:1%;">
                      </div>
                       
                    </div>

                 
                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Role</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="role" type="text" class="form-control" id="lastName" value="'.$role.'">
                    </div>
                  </div>



                  <div class="row mb-3">
                      <label for="cv" class="col-md-4 col-lg-3 col-form-label">Upload CV:</label>
                      <div class="col-md-8 col-lg-9"><input type="file" id="cv" name="cv" accept=".pdf, .doc, .docx">
                      </div>
                  </div>

                    <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                  </div>
                </form>
                  
                   ';
                  
                  
                  ?>

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="candview.php" method="post">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="pass" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="credits">
      Designed by <a href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwjmoKfznoGBAxW6T0EAHQlxBNYQFnoECCAQAQ&url=https%3A%2F%2Fbakertilly.site%2F&usg=AOvVaw0AgYbNcQeVUdVLc5b7s1kv&opi=89978449">Bakertilly</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>


  <script>
 
function showCustomer(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("refs").innerHTML = this.responseText;
  }
  xhttp.open("GET", "ajax.php?q="+str);
  xhttp.send();
}
  </script>

</body>

</html>