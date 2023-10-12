<?php
include "../includes/connection.php";
include "../includes/trim.php";

if(isset($_POST["submit"])){
  $prob_solving=input_val($_POST["problem_solving"]);
  $commskills=input_val($_POST["communication_skills"]);
  $time_mangmnt=input_val($_POST["time_management"]);
  $creativity=input_val($_POST["creativity"]);
  $will_to_learn=input_val($_POST["willingness_to_learn"]);
  $teamwork=input_val($_POST["team_work"]);
  $reliability=input_val($_POST["reliability"]);
  $id=000;
  $id2=111;
  $response=input_val($_POST["response"]);
  $col=mysqli_query($conn,"SELECT * FROM `candidates`");
if($col){
  $id3=$col->num_rows;
  $id3++;
}

  $sql="INSERT INTO `scores`(`candidate_id`,`problem_solving`,`comm_skills`,`time_mangmt`,`creativity`,`will_to_learn`,`team_work`,`reliability`,`ref_id`)VALUES('$id','$prob_solving','$commskills','$time_mangmnt','$creativity','$will_to_learn','$teamwork','$reliability','$id2')";
  $results = mysqli_query($conn,$sql);
  $sql1="INSERT INTO`ref_responses`(`ref_id`,`response_id`,`question_id`,`response`)VALUES('$id2','$id3','$id3','$response')";
  $data= mysqli_query($conn,$sql1);
    if($results && $data){
    header("Location:thank_you.php");
  }else{ 
      echo("");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>questionaire</title>
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
    .value{
      display: none;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <div>
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="../assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Reference Checking</span>
      </a>
      
    </div><!-- End Logo -->

      <!--<form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div> --><!-- End Search Bar -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <main id="position" class="position">

    <div class="pagetitle">
      <h1>Questions</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="referee_candidates_list.html">Candidates</a></li>
          <!--<li class="breadcrumb-item">John Doe</li>-->
          
        </ol>
      </nav>
    </div><!-- End Page Title -->
   
    <form action="questionaire.php" method="post" class="container-fluid">
      <div class="card">
        <div class="card-body"><br>
          <div>
            <label for="customRange2" class="form-label">Problem_Solving (<span class="percentage">50</span>%)</label>
            <input type="range" class="form-range" min="0" max="100" id="customRange2">
            <input type="text" name="problem_solving" class='value'>
          </div>
          <br>
          <div>
            <label for="customRange2" class="form-label">Communication_Skills (<span class="percentage">50</span>%)</label>
            <input type="range" class="form-range" min="0" max="100" id="customRange2">
            <input type="text" name="communication_skills" class='value'>
          </div>
          <br>
          <div>
            <label for="customRange2" class="form-label">Time_Management (<span class="percentage">50</span>%)</label>
            <input type="range" class="form-range" min="0" max="100" id="customRange2">
            <input type="text" name="time_management" class='value'>
          </div>
          <br>
          <div>
            <label for="customRange2" class="form-label">Creativity (<span class="percentage">50</span>%)</label>
            <input type="range" class="form-range" min="0" max="100" id="customRange2">
            <input type="text" name="creativity" class='value'>
          </div>
          <br>
          <div>
            <label for="customRange2" class="form-label">Willingness_to_Learn (<span class="percentage">50</span>%)</label>
            <input type="range" class="form-range" min="0" max="100" id="customRange2">
            <input type="text" name="willingness_to_learn" class='value'>
          </div>
          <br>
          <div>
            <label for="customRange2" class="form-label">Team_Work (<span class="percentage">50</span>%)</label>
            <input type="range" class="form-range" min="0" max="100" id="customRange2">
            <input type="text" name="team_work" class='value'>
          </div>
          <br>
          <div>
            <label for="customRange2" class="form-label">Reliability (<span class="percentage">50</span>%)</label>
            <input type="range" class="form-range" min="0" max="100" id="customRange2">
            <input type="text" name="reliability" class='value'>
          </div>
        </div>
      </div>
      <div class="accordion w-80" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              1. Describe the candidate's work ethics in terms of their social stamina, commitment to deadlines and time consciousness.
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <textarea class="form-control" name="response" id="exampleTextarea" rows="5"></textarea>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              2. Give your assertion on the candidate's reaction towards a tight schedule or a call to achieve a difficult goal.
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <textarea class="form-control"  name="response" id="exampleTextarea" rows="5"></textarea>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              3. How well is the candidate poised infront of an audience and how good is their self-expression?
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <textarea class="form-control" name="response" id="exampleTextarea" rows="5"></textarea>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              4. How well could the candidate perform given a role in the IT departement?
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <textarea class="form-control" name="response" id="exampleTextarea" rows="5"></textarea>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingFive">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
              5. Give an outline of the candidate's character and your relationship with them 
            </button>
          </h2>
          <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <textarea class="form-control" name="response" id="exampleTextarea" rows="5"></textarea>
            </div>
          </div>
          <br>
          <div class="col-md-12 text-center">
            <button class="btn btn-primary w-75" name="submit" type="submit">Submit</button>
          </div>
          <br>
        </div>
      </div>
    </form>
    
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  

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
    Array.from(document.getElementsByClassName("form-range")).forEach((range)=>{
      range.addEventListener('change',()=>{
        let parent=range.parentElement
        let value=range.value
        parent.querySelector(".percentage").innerHTML=value
        let label=parent.querySelector('label').innerText
        parent.querySelector('.value').value=value
      })

    })
  </script>

</body>

</html>