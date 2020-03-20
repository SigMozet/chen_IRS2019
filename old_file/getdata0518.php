<?
	include("connects.php");
	
	$sql_nowstate = "select * from Now_state";
	
	//取得現在題號、現在的試卷號碼
	if($stmt = $db->query($sql_nowstate))
	{
		while($result = mysqli_fetch_object($stmt))
		{
			$sql_number = $result->No;
			$sql_quiz = $result->ExamNumber;			
		}
	}
	
	//取得每一題在Questionlist的號碼
	$sql_quiz = "SELECT * FROM ExamList WHERE No like '$sql_quiz'";
	$result = mysqli_fetch_object($db->query($sql_quiz));
	$q_list = array();
	$temp_string = $result->question_list;
	$q_list = mb_split(",",$temp_string);

	
	//取得此題的答案數量
	$sql_number_quiz = "select count(QA) AS Count from QuestionList where No like '".$q_list[$sql_number-1]."'";
	$stmt = $db->query($sql_number_quiz);
	$number_quiz_sql = mysqli_fetch_object($stmt);
	$number_quiz = $number_quiz_sql->Count;
	
	//取得現在題目的題型為單選或多選
	$sql_checkbox = "select * from QuestionList where No like '".$q_list[$sql_number-1]."' and QA like 'Q'";
	$stmt = $db->query($sql_checkbox);
	$result = mysqli_fetch_object($stmt);
	$exam_type = $result->single_or_multi;
	$quiz_type = $result->type;
	$No_keyboard = $result->KeyboardNo;
	
	
	//判斷題目是否為邏輯順序題
	//題目為邏輯順序題
	if(strpos($quiz_type,'L')!== false){
		//判斷題目為多題模式還是為4題模式
		//4題模式
		if($number_quiz == 5){
			for( $i = 1 ; $i <= 4 ; $i++){
				if(strpos($quiz_type,'WORD')!== false){
					$sql_word = "select * FROM QuestionList WHERE No like '".$q_list[$sql_number-1]."' AND QA like 'A".$i."'";
					$result = mysqli_fetch_object($db->query($sql_word));
					echo "<div class='col-md-6 col-sm-6 col-xs-6' style='height:45%'>";
					if($result->audio != NULL){
						echo "<audio controls>";
							echo "<source src='http://10.16.1.13/chen_IRS/".$result->audio."' type='audio/mpeg'>";
						echo "</audio>";
					}
						echo "<input type='checkbox' id='A".$i."' name='value[]' value='A".$i."' placeholder='".$result->Content."' onclick='show_order(this.value,this.id,this.placeholder)'>";
							echo "<label for='A".$i."' style='font-size:20px'>".$result->Content."</label>";
					echo "</div>";
				}
				//影音題
				elseif(strpos($quiz_type,'VIDEO')!== false){
					$sql_video = "select * FROM QuestionList WHERE No like '".$q_list[$sql_number-1]."' AND QA like 'A".$i."'";
					$result = mysqli_fetch_object($db->query($sql_video));
					$video_type = $result->picture_ext; //抓圖片型態		
					$video_alt = $result->picture_alt; //抓圖片alt
					echo "<div class='col-md-6 col-sm-6 col-xs-6' style='height:45%'>";
					if($result->audio != NULL){
						echo "<audio controls>";
							echo "<source src='http://10.16.1.13/chen_IRS/".$result->audio."' type='audio/mpeg'>";
						echo "</audio>";
					}
					if($video_type != NULL){
						echo "<video controls>";
							echo "<source src='http://10.16.1.13/chen_IRS/".$video_type."' type='video/mp4'>";
						echo "</video>";
					}
						echo "<input type='checkbox' id='A".$i."' name='value[]' value='A".$i."' placeholder='".$result->Content."' onclick='show_order(this.value,this.id,this.placeholder)'>";					
							echo "<label for='A".$i."' style='font-size:20px'>".$result->Content."</label>";
					echo "</div>";
				}
				//圖片題
				else{				
					$sql_picture = "select * FROM QuestionList WHERE No like '".$q_list[$sql_number-1]."' AND QA like 'A".$i."'";
					$result = mysqli_fetch_object($db->query($sql_picture));
					$picture_type = $result->picture_ext; //抓圖片型態		
					$picture_alt = $result->picture_alt; //抓圖片alt	
					echo "<div class='col-md-6 col-sm-6 col-xs-6' style='height:45%'>";

					if($result->audio != NULL){
						echo "<audio controls>";
							echo "<source src='http://10.16.1.13/chen_IRS/".$result->audio."' type='audio/mpeg'>";
						echo "</audio>";
					}
						echo "<input type='checkbox' id='A".$i."' name='value[]' value='A".$i."' placeholder='".$result->Content."' onclick='show_order(this.value,this.id,this.placeholder)'>";
						echo "<label for='A".$i."'>";
							echo "<img src='http://10.16.1.13/chen_IRS/upload/Q".$q_list[$sql_number-1]."A".$i.".".$picture_type."' alt='".$picture_alt."'>";
						echo "</label>";
					echo "</div>";
				}
			}					
		}
		
		//keyboard模式
		else{
			$Arr = mb_split("-",$keyboard);
			for( $i = 0 ; $i <= count($Arr) ; $i++){	
				if($i % 4 == 0){
					echo "<div class='col-md-6 col-sm-6 col-xs-6' style='height:22.5%'>";
				}
				echo "<div class='col-md-3 col-sm-3 col-xs-3'>";
				echo "<input type='checkbox' id='A".($i+1)."' name='value[]' value='A".($i+1)."'>";
				echo "<label for='A".($i+1)."'>";
				echo "<img src='http://10.16.1.13/chen_IRS/upload/K".$No_keyboard."A".($i+1).".".$Arr[$i]."'>";
				echo "</label>";
				echo "</div>";
				if($i % 4 == 3){
					echo "</div>";
				}
				if($i % 4 != 3 && $i == count($Arr)){
					echo "</div>";
				}
			}						
		}	
	}
	//題目不為邏輯順序題
	else{
		//判斷題目為多題模式還是為4題模式
		//4題模式
		if($number_quiz == 5){
			//單選題
			if($exam_type == 'SINGLE'){
				//文字題
				for( $i = 1 ; $i <= 4 ; $i++){
					if(strpos($quiz_type,'WORD')!== false){
						$sql_word = "select * FROM QuestionList WHERE No like '".$q_list[$sql_number-1]."' AND QA like 'A".$i."'";
						$result = mysqli_fetch_object($db->query($sql_word));
						echo "<div class='col-md-6 col-sm-6 col-xs-6' style='height:45%'>";
						if($result->audio != NULL){
							echo "<audio controls>";
								echo "<source src='http://10.16.1.13/chen_IRS/".$result->audio."' type='audio/mpeg'>";
							echo "</audio>";
						}
							echo "<input type='radio' id='A".$i."' name='value[]' value='A".$i."' >";
								echo "<label for='A".$i."' style='font-size:20px'>".$result->Content."</label>";
						echo "</div>";
					}
					//影音題
					elseif(strpos($quiz_type,'VIDEO')!== false){
						$sql_video = "select * FROM QuestionList WHERE No like '".$q_list[$sql_number-1]."' AND QA like 'A".$i."'";
						$result = mysqli_fetch_object($db->query($sql_video));
						$video_type = $result->picture_ext;	
						$video_alt = $result->picture_alt;
						
						echo "<div class='col-md-6 col-sm-6 col-xs-6' style='height:45%'>";
						if($result->audio != NULL){
							echo "<audio controls>";
								echo "<source src='http://10.16.1.13/chen_IRS/".$result->audio."' type='audio/mpeg'>";
							echo "</audio>";
						}
						if($video_type != NULL){
							echo "<video controls>";
								echo "<source src='http://10.16.1.13/chen_IRS/".$video_type."' type='video/mp4'>";
							echo "</video>";
						}
							echo "<input type='radio' id='A".$i."' name='value[]' value='A".$i."'>";					
								echo "<label for='A".$i."' style='font-size:20px'>".$result->Content."</label>";
						echo "</div>";
					}
					//圖片題
					else{				
						$sql_picture = "select * FROM QuestionList WHERE No like '".$q_list[$sql_number-1]."' AND QA like 'A".$i."'";
						$result = mysqli_fetch_object($db->query($sql_picture));
						$picture_type = $result->picture_ext; //抓圖片型態		
						$picture_alt = $result->picture_alt; //抓圖片alt	
						echo "<div class='col-md-6 col-sm-6 col-xs-6' style='height:45%'>";
						if($result->audio != NULL){
							echo "<audio controls>";
								echo "<source src='http://10.16.1.13/chen_IRS/".$result->audio."' type='audio/mpeg'>";
							echo "</audio>";
						}
							echo "<input type='radio' id='A".$i."' name='value[]' value='A".$i."'>";
							echo "<label for='A".$i."'>";
								echo "<img src='http://10.16.1.13/chen_IRS/upload/Q".$q_list[$sql_number-1]."A".$i.".".$picture_type."' alt='".$picture_alt."'>";
							echo "</label>";
						echo "</div>";
					}
				}
			}	
			//多選題		
			else{
				for( $i = 1 ; $i <= 4 ; $i++){
					if(strpos($quiz_type,'WORD')!== false){
						$sql_word = "select * FROM QuestionList WHERE No like '".$q_list[$sql_number-1]."' AND QA like 'A".$i."'";
						$result = mysqli_fetch_object($db->query($sql_word));
						echo "<div class='col-md-6 col-sm-6 col-xs-6' style='height:45%'>";
						if($result->audio != NULL){
							echo "<audio controls>";
								echo "<source src='http://10.16.1.13/chen_IRS/".$result->audio."' type='audio/mpeg'>";
							echo "</audio>";
						}
							echo "<input type='checkbox' id='A".$i."' name='value[]' value='A".$i."'>";
								echo "<label for='A".$i."' style='font-size:20px'>".$result->Content."</label>";
						echo "</div>";
					}
					//影音題
					elseif(strpos($quiz_type,'VIDEO')!== false){
						$sql_video = "select * FROM QuestionList WHERE No like '".$q_list[$sql_number-1]."' AND QA like 'A".$i."'";
						$result = mysqli_fetch_object($db->query($sql_video));
						$video_type = $result->picture_ext; //抓圖片型態		
						$video_alt = $result->picture_alt; //抓圖片alt
						echo "<div class='col-md-6 col-sm-6 col-xs-6' style='height:45%'>";
						if($result->audio != NULL){
							echo "<audio controls>";
								echo "<source src='http://10.16.1.13/chen_IRS/".$result->audio."' type='audio/mpeg'>";
							echo "</audio>";
						}
						if($video_type != NULL){
							echo "<video controls>";
								echo "<source src='http://10.16.1.13/chen_IRS/".$video_type."' type='video/mp4'>";
							echo "</video>";
						}
							echo "<input type='checkbox' id='A".$i."' name='value[]' value='A".$i."'>";					
								echo "<label for='A".$i."' style='font-size:20px'>".$result->Content."</label>";
						echo "</div>";
					}
					//圖片題
					else{				
						$sql_picture = "select * FROM QuestionList WHERE No like '".$q_list[$sql_number-1]."' AND QA like 'A".$i."'";
						$result = mysqli_fetch_object($db->query($sql_picture));
						$picture_type = $result->picture_ext; //抓圖片型態		
						$picture_alt = $result->picture_alt; //抓圖片alt	
						echo "<div class='col-md-6 col-sm-6 col-xs-6' style='height:45%'>";

						if($result->audio != NULL){
							echo "<audio controls>";
								echo "<source src='http://10.16.1.13/chen_IRS/".$result->audio."' type='audio/mpeg'>";
							echo "</audio>";
						}
							echo "<input type='checkbox' id='A".$i."' name='value[]' value='A".$i."'>";
							echo "<label for='A".$i."'>";
								echo "<img src='http://10.16.1.13/chen_IRS/upload/Q".$q_list[$sql_number-1]."A".$i.".".$picture_type."' alt='".$picture_alt."'>";
							echo "</label>";
						echo "</div>";
					}
				}
			}			
		}
		//keyboard模式
		else{
			//拿ext字串
			$sql_catch_exam = "select * from Keyboard where KeyboardNo = '".$No_keyboard."'";
			$result = mysqli_fetch_object($db->query($sql_catch_exam));
			$keyboard = $result->ext;			
			
			//單選題
			if($exam_type == 'SINGLE'){		
				$Arr = mb_split("-",$keyboard);
				for( $i = 0 ; $i < count($Arr) ; $i++){	
					if($i % 4 == 0){
						echo "<div class='col-md-6 col-sm-6 col-xs-6' style='height:22.5%'>";
					}
					$answer_index = $i;
					$answer_index+=1;
					echo "<div class='col-md-3 col-sm-3 col-xs-3'>";
					echo "<input type='radio' id='A".($answer_index)."' name='value[]' value='A".($answer_index)."'>";
					echo "<label for='A".($answer_index)."'>";
						//echo "<img src='http://10.16.1.13/chen_IRS/upload/K".$No_keyboard."A".$answer_index.".".$Arr[$i]."'>";
						echo "<img src='http://10.16.1.13/chen_IRS/upload/K1A1.png'>";
					echo "</label>";
					echo "</div>";
					if($i % 4 == 3){
						echo "</div>";
					}
					if($i % 4 != 3 && $i == count($Arr)){
						echo "</div>";
					}
				}
			}	
			//多選題
			else{
				$Arr = mb_split("-",$keyboard);
				for( $i = 0 ; $i < count($Arr) ; $i++){	
					if($i % 4 == 0){
						echo "<div class='col-md-6 col-sm-6 col-xs-6' style='height:22.5%'>";
					}
					$answer_index = $i;
					$answer_index+=1;
					echo "<div class='col-md-3 col-sm-3 col-xs-3 test'>";
					echo "<input type='checkbox' id='A".($answer_index)."' name='value[]' value='A".($answer_index)."'>";
					echo "<label for='A".($answer_index)."' class='square-button'>";
						echo "<img class='small-img' src='http://10.16.1.13/chen_IRS/upload/K".$No_keyboard."A".$answer_index.".".$Arr[$i]."'>";
						//echo "<img src='http://10.16.1.13/chen_IRS/upload/K1A1.png'>";
					echo "</label>";
					echo "</div>";
					if($i % 4 == 3){
						echo "</div>";
					}
					if($i % 4 != 3 && $i == count($Arr)){
						echo "</div>";
					}
				}
			}
		}	
	}
?>
