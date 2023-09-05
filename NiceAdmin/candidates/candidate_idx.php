<?php
session.start();
if ($_SESSION['username'] =="" && $_SESSION['isadmin']==""){
  Header("Location:../index.php");
  
}
if($_POST[submit]){
  $company=$_POST['company'];
  $referee=$_POST['referee'];
  $email=$_POST['email'];
  $tele=$_POST['tele'];
  $file=$_POST['file'];
  $pic=$_POST['photo'];
  $email=$_SESSION['username'];
  $sql="INSERT INTO candidates(`image`,`cv`)VALUES('$pic','file')";
  $sql1="INSERT INTO reference(`ref_id`,`candidate_id`,`ref_name`,`position`,`phone`,`email`,`company_name`,`date_sent`)VALUES('$ref_id','$can_id','$referee','$email',)";

}



?>
<!DOCTYPE html>
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
      <a href="index.html" class="logo d-flex align-items-center">
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

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><

        <li class="nav-item dropdown">

        

      </ul>
    </nav><!-- End Icons Navigation -->

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
                <p class="text-center small">Upload your CV and a passport sized photo</p>
              </div>

              <form class="row g-3 needs-validation" novalidate>

                <div class="hidden hidden-controls">
                  <div class="col-12">
                    <label for="company-name" class="form-label">company name</label>
                    <input type="text" name="company" class="form-control" id="company-name">
                  
                  </div>
              
                  <div class="col-12">
                    <label for="referee-name" class="form-label">referee name</label>
                    <input type="text" name="referee" class="form-control" id="referee-name">
                    
                  </div>
              
                  <div class="col-12">
                    <label for="company-email" class="form-label">company email</label>
                    <input type="text" name="email" class="form-control" id="company-email">
                    
                  </div>
              
                  <div class="col-12">
                    <label for="company-telephone" class="form-label">company telephone</label>
                    <input type="text" name="tele" class="form-control" id="company-telephone">
                    
                  </div>
                  
                </div>
            

                <div class="col-12">
                  <label for="yourUsername" class="form-label">CV</label>
                  <div class="input-group has-validation">
                    <input type="file" class="form-control-file" id="fileInput" name="fileInput">
                    <div class="invalid-feedback">Please upload your CV as either word or pdf!</div>
                  </div>
                </div>
                <div class="col-12">
                  <label for="yourPassword" class="form-label">Photo</label><br>
                  <input type="file" class="form-control-file" id="photoInput" name="photoInput">
                  <div class="invalid-feedback">Please upload your photo!</div>
                </div>
                <br>
                <!--<div class="col-12">
                  <button class="btn btn-primary w-10" type="submit">Submit</button>
                </div>-->
                <div class="col-12 submit-col">
                  <a  href="candidate profile view.html" class="btn btn-primary w-10" type="submit">Submit</a>
                </div>
              </form>
            </div> 
          </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->

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
    controls.querySelector('#company-name').value+=` ${companyName}`
    controls.querySelector('#referee-name').value+=` ${refereeName}`
    controls.querySelector('#company-email').value+=` ${companyEmail}`
    controls.querySelector('#company-telephone').value+=` ${companyTelephone}`
  })
   
</script>
</body>

</html>