<?php
  include_once "../Controller/reclamationC.php";
  include_once "../Model/reclamation.php";


  function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'reclamation';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
$msg = '';
$pdo = pdo_connect_mysql();
// Check if the reclamation id exists, for example update.php?id=1 will get the reclamation with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
      //  $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $role = isset($_POST['role']) ? $_POST['role'] : '';
        $created = isset($_POST['created']) ? $_POST['created'] : '';
     
        // Update the record
        $stmt = $pdo->prepare('UPDATE reclamation SET  titre = ?, description = ?, role = ?, created = ?, description = ? WHERE id = ?');
        $stmt->execute([ $titre, $description, $role, $created, $description, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the reclamation from the reclamations table
 $stmt = $pdo->prepare('SELECT * FROM reclamation WHERE id = ?');
   $stmt->execute([$_GET['id']]);
  $reclamation = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$reclamation) {
       exit('reclamation doesn\'t exist with that id!');
    }
} 
else {
    exit('No id specified!');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Now UI Kit by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/now-ui-kit.css?v=1.3.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="index-page sidebar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="https://demos.creative-tim.com/now-ui-kit/index.html" rel="tooltip" title="Designed by Invision. Coded by Creative Tim" data-placement="bottom" target="_blank">
          Now Ui Kit
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar top-bar"></span>
          <span class="navbar-toggler-bar middle-bar"></span>
          <span class="navbar-toggler-bar bottom-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="./assets/img/blurred-image-1.jpg">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="scrollToDownload()">
              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
              <p>Download</p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown">
              <i class="now-ui-icons design_app"></i>
              <p>Role</p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
              <a class="dropdown-item" href="indexGest.php">
                <i class="now-ui-icons business_chart-pie-36"></i> Gest
              </a>
            
            </div>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
              <a class="dropdown-item" href="index.php">
                <i class="now-ui-icons business_chart-pie-36"></i> Host
              </a>
            
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-neutral" href="https://www.creative-tim.com/product/now-ui-kit-pro" target="_blank">
              <i class="now-ui-icons arrows-1_share-66"></i>
              <p>Upgrade to PRO</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank">
              <i class="fab fa-twitter"></i>
              <p class="d-lg-none d-xl-none">Twitter</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank">
              <i class="fab fa-facebook-square"></i>
              <p class="d-lg-none d-xl-none">Facebook</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank">
              <i class="fab fa-instagram"></i>
              <p class="d-lg-none d-xl-none">Instagram</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper">
    <div class="page-header clear-filter" filter-color="orange">
      <div class="page-header-image" data-parallax="true" style="background-image:url('./assets/img/header.jpg');">
      </div>
      <div class="container">
        <div class="content-center brand">
          <img class="n-logo" src="./assets/img/now-logo.png" alt="">
          <h1 class="h1-seo">Now UI Kit.</h1>
          <h3>A beautiful Bootstrap 4 UI kit. Yours free.</h3>
        </div>
        <h6 class="category category-absolute">Designed by
          <a href="http://invisionapp.com/" target="_blank">
            <img src="./assets/img/invision-white-slim.png" class="invision-logo" />
          </a>. Coded by
          <a href="https://www.creative-tim.com" target="_blank">
            <img src="./assets/img/creative-tim-white-slim2.png" class="creative-tim-logo" />
          </a>.</h6>
      </div>
    </div>
    
      <div class="section section-basic" id="basic-elements">
        <div class="container">
          <h3 class="title">Basic Elements</h3>
          <div id="inputs">
      
            <p class="category">Creer Reclamation</p>

       
     
       
    
        <form action="modifier_reclamationHost.php?id=<?=$reclamation['id']?>" method="post">
        <div class="table-responsive table--no-card m-b-30">
        <tr>
            <td>Name</td>
            <td><input type='text' name='titre' value ="<?php echo $reclamation['titre'];?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>description</td>
            <td><input type='text' name='description'  value ="<?php echo $reclamation['description'];?>" class='form-control' /></td>
        </tr>
        
        <tr>
            <td>role</td>
            <td><input type='text' name='role'  value ="<?php echo $reclamation['role'];?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>created</td>
            <td><input type='text' name='created'value ="<?php echo $reclamation['created'];?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>description</td>
            <td><input type='text' name='description'value ="<?php echo $reclamation['description'];?>" class='form-control' /></td>
        </tr>
     
       
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>
<?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>

      <?php
  
  ?>
    </div>
    <!-- Sart Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>
            <h4 class="title title-up">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default">Nice Button</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!--  End Modal -->
    <!-- Mini Modal -->
    <div class="modal fade modal-mini modal-primary" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <div class="modal-profile">
              <i class="now-ui-icons users_circle-08"></i>
            </div>
          </div>
          <div class="modal-body">
            <p>Always have an access to your profile</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-link btn-neutral">Back</button>
            <button type="button" class="btn btn-link btn-neutral" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!--  End Modal -->
    <footer class="footer" data-background-color="black">
      <div class=" container ">
        <nav>
          <ul>
            <li>
              <a href="https://www.creative-tim.com">
                Creative Tim
              </a>
            </li>
            <li>
              <a href="http://presentation.creative-tim.com">
                About Us
              </a>
            </li>
            <li>
              <a href="http://blog.creative-tim.com">
                Blog
              </a>
            </li>
          </ul>
        </nav>
        <div class="copyright" id="copyright">
          &copy;
          <script>
            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
          </script>, Designed by
          <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by
          <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="./assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="./assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/now-ui-kit.js?v=1.3.0" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      // the body of this function is in assets/js/now-ui-kit.js
      nowuiKit.initSliders();
    });

    function scrollToDownload() {

      if ($('.section-download').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-download').offset().top
        }, 1000);
      }
    }
  </script>
</body>

</html>