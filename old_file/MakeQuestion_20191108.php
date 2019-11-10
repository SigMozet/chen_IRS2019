<!DOCTYPE html>

<?php
session_start();

if($_SESSION['username'] == null)
{
        header ('location: IRS_Login.php');
        exit;
}
else if ($_SESSION['type']!='T')
{
    header ('location: IRS_Login.php');
    exit;
}

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
            <!-- link href="../vendors/font-awesome/css/fontawesome-all.css" rel="stylesheet" -->
            <!-- Font Awesome -->
            <!-- link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" -->

            <link href="..//vendors/fontawesome-free-5.8.2-web/css/all.css" rel="stylesheet">
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
            <!-- DataTable -->
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

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
                  <?php 
                  include("side_bar_menu.php");
                  echo side_bar();
                  ?>
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

            
            <!-- Question -->
            <div class="x_panel">
                <!-- title bar-->
                <div class="x_title">
                  <h1><b>出題</b></h1>
                  <div class="clearfix"></div>
                </div>
                <!-- title bar-->

                <!-- MakeOut Form -->
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="singel-word-tab" role="tab" data-toggle="tab" aria-expanded="true">單選文字</a></li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="single-picture-tab" data-toggle="tab" aria-expanded="false">單選圖片</a></li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="multi-word-tab" data-toggle="tab" aria-expanded="false">多選文字</a></li>
                        <li role="presentation" class=""><a href="#tab_content4" role="tab" id="multi-picture-tab" data-toggle="tab" aria-expanded="false">多選圖片</a></li>
                        <li role="presentation" class=""><a href="#tab_content5" role="tab" id="single-video-tab" data-toggle="tab" aria-expanded="false">單選影片</a></li>
                        <li role="presentation" class=""><a href="#tab_content6" role="tab" id="multi-video-tab" data-toggle="tab" aria-expanded="false">多選影片</a></li>
                        <li role="presentation" class=""><a href="#tab_content7" role="tab" id="logic-word-tab" data-toggle="tab" aria-expanded="false">文字順序</a></li>
                        <li role="presentation" class=""><a href="#tab_content8" role="tab" id="logic-picture-tab" data-toggle="tab" aria-expanded="false">圖片順序</a></li>
                      </ul>
                </div>



                <!-- WORD TAB-->
                <div id="myTabContent" class="tab-content">

                    <!-- MAKE QUESTION w/ SINGLE ANSWER FORM IN WORD TAB -->
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="singel-word-tab">
                            <form class="form-horizontal form-label-left" method="post" action="updateQuestion_word.php" enctype="multipart/form-data" onKeyDown="if (event.keyCode == 13) {return false;}">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目流水號 : </label>
                                <label class="control-label">
                                    <?php
                                        include("connects.php");
                              
                                        $sql = "SELECT MAX(No) AS max FROM QuestionList";
                                        $result = mysqli_fetch_object($db->query($sql));
                                        $max_number = $result->max;
                                        echo $max_number+1;
                                    ?>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">答題型別 :<span class="required"></span></label>
                                <input type="radio" class="radio-inline flat" name="single_or_multi" value="SINGLE" checked="checked"><label>單選</label>
                                <input type="radio" class="radio-inline flat" name="single_or_multi" value="MULTI" disabled="disabled"><label>多選</label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目 :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="Q1" required="required" class="form-control col-md-7 col-xs-12">
                                </div>

                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_file"/>
                                </div>
                            </div>
                            <div class="form-group  sameline">
                                <label class="control-label col-md-3" for="last-name">題目附圖 : <span></span></label>
                                <input type="file" name="Q1_file"/>
                                <label for="last-name">alt :</label>
                                <input type="text" name="Q1_alt">
                            </div>
                            <HR>
                            <HR>


                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(A) :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="A1" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A1"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(B) :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="A2" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A2"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(C) :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="A3" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A3"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(D) :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="A4" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A4"/>
                                </div>
                            </div>

                            <!--div class="form-group">
                                <label class="control-label col-md-3" for="last-name">附加音檔(非必要) : <span></span></label>
                                <div class="col-md-4">
                                    <input type="file" name="audio_file"/>
                                </div>
                            </div-->



                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">正解 :<span class="required"></span></label>
                                <input type="radio" class="radio-inline flat" name="answer[]" value="A1" required><label>A選項</label>
                                <input type="radio" class="radio-inline flat" name="answer[]" value="A2"><label>B選項</label>
                                <input type="radio" class="radio-inline flat" name="answer[]" value="A3"><label>C選項</label>
                                <input type="radio" class="radio-inline flat" name="answer[]" value="A4"><label>D選項</label>
                            </div>


    

                            <clearfix>
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">重填</button>
                                <button type="submit" class="btn btn-success">送出</button>
                            </div>
                        </form>
                    </div>

                    <!-- MAKE QUESTION w/ SINGLE ANSWER FORM IN WORD TAB -->

                     <!-- MAKE QUESTION w/ SINGEL ANSWER FORM IN PICTURE TAB -->
                     <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="single-picture-tab">
                        <form class="form-horizontal form-label-left" method="post" action="updateQuestion_picture.php" enctype="multipart/form-data" onKeyDown="if (event.keyCode == 13) {return false;}">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目流水號 : </label>
                                <label class="control-label">
                                    <?php
                                        include("connects.php");
                              
                                        $sql = "SELECT MAX(No) AS max FROM QuestionList";
                                        $result = mysqli_fetch_object($db->query($sql));
                                        $max_number = $result->max;
                                        echo $max_number+1;
                                    ?>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">答題型別 :<span class="required"></span></label>
                                <input type="radio" class="radio-inline flat" name="single_or_multi" value="SINGLE" checked="checked"><label>單選</label>
                                <input type="radio" class="radio-inline flat" name="single_or_multi" value="MULTI" disabled="disabled"><label>多選</label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目 :<span class="required"></span></label>
                                <div class="col-md-5">
                                  <input type="text"  name="Q1" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group  sameline">
                                <label class="control-label col-md-3" for="last-name">題目附圖 : <span></span></label>
                                <input type="file" name="Q1_file"/>
                                <label for="last-name">alt :</label>
                                <input type="text" name="Q1_alt">
                            </div>
                            <HR>
                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(A) :<span class="required"></span></label>
                                <div class="col-md-2">
                                    <input type="file" name="A1_file" required />
                                    <label for="last-name">alt :</label>
                                    <input type="text" name="A1_alt" required="required">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A1"/>
                                </div>
                            </div>
                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(B) :<span class="required"></span></label>
                                <div class="col-md-2">
                                    <input type="file" name="A2_file" required />
                                    <label for="last-name">alt :</label>
                                    <input type="text" name="A2_alt" required="required">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A2"/>
                                </div>
                            </div>
                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(C) :<span class="required"></span></label>
                                <div class="col-md-2">
                                    <input type="file" name="A3_file" required />
                                    <label for="last-name">alt :</label>
                                    <input type="text" name="A3_alt" required="required">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A3"/>
                                </div>
                            </div>
                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(D) :<span class="required"></span></label>
                                <div class="col-md-2">
                                    <input type="file" name="A4_file" required />
                                    <label for="last-name">alt :</label>
                                    <input type="text" name="A4_alt" required="required">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A4"/>
                                </div>
                            </div>

                            <!--div class="form-group">
                                <label class="control-label col-md-3" for="last-name">附加音檔(非必要) : <span></span></label>
                                <div class="col-md-2">
                                    <input type="file" name="audio_file"/>
                                </div>
                            </div-->


                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">正解 :<span class="required"></span></label>
                                <input type="radio" class="radio-inline flat" name="answer[]" value="A1" required><label>A選項</label>
                                <input type="radio" class="radio-inline flat" name="answer[]" value="A2"><label>B選項</label>
                                <input type="radio" class="radio-inline flat" name="answer[]" value="A3"><label>C選項</label>
                                <input type="radio" class="radio-inline flat" name="answer[]" value="A4"><label>D選項</label>
                            </div>

                            <clearfix>
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">重填</button>
                                <button type="submit" class="btn btn-success">送出</button>
                            </div>
                        </form>
                    </div>

                     <!-- MAKE QUESTION w/ SINGEL ANSWER FORM IN PICTURE TAB -->

                    <!-- MAKE QUESTION w/ MULTI ANSWER FORM IN WORD TAB -->
                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="multi-word-tab">
                            <form class="form-horizontal form-label-left" method="post" action="updateQuestion_word.php" enctype="multipart/form-data" onKeyDown="if (event.keyCode == 13) {return false;}">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目流水號 : </label>
                                <label class="control-label">
                                    <?php
                                        include("connects.php");
                              
                                        $sql = "SELECT MAX(No) AS max FROM QuestionList";
                                        $result = mysqli_fetch_object($db->query($sql));
                                        $max_number = $result->max;
                                        echo $max_number+1;
                                    ?>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">答題型別 :<span class="required"></span></label>
                                <input type="radio" class="radio-inline flat" name="single_or_multi" value="SINGLE" disabled="disabled"><label>單選</label>
                                <input type="radio" class="radio-inline flat" name="single_or_multi" value="MULTI" checked="checked"><label>多選</label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目 :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="Q1" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_file"/>
                                </div>
                            </div>
                            <div class="form-group  sameline">
                                <label class="control-label col-md-3" for="last-name">題目附圖 : <span></span></label>
                                <input type="file" name="Q1_file"/>
                                <label for="last-name">alt :</label>
                                <input type="text" name="Q1_alt">
                            </div>
                            <HR>
                            <HR>


                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(A) :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="A1" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A1"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(B) :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="A2" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A2"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(C) :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="A3" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A3"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(D) :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="A4" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A4"/>
                                </div>
                            </div>

                            <!--div class="form-group">
                                <label class="control-label col-md-3" for="last-name">附加音檔(非必要) : <span></span></label>
                                <div class="col-md-4">
                                    <input type="file" name="audio_file"/>
                                </div>
                            </div-->


                            <div class="form-group required">
                                <label class="control-label col-md-3" for="first-name">正解 :<span class="required"></span></label>
                                <input type="checkbox" class="radio-inline flat" name="answer[]" value="A1"><label>A選項</label>
                                <input type="checkbox" class="radio-inline flat" name="answer[]" value="A2"><label>B選項</label>
                                <input type="checkbox" class="radio-inline flat" name="answer[]" value="A3"><label>C選項</label>
                                <input type="checkbox" class="radio-inline flat" name="answer[]" value="A4"><label>D選項</label>
                            </div>
    

                            <clearfix>
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">重填</button>
                                <button type="submit" class="btn btn-success">送出</button>
                            </div>
                        </form>
                    </div>

                    <!-- MAKE QUESTION w/ MULTI ANSWER FORM IN WORD TAB -->



                     <!-- MAKE QUESTION w/ MULTI ANSWER FORM IN PICTURE TAB -->
                     <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="multi-picture-tab">
                        <form class="form-horizontal form-label-left" method="post" action="updateQuestion_picture.php" enctype="multipart/form-data" onKeyDown="if (event.keyCode == 13) {return false;}">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目流水號 : </label>
                                <label class="control-label">
                                    <?php
                                        include("connects.php");
                              
                                        $sql = "SELECT MAX(No) AS max FROM QuestionList";
                                        $result = mysqli_fetch_object($db->query($sql));
                                        $max_number = $result->max;
                                        echo $max_number+1;
                                    ?>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">答題型別 :<span class="required"></span></label>
                                <input type="radio" class="radio-inline flat" name="single_or_multi" value="SINGLE" disabled="disabled"><label>單選</label>
                                <input type="radio" class="radio-inline flat" name="single_or_multi" value="MULTI" checked="checked"><label>多選</label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目 :<span class="required"></span></label>
                                <div class="col-md-5">
                                  <input type="text"  name="Q1" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group  sameline">
                                <label class="control-label col-md-3" for="last-name">題目附圖 : <span></span></label>
                                <input type="file" name="Q1_file"/>
                                <label for="last-name">alt :</label>
                                <input type="text" name="Q1_alt">
                            </div>
                            <HR>
                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(A) :<span class="required"></span></label>
                                <div class="col-md-2">
                                    <input type="file" name="A1_file" required />
                                    <label for="last-name">alt :</label>
                                    <input type="text" name="A1_alt" required="required">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A1"/>
                                </div>
                            </div>
                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(B) :<span class="required"></span></label>
                                <div class="col-md-2">
                                    <input type="file" name="A2_file" required />
                                    <label for="last-name">alt :</label>
                                    <input type="text" name="A2_alt" required="required">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A2"/>
                                </div>
                            </div>
                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(C) :<span class="required"></span></label>
                                <div class="col-md-2">
                                    <input type="file" name="A3_file" required />
                                    <label for="last-name">alt :</label>
                                    <input type="text" name="A3_alt" required="required">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A3"/>
                                </div>
                            </div>
                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(D) :<span class="required"></span></label>
                                <div class="col-md-2">
                                    <input type="file" name="A4_file" required />
                                    <label for="last-name">alt :</label>
                                    <input type="text" name="A4_alt" required="required">
                                </div>
                                <label class="control-label col-md-1" for="last-name">附加音檔: <span></span></label>
                                <div class="col-md-3">
                                    <input type="file" name="audio_A4"/>
                                </div>
                            </div>


                            <!--div class="form-group">
                                <label class="control-label col-md-3" for="last-name">附加音檔(非必要) : <span></span></label>
                                <div class="col-md-5">
                                    <input type="file" name="audio_file"/>
                                </div>
                            </div-->


                            <div class="form-group required">
                                <label class="control-label col-md-3" for="first-name">正解 :<span class="required"></span></label>
                                <input type="checkbox" class="radio-inline flat" name="answer[]" value="A1"><label>A選項</label>
                                <input type="checkbox" class="radio-inline flat" name="answer[]" value="A2"><label>B選項</label>
                                <input type="checkbox" class="radio-inline flat" name="answer[]" value="A3"><label>C選項</label>
                                <input type="checkbox" class="radio-inline flat" name="answer[]" value="A4"><label>D選項</label>
                            </div>

                            <clearfix>
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">重填</button>
                                <button type="submit" class="btn btn-success">送出</button>
                            </div>
                        </form>
                    </div>

                     <!-- MAKE QUESTION w/ MULTI ANSWER FORM IN PICTURE TAB -->

                     <!-- MAKE QUESTION w/ SINGEL ANSWER FORM IN VIDEO TAB -->
                    <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="single-video-tab">
                        <form class="form-horizontal form-label-left" method="post" action="updateQuestion_video.php" enctype="multipart/form-data" onKeyDown="if (event.keyCode == 13) {return false;}">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目流水號 : </label>
                                <label class="control-label">
                                    <?php
                                        include("connects.php");
                              
                                        $sql = "SELECT MAX(No) AS max FROM QuestionList";
                                        $result = mysqli_fetch_object($db->query($sql));
                                        $max_number = $result->max;
                                        echo $max_number+1;
                                    ?>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">答題型別 :<span class="required"></span></label>
                                <input type="radio" class="radio-inline flat" name="single_or_multi" value="SINGLE" checked="checked"><label>單選</label>
                                <input type="radio" class="radio-inline flat" name="single_or_multi" value="MULTI" disabled="disabled"><label>多選</label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目 :<span></span></label>
                                <div class="col-md-5">
                                  <input type="text"  name="Q1" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">上傳影片 <span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="file" name="video_file" required="required" />
                                </div>
                            </div>
                            <HR>
                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(A) :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="A1" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group sameline">
                                <label class="control-label col-md-3" for="last-name">選項(A)附圖 : <span></span></label>
                                <input type="file" name="a1_file"/>
                                <label for="last-name">alt :</label>
                                <input type="text" name="a1_alt">
                            </div>
                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(B) :<span class="required"></span></label>
                                <div class="col-md-5">
                                  <input type="text"  name="A2" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group sameline">
                                <label class="control-label col-md-3" for="last-name">選項(B)附圖 : <span></span></label>
                                <input type="file" name="a2_file"/>
                                <label for="last-name">alt :</label>
                                <input type="text" name="a2_alt">
                            </div>
                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(C) :<span class="required"></span></label>
                                <div class="col-md-5">
                                  <input type="text"  name="A3" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group sameline">
                                <label class="control-label col-md-3" for="last-name">選項(C)附圖 : <span></span></label>
                                <input type="file" name="a3_file"/>
                                <label for="last-name">alt :</label>
                                <input type="text" name="a3_alt">
                            </div>

                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(D) :<span class="required"></span></label>
                                <div class="col-md-5">
                                  <input type="text"  name="A4" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group sameline">
                                <label class="control-label col-md-3" for="last-name">選項(D)附圖 : <span></span></label>
                                <input type="file" name="a4_file"/>
                                <label for="last-name">alt :</label>
                                <input type="text" name="a4_alt">
                            </div>
                            <HR>


                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">正解 :<span class="required"></span></label>
                                <input type="radio" class="radio-inline flat" name="answer[]" value="A1" required><label>A選項</label>
                                <input type="radio" class="radio-inline flat" name="answer[]" value="A2"><label>B選項</label>
                                <input type="radio" class="radio-inline flat" name="answer[]" value="A3"><label>C選項</label>
                                <input type="radio" class="radio-inline flat" name="answer[]" value="A4"><label>D選項</label>
                            </div>

                            <clearfix>
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">重填</button>
                                <button type="submit" class="btn btn-success">送出</button>
                            </div>
                        </form>
                    </div>
                    <!-- MAKE QUESTION w/ SINGEL ANSWER FORM IN VIDEO TAB -->

                    <!-- MAKE QUESTION w/ MULTI ANSWER FORM IN VIDEO TAB -->

                    <div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="multi-video-tab">
                        <form class="form-horizontal form-label-left" method="post" action="updateQuestion_video.php" enctype="multipart/form-data" onKeyDown="if (event.keyCode == 13) {return false;}">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目流水號 : </label>
                                <label class="control-label">
                                    <?php
                                        include("connects.php");
                              
                                        $sql = "SELECT MAX(No) AS max FROM QuestionList";
                                        $result = mysqli_fetch_object($db->query($sql));
                                        $max_number = $result->max;
                                        echo $max_number+1;
                                    ?>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">答題型別 :<span class="required"></span></label>
                                <input type="radio" class="radio-inline flat" name="single_or_multi" value="SINGLE" disabled="disabled"><label>單選</label>
                                <input type="radio" class="radio-inline flat" name="single_or_multi" value="MULTI" checked="checked"><label>多選</label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目 :<span></span></label>
                                <div class="col-md-5">
                                  <input type="text"  name="Q1" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">上傳影片 <span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="file" name="video_file" required="required" />
                                </div>
                            </div>
                            <HR>
                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(A) :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="A1" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group sameline">
                                <label class="control-label col-md-3" for="last-name">選項(A)附圖 : <span></span></label>
                                <input type="file" name="a1_file"/>
                                <label for="last-name">alt :</label>
                                <input type="text" name="a1_alt">
                            </div>
                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(B) :<span class="required"></span></label>
                                <div class="col-md-5">
                                  <input type="text"  name="A2" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group sameline">
                                <label class="control-label col-md-3" for="last-name">選項(B)附圖 : <span></span></label>
                                <input type="file" name="a2_file"/>
                                <label for="last-name">alt :</label>
                                <input type="text" name="a2_alt">
                            </div>
                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(C) :<span class="required"></span></label>
                                <div class="col-md-5">
                                  <input type="text"  name="A3" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group sameline">
                                <label class="control-label col-md-3" for="last-name">選項(C)附圖 : <span></span></label>
                                <input type="file" name="a3_file"/>
                                <label for="last-name">alt :</label>
                                <input type="text" name="a3_alt">
                            </div>

                            <HR>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">選項(D) :<span class="required"></span></label>
                                <div class="col-md-5">
                                  <input type="text"  name="A4" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group sameline">
                                <label class="control-label col-md-3" for="last-name">選項(D)附圖 : <span></span></label>
                                <input type="file" name="a4_file"/>
                                <label for="last-name">alt :</label>
                                <input type="text" name="a4_alt">
                            </div>
                            <HR>



                            <div class="form-group required">
                                <label class="control-label col-md-3" for="first-name">正解 :<span class="required"></span></label>
                                <input type="checkbox" class="radio-inline flat" name="answer[]" value="A1"><label>A選項</label>
                                <input type="checkbox" class="radio-inline flat" name="answer[]" value="A2"><label>B選項</label>
                                <input type="checkbox" class="radio-inline flat" name="answer[]" value="A3"><label>C選項</label>
                                <input type="checkbox" class="radio-inline flat" name="answer[]" value="A4"><label>D選項</label>
                            </div>

                            <clearfix>
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">重填</button>
                                <button type="submit" class="btn btn-success">送出</button>
                            </div>
                        </form>
                    </div>
                    <!-- MAKE QUESTION w/ MULTI ANSWER FORM IN VIDEO TAB -->


                    <!-- MAKE QUESTION w/ LOGIC ANSWER FORM IN WORD TAB -->

                    

                    <div role="tabpanel" class="tab-pane fade" id="tab_content7" aria-labelledby="logic-word-tab">

                            <div class="form-horizontal form-label-left">
                              <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">增減選項 : </label>
                                <button class="btn btn-success" onclick="addInput()">+</button>
                                <button class="btn btn-danger" onclick="subInput()">-</button>
                              </div>
                            </div>
                            
                            <form class="form-horizontal form-label-left" method="post" action="updateQuestion_logicWord.php" enctype="multipart/form-data" onKeyDown="if (event.keyCode == 13) {return false;}">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目流水號 : </label>
                                <label class="control-label">
                                    <?php
                                        include("connects.php");
                              
                                        $sql = "SELECT MAX(No) AS max FROM QuestionList";
                                        $result = mysqli_fetch_object($db->query($sql));
                                        $max_number = $result->max;
                                        echo $max_number+1;
                                    ?>
                                </label>
                            </div>
                            
                          <div id="message"></div>

                          <script type="text/javascript">


                          var create_input_number = 0;

                          function addInput() {
                                    create_input_number++;
                                    var div_form = document.createElement("DIV");
                                    div_form.setAttribute("class","form-group");
                                    name = 'div_q'+create_input_number;
                                    div_form.setAttribute("id",name);
                                    

                                    var lb = '<label class="control-label col-md-3" for="first-name">選項' + create_input_number +' :<span class="required"></span></label>';
                                    var md5 = '<div class="col-md-5">';
                                    var input_q =  '<input type="text"  name="Answer[]" required="required" class="form-control col-md-7 col-xs-12">';
                                    div_form.innerHTML = lb+md5+input_q;
                                    document.getElementById("message").appendChild(div_form);
                                    }

                          function subInput() {
                                      if(create_input_number>1)
                                        {
                                          _name = 'div_q'+create_input_number;
                                        document.getElementById(_name).remove();
                                        create_input_number--;
                                        }
                                    }
                          
                          addInput();          
                          </script>
                            <HR>
                            <HR>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目 :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="Q1" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">正確順序 :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="CA" placeholder="EX : 正確語序若為選項1-3-2-4，請填 A1,A3,A2,A4" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <clearfix>
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">重填</button>
                                <button type="submit" class="btn btn-success">送出</button>
                            </div>
                        </form>
                    </div>

                    <!-- MAKE QUESTION w/ LOGIC ANSWER FORM IN WORD TAB -->

                    <!-- MAKE QUESTION w/ LOGIC ANSWER FORM IN PICTURE TAB -->


                    <div role="tabpanel" class="tab-pane fade" id="tab_content8" aria-labelledby="logic-picture-tab">
                            <div class="form-horizontal form-label-left">
                              <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">增減選項 : </label>
                                <button class="btn btn-success" onclick="addInputPic()">+</button>
                                <button class="btn btn-danger" onclick="subInputPic()">-</button>
                              </div>
                            </div>

                            <form class="form-horizontal form-label-left" method="post" action="updateQuestion_logicPic.php" enctype="multipart/form-data" onKeyDown="if (event.keyCode == 13) {return false;}">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目流水號 : </label>
                                <label class="control-label">
                                    <?php
                                        include("connects.php");
                              
                                        $sql = "SELECT MAX(No) AS max FROM QuestionList";
                                        $result = mysqli_fetch_object($db->query($sql));
                                        $max_number = $result->max;
                                        echo $max_number+1;
                                    ?>
                                </label>
                            </div>
                                                  

                          <div id="messagePic"></div>


                            <HR>
                            <HR>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">題目 :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="Q1" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">正確順序 :<span class="required"></span></label>
                                <div class="col-md-5">
                                    <input type="text"  name="CA" placeholder="正解順序 例如: A1-A3-A2-A4" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <input type="hidden" name="picture_number"  id="picture_number">

                            <script type="text/javascript"></script>
                            <clearfix>
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">重填</button>
                                <button type="submit" class="btn btn-success">送出</button>
                            </div>
                        </form>
                    </div>

                          <script type="text/javascript">
                          var pic_create_input_number = 0;

                          function addInputPic() {
                                    pic_create_input_number++;
                                    var div_form = document.createElement("DIV");
                                    div_form.setAttribute("class","form-group");
                                    name = 'div_qpic'+pic_create_input_number;
                                    div_form.setAttribute("id",name);
                                    

                                    var lb = '<label class="control-label col-md-3" for="first-name">圖片' + pic_create_input_number +' :<span class="required"></span></label>';
                                    var md5 = '<div class="col-md-3">';
                                    var input_q =  '<input type="file" name="A'+pic_create_input_number+'_file" required />';
                                    div_form.innerHTML = lb+md5+input_q;
                                    document.getElementById("messagePic").appendChild(div_form);
                                    document.getElementById("picture_number").value=pic_create_input_number;
                                    }

                          function subInputPic() {
                                      if(pic_create_input_number>1)
                                        {
                                          _name = 'div_qpic'+pic_create_input_number;
                                        document.getElementById(_name).remove();
                                        pic_create_input_number--;
                                        document.getElementById("picture_number").value=pic_create_input_number;
                                        }
                                    }
                          
                          addInputPic();
                          
                          </script>

                    <!-- MAKE QUESTION w/ LOGIC ANSWER FORM IN PICTURE TAB -->

                </div>
                <!-- WORD TAB-->


                <!-- MakeOut Form -->

            </div>
            <!-- Question -->







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
            <!-- DataTable -->
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

            <!-- Custom Theme Scripts -->
            <script src="../build/js/custom.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/dojo/1.13.0/dojo/dojo.js"></script>
  </body>
</html>