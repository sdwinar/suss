<?php
if (isset($_SESSION['zoool']) && $_SESSION['zoool'] == $userinfo['_id']) { ?>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <!------ Include the above in your HEAD tag ---------->




  <link rel="stylesheet" href="css/profile.css">
  <style>
    .cover {
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

  <body dir="<?php echo lang('rtl', 'ltr') ?>" class="profile-page sidebar-collapse">
    <!-- Navbar -->
    <div class="wrapper">
      <div class="page-header clear-filter" filter-color="orange">
        <div class="cover">
          <div class="page-header-image " data-parallax="true" style="background-image:url('<?php echo $myprofileinfo['_cover'] != '' ? 'media/img/users/profile/' . $myprofileinfo['_cover'] : 'media/img/users/profile/cover.jpg'   ?>');">
          </div>
        </div>
        <div class="container">
          <div class="photo-container">
            <img src="<?php
                      if ($myprofileinfo['_img'] != '') {
                        echo 'media/img/users/profile/' . $myprofileinfo['_img'];
                      } else {
                        if ($userinfo['_sex'] == 'male') {
                          echo 'media/img/users/profile/male.png';
                        } else {
                          echo 'media/img/users/profile/female.png';
                        }
                      }
                      ?>
          " alt="profile" style="height: 100%;">
          </div>
          <h3 class="title"><?php echo $userinfo['_name']; ?></h3>
          <p class="category"><?php echo $userinfo['_username'];
                              if ($userinfo['_verified'] == 'yes') { ?>

              <i class="fa fa-check" aria-hidden="true" style="color: #9a3bff" title="<?php echo lang('حـسـاب مـوثـق', 'Certified account') ?>"></i>
            <?php                 } else { ?>
              <span class="badge badge-success" style="cursor: pointer" data-toggle="modal" data-target="#req_vit"><?php echo lang(' طلب توثيق الحساب', 'Account verification request') ?></span>

            <?php } ?>


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
              <p><?php echo lang($userinfo['_aruniversity'], $userinfo['_enuniversity']) ?></p>
            </div>
            <div class="social-description">
              <p><?php echo lang($userinfo['_arcollege'], $userinfo['_encollege']) ?></p>
            </div>
            <div class="social-description">
              <p><?php echo lang($userinfo['_arsection'], $userinfo['_ensection']) ?></p>
            </div>
            <div class="social-description">
              <p><?php echo $userinfo['_batch']; ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="section divtheam">
        <div class="container">
          <div class="button-container">
            <a href="users?o=editdata" class="btn btn-primary btn-round btn-lg"><?php echo lang('تـعـديـل الـبـيـانـات', 'Edit data') ?></a>

          </div>
          <h3 class="title"><?php echo lang('نـبـذة عـنــي', 'About me') ?></h3>
          <h5 class="description">
            <?php
            if ($myprofileinfo['_About'] != '') {
              echo $myprofileinfo['_About'];
            } else {
              echo lang('هنا تظهر نبذة عنك', 'Information about you appears here');
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
            <p>Made with <a href="https://demos.creative-tim.com/now-ui-kit/index.html" target="_blank">Now UI
                Kit</a> by Creative Tim</p>
          </div>
        </div>
      </footer>
    </div>
    <!-- Button trigger modal  مودل توثيق الحساب-->


    <!-- Modal -->
    <div class="modal fade" id="req_vit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">
              <?php echo lang(' طلب توثيق الحساب', 'Account verification request') . ' '
                . lang($userinfo['_adjective'] == 'studant' ? ' ( طـالب )' : '( استاذ )', $userinfo['_adjective'] == 'studant' ? 'of studant' : 'of Teacher ') ?>
            </h5>
            <button <?php echo lang('style="left: 0px !important; position: absolute;"', '') ?> type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="reqverform" action="models/users/02reqver" method="post" enctype="multipart/form-data">
              <div class="text-center">
                <?php
                if ($contstmtreq_ver > 0) {
                  if ($req_verinfo['_numofsend'] != '') { ?>
                    <hr />
                    <span class="badge badge-danger"><?php echo lang(
                                                        'عدد المحاولات' . ' ' . $req_verinfo['_numofsend'] . '/5',
                                                        'عدد المحاولات المتبقية' . $req_verinfo['_numofsend'] . '/5'
                                                      ) ?></span>
                    <hr />


                  <?php
                  }
                  if ($req_verinfo['_adminmasage'] != '') { ?>
                    <span class="badge badge-info"><?php echo lang(
                                                      'رسالة المشرف' . ' =>' . $req_verinfo['_adminmasage'],
                                                      'Admin Message' . ' =>' . $req_verinfo['_adminmasage']
                                                    ) ?></span>
                    <hr />


                <?php
                  }
                }
                ?>
                <span class="badge badge-success"><?php echo lang(
                                                    'الرجاء إرسال صورة واضحة من الواجهتين الامامية والخلفية من بطاقة الجامعة',
                                                    'Please send a clear picture of the front and back of the university card'
                                                  ) ?></span>
                <hr />
                <label style="cursor: pointer;    font-size: 14px;    padding: 5px;" class="badge badge-info" for="frontimg"><i class="fa fa-image"></i><?php echo lang(
                                                                                                                                                          'إختيار صورة الواجهة الامامية',
                                                                                                                                                          'Choose the front-end image'
                                                                                                                                                        ) ?></label>
                <label style="cursor: pointer;    font-size: 14px;    padding: 5px;" class="badge badge-info" for="backimg"><i class="fa fa-image"></i><?php echo lang(
                                                                                                                                                          'إختيار صورة الواجهة الخلفية',
                                                                                                                                                          'Choose the back-end image'
                                                                                                                                                        ) ?></label>
                <hr>

                <span class="badge badge-success" id="frontval" style="display: none"><?php echo lang(
                                                                                        'تم تحديد صورة الواجهة الامامية',
                                                                                        'The front face image has been selected'
                                                                                      ) ?></span>
                <span class="badge badge-success" id="backval" style="display: none"><?php echo lang(
                                                                                        'تم تحديد صورة الواجهة الخلفية',
                                                                                        'The back face image has been selected'
                                                                                      ) ?></span>

                <span class="badge badge-success" id="frontspan"></span>
                <span class="badge badge-success" id="backspan"></span>

                <input type="file" name="frontimg" id="frontimg" style="display: none">
                <input type="file" name="backimg" id="backimg" style="display: none">
              </div>
              <div class="text-center" id="reqverrusalt"></div>
              <div class="modal-footer">
                <button name="reqsend" type="submit" class="btn btn-primary" style="width: 100%"><?php
                                                                                                  echo lang('إرســـال', 'S E N D')
                                                                                                  ?></button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
    <script src="js/profile.js"></script>


  </body>

  </html>

<?php
}
?>