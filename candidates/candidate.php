<?php
session_start();
include "../includes/connection.php";
include "../includes/trim.php";



if($_POST){
  $company=explode(";",input_val($_POST["company-name"]));
  $referee=explode(" ",input_val($_POST["referee-name"]));
  $email1=explode(" ",input_val($_POST["company-email"]));
  $tele=explode(" ",input_val($_POST["company-telephone"]));       
  $email=$_SESSION["username"];
  $cv=$_FILES["fileInput"];
  $pic=$_FILES["photoInput"];
  $cvname=$cv["name"];
  $picname=$pic["name"];
  
  $ref_id=mysqli_query($conn,"SELECT * FROM reference")->num_rows;
  $qry="SELECT * FROM `candidates` WHERE `email`='$email'";
  $results=mysqli_fetch_assoc(mysqli_query($conn,$qry));
  $id=$results["candidate_id"];
  $type=explode(".",$picname);
  
  $types=explode(".",$cvname);
  if(move_uploaded_file($cv["tmp_name"],"../uploads/cvs/".$id.'.'.$types[1]) &&  move_uploaded_file($pic["tmp_name"],"../uploads/pics/".$id.'.'.$type[1])){
    $image="../uploads/pics/".$id.'.'."$types[1]";
    $cv="../uploads/cvs/".$id.'.'."$types[1]";
  $date=date('Y-m-d-H-i-s');
  $count=count($company);
  $num=$count-1;
  $magic=0;
  
  $updatecand="UPDATE `candidates` SET `cv`='$cv' AND `image`='$image' WHERE `email`='$email' ";
  $query=mysqli_query($conn,$updatecand);
  
  if($count==1){
    $ref_id++;
    $sql1="INSERT INTO `reference`(`ref_id`,`candidate_id`,`ref_name`,`phone`,`email`,`company_name`,`date_sent`)VALUES('$ref_id','$id','$referee[0]','$tele[0]','$email1[0]','$company[0]','$date')";
    $res=mysqli_query($conn,$sql1);
  }
  else{
    
    while($magic < $count-1){
      $ref_id++;
  $sql1="INSERT INTO `reference`(`ref_id`,`candidate_id`,`ref_name`,`phone`,`email`,`company_name`,`date_sent`)VALUES('$ref_id','$id','$referee[$magic]','$tele[$magic]','$email1[$magic]','$company[$magic]','$date')";

$res=mysqli_query($conn,$sql1);
      if($res){
        $magic++;
      }
      else{
        echo "<div class='alert alert-danger text-center'><strong>Error : Failed to upload data</strong></div>";
      }

  }
    header("Location:candview.php");
}
}else {
  echo "<div class='alert alert-danger text-center'><strong>Error : Failed to upload files</strong></div>";
}
 
}



?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Components / Accordion - NiceAdmin Bootstrap Template</title>
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
  

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    .hidden{
      display: none;
    }
  </style>
</head>

<body style="padding-top:50px;">

  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="../index.php" class="logo d-flex align-items-center">
        <img src="../assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Reference Checking</span>
      </a>
      <!--<i class="bi bi-list toggle-sidebar-btn"></i>-->
    </div><!-- End Logo -->

    <!--<div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>--><!-- End Search Bar -->

  

  </header><!-- End Header -->

  <!-- ======= Header ======= -->
  <main id="main" class="main" style="margin: 0;">

    <div class="pagetitle">
      <!--<h1>Enter References</h1>-->

    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          

          <div class="card mb-3">
            <div class="card-body">
              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">References</h5>
                <!--<p class="text-center small">References</p>-->
              </div>

              <form class="row g-3 needs-validation reference-data" novalidate>

                <hr id="seperator">
                
                <div class="col-12">
                  <a href="referee_details.html" class="btn btn-primary add-ref">Add referee</a>
                </div>
              </form>
            </div>
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
          <div class="card mb-3">
            <div class="card-body">
              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Candidate Documents </h5>
               
              </div>

              <form class="row g-3 needs-validation" novalidate method="post" action="cand.php" enctype="multipart/form-data">

                <div class="hidden hidden-controls">
                  <div class="col-12">
                    <label for="company-name" class="form-label">company name</label>
                    <input type="text" name="company-name" class="form-control" id="company-name">
                  
                  </div>
              
                  <div class="col-12">
                    <label for="referee-name" class="form-label">referee name</label>
                    <input type="text" name="referee-name" class="form-control" id="referee-name">
                    
                  </div>
              
                  <div class="col-12">
                    <label for="company-email" class="form-label">company email</label>
                    <input type="text" name="company-email" class="form-control" id="company-email">
                    
                  </div>
              
                  <div class="col-12">
                    <label for="company-telephone" class="form-label">company telephone</label>
                    <input type="text" name="company-telephone" class="form-control" id="company-telephone">
                    
                  </div>
                  
                </div>
            

                <div class="col-12">
                  <label for="yourUsername" class="form-label">CV</label>
                  <div class="input-group has-validation">
                    <input type="file" class="form-control" id="fileInput" accept=".doc,.docx,.pdf"/>
                    <div class="invalid-feedback">Please upload your CV as either word or pdf!</div>
                  </div>
                </div>
                <div class="col-12">
                  <label for="yourPassword" class="form-label">Photo</label><br>
                  <input type="file" class="form-control" id="photoInput" name="photoInput"/>
                  <div class="invalid-feedback">Please upload your photo!</div>
                </div>
                <br>
                <div class="col-12">
                  <label for="occurance" class="form-label">Transcripts</label>
                  <select name="" id="occurance" class="form-select" aria-label="Default select example">
                    <option selected value="0">Select Highest Level of Achievement</option>
                    <option value="1">O Level</option>
                    <option value="2">A Level</option>
                    <option value="3">Bachelors</option>
                    <option value="4">Masters</option>
                   
                  </select>
                </div>
              
                <br>
                <div class="col-12 submit-col">
                  <button class="btn btn-primary w-10" type="submit" name="submit">Submit</button>
                </div>
                
              <!--  <div class="col-12 submit-col">
                  <a  href="candidate profile view.html" class="btn btn-primary w-10" type="submit">Submit</a>
                </div>-->
              </form>
                 
            </div> 
          </div>
        </div>
      </div> 

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer" style="margin:auto">
    <div class="copyright">
    <a href="https://bakertilly.site"> &copy; Copyright <strong><span>bakertilly</span></strong>. All Rights Reserved</a>
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Modal -->
  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Results </h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
          <form class="needs-validation" novalidate>
            <div class="col-12">
              <label for="yourUsername" class="form-label">Upload O Level certificate</label>
              <div class="input-group has-validation">
                <input type="file" class="form-control" id="Olevelresults" accept=".doc,.docx,.pdf"/>
                <div class="invalid-feedback">Please upload your O level certificate</div>
              </div>
            </div>
          </form> 
        </div>
        <br>
        <div class="modal-footer">
          <a href="cand.php" class="btn btn-outline-secondary">Close</a>
          <button type="button" class="btn btn-outline-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Results</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
          <form class="needs-validation" method="post" action="candidate.php">
            <div class="col-12">
              <label for="olevelResults" class="form-label">Upload O Level certificate</label>
              <div class="input-group has-validation">
                <input type="file" class="form-control" id="Olevelresults" name="Olevel" accept=".doc,.docx,.pdf"/>
                <div class="invalid-feedback">Please upload your O level certificate</div>
              </div>
            </div>
            <br>
            <div class="col-12">
              <label for="alevelResults" class="form-label">Upload A Level certificate</label>
              <div class="input-group has-validation">
                <input type="file" class="form-control" id="Alevelresults" name="Alevel" accept=".doc,.docx,.pdf"/>
                <div class="invalid-feedback">Please upload your A level certificate</div>
              </div>
            </div>
          </form> 
        </div>
        <br>
        <div class="modal-footer">
          <a href="cand.php" class="btn btn-outline-secondary">Close</a>
          <button type="button" class="btn btn-outline-primary" name="levels">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Results</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
          <form class="needs-validation" novalidate>
            <div class="col-12">
              <label for="olevelResults" class="form-label">Upload O Level certificate</label>
              <div class="input-group has-validation">
                <input type="file" class="form-control" id="Olevelresults" name="O level" accept=".doc,.docx,.pdf"/>
                <div class="invalid-feedback">Please upload your O level certificate</div>
              </div>
            </div>
            <br>
            <div class="col-12">
              <label for="alevelResults" class="form-label">Upload A Level certificate</label>
              <div class="input-group has-validation">
                <input type="file" class="form-control" id="Alevelresults" name="Alevel" accept=".doc,.docx,.pdf"/>
                <div class="invalid-feedback">Please upload your A level certificate</div>
              </div>
            </div>
            <br>
            <div class="col-12">
              <label for="bachelors" class="form-label">Upload Bachelors certificate</label>
              <div class="input-group has-validation">
                <input type="file" class="form-control" id="bachelorscert" accept=".doc,.docx,.pdf"/>
                <div class="invalid-feedback">Please upload your Bachelors certificate</div>
              </div>
            </div>
          </form>
        </div>
        <br>
        <div class="modal-footer">
          <a href="cand.php" class="btn btn-outline-secondary">Close</a>
          <button type="button" class="btn btn-outline-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Results</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
          <form class="needs-validation" novalidate>
            <div class="col-12">
              <label for="olevelResults" class="form-label">Upload O Level certificate</label>
              <div class="input-group has-validation">
                <input type="file" class="form-control" id="Olevelresults" accept=".doc,.docx,.pdf"/>
                <div class="invalid-feedback">Please upload your O level certificate</div>
              </div>
            </div>
            <br>
            <div class="col-12">
              <label for="alevelResults" class="form-label">Upload A Level certificate</label>
              <div class="input-group has-validation">
                <input type="file" class="form-control" id="Alevelresults" accept=".doc,.docx,.pdf"/>
                <div class="invalid-feedback">Please upload your A level certificate</div>
              </div>
            </div>
            <br>
            <div class="col-12">
              <label for="bachelors" class="form-label">Upload Bachelors certificate</label>
              <div class="input-group has-validation">
                <input type="file" class="form-control" id="bachelorscert" accept=".doc,.docx,.pdf"/>
                <div class="invalid-feedback">Please upload your Bachelors certificate</div>
              </div>
            </div>
            <br>
            <div class="col-12">
              <label for="masters" class="form-label">Upload Masters certificate</label>
              <div class="input-group has-validation">
                <input type="file" class="form-control" id="mastersscert" accept=".doc,.docx,.pdf"/>
                <div class="invalid-feedback">Please upload your Masters certificate</div>
              </div>
            </div>
          </form>
        </div>
        <br>
        <div class="modal-footer">
          <a href="cand.php" class="btn btn-outline-secondary">Close</a>
          <button type="button" class="btn btn-outline-primary">submit</button>
        </div>
      </div>
    </div>
  </div>
  

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
    //return a bootstrap modal instance
    let modal_1 = bootstrap.Modal.getOrCreateInstance(document.getElementById('modal1'))
    let modal_2 = bootstrap.Modal.getOrCreateInstance(document.getElementById('modal2'))
    let modal_3 = bootstrap.Modal.getOrCreateInstance(document.getElementById('modal3'))
    let modal_4 = bootstrap.Modal.getOrCreateInstance(document.getElementById('modal4'))
   

    var select_occurance = document.getElementById("occurance");
    select_occurance.addEventListener("change", function(e){
      var choose_data = e.target.value;
      switch(choose_data) {
        case "1":
          modal_1.show();
          break;
        case "2": 
          modal_2.show();
          break;
        case "3":
          modal_3.show();
          break;
        case "4":
          modal_4.show();
          
        
      }
    } );
   
  </script>
<script>
  let template=`    <div>
      <div class="col-12">
        <label for="company-name" class="form-label">company name</label>
        <input type="text" name="company-name" class="form-control" id="company-name">
      
      </div>
  
      <div class="col-12">
        <label for="referee-name" class="form-label">referee name</label>
        <input type="text" name="referee-name" class="form-control" id="referee-name">
        
      </div>
  
      <div class="col-12">
        <label for="company-email" class="form-label">company email</label>
        <input type="text" name="company-email" class="form-control" id="company-email">
        
      </div>
  
      <div class="col-12">
        <label for="company-telephone" class="form-label">company telephone</label>
        <input type="text" name="company-telephone" class="form-control" id="company-telephone">
        
      </div>
      <br>
      <div class="col-12">
        <button class="btn btn-success w-10 add-comp" type="submit">Add</button>
      </div>
  </div>`

  let createElement=(template)=>{
    let temp=document.createElement('div')
    temp.innerHTML=template
    let element=temp.lastChild
    console.log(element)
    return element
}
let inputFields;
let gParent;
let btnParent;
  document.querySelector('.add-ref').onclick=((e)=>{
    e.preventDefault()
    let btn=e.target
    btnParent=btn.parentElement
    gParent=btnParent.parentElement
    inputFields=createElement(template)
    gParent.insertBefore(inputFields,btnParent)
    document.querySelector('.submit-col').classList.add('hidden')
    btnParent.classList.add('hidden')
  })

  document.querySelector('.reference-data').addEventListener('submit',(e)=>{
    e.preventDefault()
    let form=e.target
    let companyName=form['company-name'].value
    let refereeName=form['referee-name'].value
    let companyEmail=form['company-email'].value
    let companyTelephone=form['company-telephone'].value
    let compTemplate=`<div class="col-12">
                <input class="form-control" type="text" placeholder="${companyName}" aria-label="Disabled input example" disabled>
                
              </div>`
    let referee=createElement(compTemplate)
    let seperator=document.getElementById("seperator")
    seperator.parentElement.insertBefore(referee,seperator)
    form.reset()
    inputFields.remove()
    document.querySelector('.submit-col').classList.remove('hidden')
    btnParent.classList.remove('hidden')
    let [form1,submitForm]=Array.from(document.getElementsByTagName('form'))
    let controls=submitForm.querySelector('.hidden-controls')
    controls.querySelector('#company-name').value+=`${companyName};`
    controls.querySelector('#referee-name').value+=` ${refereeName}`
    controls.querySelector('#company-email').value+=` ${companyEmail}`
    controls.querySelector('#company-telephone').value+=` ${companyTelephone}`
  })
  
  $(document).read
</script>
</body>

</html>