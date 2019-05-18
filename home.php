<!DOCTYPE html>

<?php
session_start();
if($_SESSION['username'] == null)
{
        header ('location: IRS_Login.php');
        exit;
}
?>

<?php
      include("connects.php");
      $exam_number = $_POST['exam_number'];


      $sql = "SELECT * FROM `ExamList` WHERE `No`='$exam_number'";
      $result = mysqli_fetch_object($db->query($sql));
      $q_list = array();
      $temp_string = $result->question_list;
      $q_list = mb_split(",",$temp_string);
      //print_r($q_list);

      $sql = "SELECT * FROM Now_state";
      $result = mysqli_fetch_object($db->query($sql));
      $exam_index = $result->No;
      $question_number = $result->No;
      

      $q_list_number = sizeof($q_list);
      $q_list_number = $question_number+1;
      for ($i = $question_number; $i>0 ; $i--)
      {
        $q_list[$i] = $q_list[$i-1];
      }
      if($exam_index==0)
        {
          //$exam_index=1;
          $sql = "UPDATE Now_state SET No =1";
          $db->query($sql);
        }
      if($question_number==0)$question_number=1;
      //echo $exam_index;*/
      $db->close();

?>

<html lang="en">
          <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <!-- Meta, title, CSS, favicons, etc. -->
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        	<link rel="icon" href="images/favicon.ico" type="image/ico" />

            <title>Chen's IRS | </title>

            <!-- Bootstrap -->
            <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
            <!-- Font Awesome -->
            <link href="../vendors/font-awesome/css/fontawesome-all.css" rel="stylesheet">
            <!-- Font Awesome -->
            <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
            <!-- NProgress -->
            <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
            <!-- iCheck -->
            <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
            <!-- bootstrap-progressbar -->
            <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
            <!-- JQVMap -->
            <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
            <!-- bootstrap-daterangepicker -->
            <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

            <!-- Custom Theme Style -->
            <link href="../build/css/custom.min.css" rel="stylesheet">
          </head>




  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="" class="site_title"><i class="fas fa-book"></i> <span>Chen's IRS</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <!-- img src="images/img.jpg" alt="..." class="img-circle profile_img"-->
              </div>
              <div class="profile_info">
                <span>Welcome,NCYU</span>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <!--li><a href="home.php"><i class="fas fa-pencil-alt fa-2x" ></i> 考試 </a></li-->
                  <li><a href="MakeQuestion.php"><i class="fas fa-edit fa-2x" aria-hidden="true"></i> 出題 </a></li>
                  <li><a href="QuestionList.php"><i class="fas fa-book fa-2x" aria-hidden="true"></i> 題庫 </a></li>
                  <li><a href="ExamList.php"><i class="fas fa-list-ol fa-2x" aria-hidden="true"></i> 測驗卷 </a></li>
                  <li><a href="ExamHistory.php"><i class="fas fa-list-ol fa-2x" aria-hidden="true"></i> 考試紀錄 </a></li>
                  <li><a href="logout.php"><i class="fas fa-arrow-alt-circle-left fa-2x" aria-hidden="true"></i> 登出 </a></li>
                </ul>


              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->

            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content################################# -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <!--div class="row tile_count">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fas fa-edit"></i></div>
                  <div class="count">
                  <?php
                  echo $question_number;
                  ?>
                  </div>
                  <h3>Question</h3>
                </div>
            </div>

            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="far fa-calendar-alt"></i></div>
                  <div class="count">
                    <?php
                    date_default_timezone_set("Asia/Taipei");
                    $date = date('Y/m/d');
                    echo $date;  
                    ?>
                  </div>
                  <h3>Date</h3>
                </div>
            </div>

            <script>
              function updateDiv()
              { 
                $( "#time_block" ).load(window.location.href + " #time_block" );
              }
              setInterval(updateDiv,1000);
            </script>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fas fa-clock"></i></div>
                  <div class="count" id="time_block">
                  <?php
                  $time = date('H:i:s');
                  echo $time;  
                  ?>
                  </div>
                  <h3>Time</h3>
                </div>
            </div>

            

            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fas fa-user-edit"></i></div>
                  <div class="count">
                  5
                  </div>
                  <h3>Students</h3>
                </div>
            </div>

          </div-->
          <!-- /top tiles -->
            
            <!-- Question -->
            <div class="x_panel">
                <!-- title bar-->
                <div class="x_title">
                  <h1>
                      <b>題目</b>
                      <!--button type="button" id="zeroquiz" class="btn btn-success btn-lg" style="float: right;">歸零(test)</button-->
                      <button type="button" class="btn btn-success btn-lg" onClick = "timedMsg()" style="float: right;">5秒換題</button>
                      <button type="button" id="nextquiz" class="btn btn-success btn-lg" style="float: right;">換題</button>
                  </h1>

                  <div class="clearfix"></div>
                </div>
                <!-- title bar-->


                <!-- style for img-->
                <style>
                .responsive {
                  width: 100%;
                  max-width: 650px;
                  height: auto;
                }
                </style>
                <!-- Question content-->
                <div class="x_content">
                      <div class="bs-example" data-example-id="simple-jumbotron">
                        <div class="jumbotron">
                            <h1>
                                <?php
                                    include("connects.php");
                                    
                                    $sql = "SELECT * FROM QuestionList WHERE No like '$q_list[$exam_index]' AND QA like 'Q'";
                                    if($stmt = $db->query($sql))
                                    {
                                        while($result = mysqli_fetch_object($stmt))
                                        {
                                          $q_type=$result->type;
                                          echo '<p><b>題號: '.$question_number.'</b></p>';
                                          echo '<p><b>'.$result->Content.'</b></p>';
                                          if ($result->type == 'VIDEO')
                                          {
                                            echo '<video width="640" height="480" controls>';
                                            echo '<source src="upload/Q';
                                            echo $q_list[$exam_index];
                                            echo '.mp4" type="video/mp4">';
                                            echo '</video>';

                                          }
                                          elseif (!empty($result->audio))
                                          {
                                            echo '<audio controls>';
                                            echo '<source src="upload/Q'.$q_list[$exam_index].'.mp3" type="audio/mpeg">';
                                            echo '</audio><p>';
                                          }
                                        }

                                    }
                                    
                                    if($q_type!='KEYBOARD'&&$q_type!='LWORD'&&$q_type!='LPICTURE')
                                    {
                                            $sql = "SELECT * FROM QuestionList WHERE No like '$q_list[$exam_index]' AND QA like 'A1'";
                                            $result = mysqli_fetch_object($db->query($sql));
                                            if($result->type == 'PICTURE')
                                            {
                                              echo '<div class="col-lg-3 col-md-3">';
                                              echo '<p><b>[A]</b></p>';
                                              echo '<img src="upload/Q';
                                              echo $q_list[$exam_index];
                                              echo 'A1.';
                                              echo $result->picture_ext;
                                              echo '" class="responsive" style="max-height:100%;max-height:100%;border-style: outset;">';
                                              echo '</div>';
                                            }
                                            else if($result->type == 'WORD')
                                            {
                                              echo '<p><b>[A]  '.$result->Content.'</b></p>';

                                            }
                                            else{}

                                            $sql = "SELECT * FROM QuestionList WHERE No like '$q_list[$exam_index]' AND QA like 'A2'";
                                            $result = mysqli_fetch_object($db->query($sql));
                                            if($result->type == 'PICTURE')
                                            {
                                              echo '<div class="col-lg-3 col-md-3">';
                                              echo '<p><b>[B]</b></p>';
                                              echo '<img src="upload/Q';
                                              echo $q_list[$exam_index];
                                              echo 'A2.';
                                              echo $result->picture_ext;
                                              echo '" class="responsive" style="max-height:100%;max-height:100%;border-style: outset;">';
                                              echo '</div>';
                                            }
                                            else if($result->type == 'WORD')
                                            {
                                              echo '<p><b>[B]  '.$result->Content.'</b></p>';
                                            }
                                            else{}


                                            $sql = "SELECT * FROM QuestionList WHERE No like '$q_list[$exam_index]' AND QA like 'A3'";
                                            $result = mysqli_fetch_object($db->query($sql));
                                            if($result->type == 'PICTURE')
                                            {
                                              echo '<div class="col-lg-3 col-md-3">';
                                              echo '<p><b>[C]</b></p>';
                                              echo '<img src="upload/Q';
                                              echo $q_list[$exam_index];
                                              echo 'A3.';
                                              echo $result->picture_ext;
                                              echo '" class="responsive" style="max-height:100%;max-height:100%;border-style: outset;">';
                                              echo '</div>';
                                            }
                                            else if($result->type == 'WORD')
                                            {
                                              echo '<p><b>[C]  '.$result->Content.'</b></p>';

                                            }
                                            else{}

                                            $sql = "SELECT * FROM QuestionList WHERE No like '$q_list[$exam_index]' AND QA like 'A4'";
                                            $result = mysqli_fetch_object($db->query($sql));
                                            if($result->type == 'PICTURE')
                                            {
                                              echo '<div class="col-lg-3 col-md-3">';
                                              echo '<p><b>[D]</b></p>';
                                              echo '<img src="upload/Q';
                                              echo $q_list[$exam_index];
                                              echo 'A4.';
                                              echo $result->picture_ext;
                                              echo '" class="responsive" style="max-height:100%;max-height:100%;border-style: outset;">';
                                              echo '</div>';
                                            }
                                            else if($result->type == 'WORD')
                                            {
                                              echo '<p><b>[D]  '.$result->Content.'</b></p>';

                                            }
                                            else{}
                                    }

                                    $db->close();

                                ?>                          
                            </h1>
                          <div class="clearfix"></div>
                        </div>
                      </div>
                </div>
                <!-- Question content-->
            </div>
            <!-- Question -->




            <script type="text/javascript">

            function timedMsg()
            {
            var t=setTimeout("runnext()",5000);
            }

            function runnext()
            {
              $.ajax
                       (
                          {
                          type: "POST",
                          url: "change.php",
                          data: { name: "Next" }
                          }
                       ).done(function( msg ) {});  
                       location.reload(); 
            }


            </script>



        <!-- page content################################# -->

        <!-- footer content -->
        <!--footer>
        <!--/footer>
        <!-- /footer content -->


      </div>
    </div>







            <!-- jQuery -->
            <script src="../vendors/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap -->
            <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- FastClick -->
            <script src="../vendors/fastclick/lib/fastclick.js"></script>
            <!-- NProgress -->
            <script src="../vendors/nprogress/nprogress.js"></script>
            <!-- Chart.js -->
            <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
            <!-- gauge.js -->
            <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
            <!-- bootstrap-progressbar -->
            <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
            <!-- iCheck -->
            <script src="../vendors/iCheck/icheck.min.js"></script>
            <!-- Skycons -->
            <script src="../vendors/skycons/skycons.js"></script>
            <!-- Flot -->
            <script src="../vendors/Flot/jquery.flot.js"></script>
            <script src="../vendors/Flot/jquery.flot.pie.js"></script>
            <script src="../vendors/Flot/jquery.flot.time.js"></script>
            <script src="../vendors/Flot/jquery.flot.stack.js"></script>
            <script src="../vendors/Flot/jquery.flot.resize.js"></script>
            <!-- Flot plugins -->
            <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
            <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
            <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
            <!-- DateJS -->
            <script src="../vendors/DateJS/build/date.js"></script>
            <!-- JQVMap -->
            <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
            <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
            <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
            <!-- bootstrap-daterangepicker -->
            <script src="../vendors/moment/min/moment.min.js"></script>
            <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

            <!-- Custom Theme Scripts -->
            <script src="../build/js/custom.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/dojo/1.13.0/dojo/dojo.js"></script>

            <script type="text/javascript">
                 $('#nextquiz').click(function() 
                    {
                      if (<?php echo $question_number; ?> == '10')
                      {
                        location.href = 'ExamFinish.php';
                      }
                      else
                      {
                         $.ajax
                         (
                            {
                            type: "POST",
                            url: "change.php",
                            data: { name: "Next" }
                            }
                         ).done(function( msg ) {});  
                         location.reload();
                         location.reload(); 
                      }
                    });

                 $('#zeroquiz').click(function() 
                    {
                         $.ajax
                         (
                            {
                            type: "POST",
                            url: "updateData.php",
                            data: { name: "Zero" }
                            }
                         ).done(function( msg ) {});  
                         location.reload();  
                    });
            </script>
  </body>
</html>
