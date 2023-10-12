<?php 
session_start();
if ($_SESSION['username']=="" && $_SESSION['isadmin']==""){
  Header("Location:../index.php");
}  
include "../includes/connection.php";

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Reference Checking System</title>
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
    #print-button{
      position: fixed;
      bottom: 80px;
      right:50px;
      z-index: 1000;
      padding: 15px;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <!--<img src="../assets/img/logo.png" alt="">-->
        <span class="d-none d-lg-block">Reference Checking</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
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
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>New Candidates</h4>
                <p>12 New candidates registered</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Failed email</h4>
                <p>Failed to send email to Simbai @bakertilly</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Failed email</h4>
                <p>Failed to send email to Simbai @bakertilly</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Failed email</h4>
                <p>Failed to send email to Simbai @bakertilly</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <!--<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a>--><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="../assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="../assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="../assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-person-circle"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['username']?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['username']?></h6>
              <span>Admin</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../index.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>

        

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link" href="candidates.php">
          <i class="bi bi-people"></i>
          <span>Candidates </span>
        </a>
      </li> <li class="nav-item">
        <a class="nav-link collapsed" href="add-admin.php">
          <i class="bi bi-person-plus"></i>
          <span>Add Admin</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <!--<li class="nav-item">
        <a class="nav-link collapsed" href="Candidate Reports.html">
          <i class="bi bi-file-earmark-pdf"></i>
          <span>Candidate Reports</span>
        </a>
      </li>--><!-- End Error 404 Page Nav -->

    </ul>

  </aside><!-- End Sidebar--><!-- End Sidebar-->

  <main id="main" class="main">
    <i class="bi bi-file-earmark-pdf bg-primary rounded" id="print-button" data-bs-toggle="tooltip" data-bs-placement="top" title="produce report"></i>
    <a href="Candidate Reports.html" id="link-to-report" style="display: none;"></a>
    <section class="section" id="candidates-table">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">candidates</h5>
              
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Proffession</th>
                    <th scope="col">Phone Number</th>
                    <th class="col">Email</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                
                $sql="SELECT * FROM `candidates` ORDER BY `candidate_id` DESC ";
                $data=mysqli_query($conn,$sql);
                for ( $x=0; $x<$data->num_rows;$x++){
                $row=$data->fetch_assoc();
                echo "  <tr>
                <th scope='col'>".$row['candidate_id']."</th>
                <td>".$row['first_name']." ".$row['last_name']."</td>
                <td>".$row['position']."</td>
                <td>".$row['phone']."</td>
                <td>".$row['email']."</td>
              </tr>";
                
                }
              
                ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
    <!--end profile-->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bakertilly.site/baker-tilly-digital-contact/">bakertilly</a>
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
  <!--<script>
    Array.from(document.getElementsByTagName('tr')).forEach((row)=>{
      row.setAttribute('style','cursor:pointer')
      row.addEventListener('click',()=>{
        let td=row.querySelector('td').nextSibling
        let name=td.innerText
        //alert(name)
        let [card1,card2]=document.getElementById('candidates-profile').getElementsByClassName('card')
        card1.querySelector('h2').innerText=name
        document.getElementById('profile-link').click()
      })
    })

    function redirect(){
      document.getElementById("link-to-report").click()
    }
  </script>-->

  <script>
    
  let references=['bakertilly','econet']
  let paletteIndex=0
  let colorPalette=[
    'rgba(54, 162, 235, 0.8)', // Blue
    'rgba(255, 99, 132, 0.8)', // Red
    'rgba(255, 205, 86, 0.8)', // Yellow
    'rgba(75, 192, 192, 0.8)', // Teal
    'rgba(153, 102, 255, 0.8)', // Purple
    'rgba(255, 159, 64, 0.8)', // Orange
    'rgba(255, 0, 0, 0.8)', // Bright Red
    'rgba(0, 255, 0, 0.8)', // Bright Green
    'rgba(255, 0, 255, 0.8)', // Magenta
    'rgba(0, 255, 255, 0.8)' // Cyan
  ]
  let datasetTemplate={
    label: '',
    data: [],
    fill: true,
    backgroundColor: '',
    borderColor: 'rgb(255, 99, 132)',
    pointBackgroundColor: 'rgb(255, 99, 132)',
    pointBorderColor: '#fff',
    pointHoverBackgroundColor: '#fff',
    pointHoverBorderColor: 'rgb(255, 99, 132)'
  }

  let conclusions={
    suitable:{
      message:'candidate is suitable for hiring',
      alertClass:['alert-danger','alert-success'],
      icon:'bi-check-circle'
    },
    not_suitable:{
      message:'candidate is not suitable for hiring',
      alertClass:['alert-success','alert-danger'],
      icon:'bi-x-circle'
    }
  }
  //data obtained after merging tables
  let relatedData={
    'Brandon Jacob':{
      sentiments:{
        positive:20,
        negative:60,
        neutral:40
      },
      conclusion:'not_suitable',
      analytics:{
        individual_scores:{
          'bakertilly':[65, 59, 90, 81, 56, 55, 40],
          'econet':[65, 59, 90, 81, 56, 55, 40]
        },
        average_scores:[30,30, 30, 30, 30, 30, 30]
      }
    },
    
    'Bridie Kessler':{
      sentiments:{
        positive:75,
        negative:5,
        neutral:20
      },
      conclusion:'suitable',
      analytics:{
        individual_scores:{
          'bakertilly':[65, 59, 90, 81, 56, 55, 40],
          'econet':[100, 100,100,100,200,100, 100]
        },
        average_scores:[100, 100,100,100,200,100, 100]
      }
    },
  }

let setSentiments=(fullname)=>{
    
  let sentiments=relatedData[fullname].sentiments
  let [neutral,positive,negative]=Array.from(document.getElementsByClassName('progress'))
  let neutralProgress=neutral.querySelector('.progress-bar')
  neutralProgress.style.width=`${sentiments.neutral}%`
  neutralProgress.setAttribute('aria-valuenow','10')
  neutralProgress.innerHTML=`${sentiments.neutral}%`

  let positiveProgress=positive.querySelector('.progress-bar')
  positiveProgress.style.width=`${sentiments.positive}%`
  positiveProgress.setAttribute('aria-valuenow','10')
  positiveProgress.innerHTML=`${sentiments.positive}%`

  let negativeProgress=negative.querySelector('.progress-bar')
  negativeProgress.style.width=`${sentiments.negative}%`
  negativeProgress.setAttribute('aria-valuenow','10')
  negativeProgress.innerHTML=`${sentiments.negative}%`
}

let setConclusion=(fullname)=>{
 
  let conclusion=relatedData[fullname].conclusion
  let alert=document.querySelector('.alert')
  let correspondingOutput=conclusions[conclusion]

  let [oldClass,newClass]=correspondingOutput.alertClass
  alert.classList.remove(oldClass)
  alert.classList.add(newClass)
  alert.querySelector('i').classList.add(correspondingOutput.icon)
  alert.querySelector('p').innerText=correspondingOutput.message
}

let displayAttributes=(row)=>{
  let [num,FullName,Role,Phone,Email,img]=Array.from(row.getElementsByTagName('td'))
  let card1=document.getElementById('candidates-profile').querySelector('.col-xl-4').querySelector('.card')
  let card2=document.getElementById('candidates-profile').querySelector('.col-xl-8').querySelector('.card')
  //let [card1,card2]=document.getElementById('candidates-profile').getElementsByClassName('card')
  let [FirstName,LastName]=FullName.innerText.split(' ')
  card1.querySelector('h2').innerText=`${FirstName} ${LastName}`
  card1.querySelector('img').src=img.innerText
  card2.querySelector('.FirstName').innerText=FirstName
  card2.querySelector('.LastName').innerText=LastName
  //card2.querySelector('.Role').innerText=Role.innerText
  card2.querySelector('.Phone').innerText=Phone.innerText
  card2.querySelector('.Email').innerText=Email.innerText
  document.getElementById('profile-link').click()
  let fullname=FullName.innerText
  setSentiments(fullname)
  setConclusion(fullname)
  //resetAverageScores(fullname)
  createChart(fullname)
  createBars(fullname)
}
  //setting first row as default display
displayAttributes(document.querySelector('tbody').querySelector('tr'))

  
Array.from(document.getElementsByTagName('tr')).forEach((row)=>{
  row.style.cursor='pointer'
  let lastAttr=row.lastChild
  lastAttr.previousSibling.classList.add('hidden')
  lastAttr.classList.add('hidden')
  row.addEventListener('click',()=>{
    displayAttributes(row)
  })
  
})
</script>
<script>
  let redirect=()=>{
    document.getElementById('link-to-report').click()
  }
</script>

</body>

</html>