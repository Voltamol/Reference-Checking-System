<!--PHP CODE FOR CREATING REQUIRED JAVASCRIPT OBJECT-->
  <!--<?php
  // Retrieve data from a database or any other source
  $data = [
    "companyName1"=>[
       'name' => 'John Doe',
       'age' => 30,
       'email' => 'johndoe@example.com'
         ],
     "companyName2"=>[
         'name' => 'John Doe',
         'age' => 30,
         'email' => 'johndoe@example.com'
       ]

   ];
 
 // Convert the data to JSON
 $jsonData = json_encode($data);
 ?>-->
 <?php

include "includes/connection.php";
include "includes/trim.php";

 if (isset($_POST['submit'])) {
  // Get the user's ID and new password from the form
  $currentPassword = $_POST['currentPassword'];
  $newPassword = $_POST['newPassword'];
  $reenterPassword = $_POST['reenterPassword'];


  // Update the user's password in the database
  $query = "UPDATE login SET password = '$newPassword'";
  $result = mysqli_query($conn, $query);

  if ($result) {
      echo "Password updated successfully.";
  } else {
      echo "Password update failed: " . mysqli_error($conn);
  }
}
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
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body style="padding-top: 50px;">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
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

              <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2>Kevin Anderson</h2>

            </div>
          </div>

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column referees">

              <select class="form-select referee-options" aria-label="Default select example" onchange="changeValues(this)">
                <option selected value="0">SELECT REFEREE</option>
                <option value="1">Bakertilly</option>
                <option value="2">Econet</option>
                <option value="3">NetOne</option>
              </select>

              <br>
              
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Company Name</label>
                <input type="email" class="form-control" id="company" placeholder="name@example.com">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Referee Name</label>
                <input type="email" class="form-control" id="referee" placeholder="name@example.com">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Company Email</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Company Telephone</label>
                <input type="email" class="form-control" id="telephone" placeholder="name@example.com">
              </div>
              
              <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Update</button>
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
                    <div class="col-lg-9 col-md-8">Kevin</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Last Name</div>
                    <div class="col-lg-9 col-md-8">Kevin</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone Number</div>
                    <div class="col-lg-9 col-md-8">+263778317780</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">k.anderson@example.com</div>
                  </div>

                  <!--<div class="row">
                    <div class="col-lg-3 col-md-4 label">Attached cv</div>
                    <div class="col-lg-9 col-md-8"><embed src="path/to/cv.pdf" type="application/pdf" width="100%" height="600px">
                    </div>>                
                   </div>-->
              
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form>
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/img/profile-img.jpg" alt="Profile">
                        <div class="pt-2">
                          <a href="#" id="upload-img"  class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <input type="file" name="profile_img" style="display: none;" id="profile-img">
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="Kevin Anderson">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastName" type="text" class="form-control" id="lastName" value="Kevin Anderson">
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phonenumber" type="text" class="form-control" id="phonenumber" value="+263778317780">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="k.anderson@example.com">
                      </div>
                    </div>

                    <div class="row mb-3">
                        <label for="cv" class="col-md-4 col-lg-3 col-form-label">Upload CV:</label>
                        <div class="col-md-8 col-lg-9"><input type="file" id="cv" name="cv" accept=".pdf, .doc, .docx">
                        </div>
                    </div>

                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="profile-change-password" method="post">

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
                      <button type="submit" class="btn btn-primary">Change Password</button>
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
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>


  <script>
    //referees
    //data = <?php echo $jsonData; ?>;
    data={
      Bakertilly:{
        company:'bakertilly',
        referee:'martin muduva',
        email:'mmuduva@bakertilly.co.zw',
        telephone:'+263718092534'
      },
      Econet:{
        company:'econet',
        referee:'strive masiyiwa',
        email:'strivemasiyiwa@bakertilly.co.zw',
        telephone:'+263718092534'
      },
      NetOne:{
        company:'netone',
        referee:'brighton M',
        email:'brightonM@bakertilly.co.zw',
        telephone:'+263718092534'
      }
    }

    function changeValues(selectElement) {
      var selectedOption = selectElement.options[selectElement.selectedIndex];
      var selectedText = selectedOption.text;
      
      // Use the selectedText as needed
      //document.getElementById("company").value=selectedText
      correspondingObject=data[selectedText]
      for(let key in correspondingObject){
        document.getElementById(key).value=correspondingObject[key]

      }
      
    }

    document.getElementById("upload-img").onclick=(e)=>{
      e.preventDefault()
      let icon=e.target
      document.getElementById("profile-img").click()
    }
  </script>

</body>

</html>