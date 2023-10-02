<?php
if (isset($_SESSION['zoool']) && isset( $useridshow)) { ?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!------ Include the above in your HEAD tag ---------->


  

  <link rel="stylesheet" href="css/profile.css">
  <style>
  .cover{
    padding: 75px 0;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
  }
  </style>
<body dir="rtl" class="profile-page sidebar-collapse">
  <!-- Navbar -->
  <div class="wrapper">
    <div class="page-header clear-filter" filter-color="orange">
        <div class="cover">
              <div class="page-header-image " data-parallax="true" style="background-image:url('<?php echo $userprofile['_cover'] != '' ? 'media/img/users/profile/'.$userprofile['_cover'] : 'media/img/users/profile/cover.jpg'   ?>');">
  
    </div>
      </div>
      <div class="container">
      <div class="photo-container">
            <img src="<?php
                      if ($userprofile['_img'] != '') {
                        echo 'media/img/users/profile/'.$userprofile['_img'];
                      } else {
                        if ($usershow['_sex'] == 'male') {
                          echo 'media/img/users/profile/male.png';
                        } else {
                          echo 'media/img/users/profile/female.png';
                        }
                      }
                      ?>
          " alt="profile" style="height: 100%;">
          </div>
        <h3 class="title"><?php echo $usershow['_name'];?></h3>
        <p class="category"><?php echo $usershow['_username'];
                              if ($usershow['_verified'] == 'yes') { ?>

              <i class="fa fa-check" aria-hidden="true" style="color: #9a3bff" title="<?php echo lang('حـسـاب مـوثـق', 'Certified account') ?>"></i>
            <?php                 }                 ?>
          </p>       
           <!-- <div class="content">
          <div class="social-description">
            <h2>26</h2>
            <p>Comments</p>
          </div>
          <div class="social-description">
            <h2>26</h2>
            <p>Comments</p>
          </div>
          <div class="social-description">
            <h2>48</h2>
            <p>Bookmarks</p>
          </div>
        </div> -->
                  <!-- ****************************************************معلومات الجامعة*********************************************************** -->
                  <div class="content">
            <div class="social-description">
              <p><?php echo lang($usershow['_aruniversity'], $usershow['_enuniversity']) ?></p>
            </div>
            <div class="social-description">
              <p><?php echo lang($usershow['_arcollege'], $usershow['_encollege']) ?></p>
            </div>
            <div class="social-description">
              <p><?php echo lang($usershow['_arsection'], $usershow['_ensection']) ?></p>
            </div>
            <div class="social-description">
              <p><?php echo $usershow['_batch']; ?></p>
            </div>
          </div>
      </div>
    </div>
    <div class="section divtheam">
      <div class="container">
        <div class="button-container">
          <a href="#button" class="btn btn-primary btn-round btn-lg">Follow</a>
   
        </div>
        <h3 class="title"><?php echo lang('نـبـذة', 'About') ?></h3>
          <h5 class="description">
            <?php
            if ($userprofile['_About'] != '') {
              echo $userprofile['_About'];
            } else {
              echo lang('لا توجد', 'No Information');
            }

            ?>
          </h5>
        </div>
    </div>
    <!-- **********************************************footer********************************************************** -->
    <footer class="footer footer-default">
      <div class="container">
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
            <p>Made with <a href="https://demos.creative-tim.com/now-ui-kit/index.html" target="_blank">Now UI Kit</a> by Creative Tim</p>
        </div>
      </div>
    </footer>
</div>
  <script src="js/profile.js"></script>


</body>

</html>

<?php
}
?>