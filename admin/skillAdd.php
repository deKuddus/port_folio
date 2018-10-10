<?php
	include "inc/header.php";
	include "inc/sidebar.php"
?>
<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$skillIntro = $format->validation($_POST['skillIntro']);

			$skillOn = implode(",", $_POST["skillOn"]);
			$skillOn = $format->validation($skillOn);

			$expertPercent = $format->validation($_POST['expertPercent']);
			$expertLevel = $format->validation($_POST['skillLevel']);
			
			$skillIntro = mysqli_real_escape_string($db->link, $skillIntro);
            $skillOn = mysqli_real_escape_string($db->link, $skillOn); 
            $expertLevel = mysqli_real_escape_string($db->link, $expertLevel);
            $expertPercent = mysqli_real_escape_string($db->link, $expertPercent);

           
		     if($skillIntro == "" OR $skillOn == "" OR $expertPercent == "" OR $expertLevel == ""){
		         $message = "<span class='err'>Input field should not be empty</span>";
		    }elseif($expertPercent < 0 OR $expertPercent > 100){
		    	$message = "<span class='err'>Skill percent level can not be Negative or more than 100</span>";
		    }
		     else{
		     	$query_skill = "INSERT INTO skill_intro_table (skill_intro) VALUES ('$skillIntro')";
		     	$inserted_skill_rows = $db->insert($query_skill);
		     	if($inserted_skill_rows){


		         $query = "INSERT INTO   skill_table (skill_on,expert_level,expert_percent) VALUES ('$skillOn', '$expertLevel', '$expertPercent')";
		         $inserted_rows = $db->insert($query);
		         if($inserted_rows){
		             $message =   "<span class='succes'> Skill Information Added  Successfully.</span>";
		         }
		         else{
		             $message = "<span class='err'>Skill Information not Added</span>";
		         }

		         
		     }


		     }

	}
?>


  <div class="grid_10">
		
            <div class="box round first grid">
                <h2> Add Skill </h2>
                <?php echo $message; ?>
                <div class="block" style="width: 700px;margin:  0 auto;">               
                  <form action="" method="POST">
					 

						<div class="form-group">
					    <label for="skillOn">Skill ON: </label>
					    <input type="text" class="form-control" id="skillOn"  name="skillOn[]" placeholder="Enter Skill">
						</div>

					<!-- 	<div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">1</label>
						</div> -->

											    	
					   <div class="form-group">
					    <label for="expertPercent">Expert Level on Percent: </label>
					    <input type="number"class="form-control" id="expertPercent"  maxlength = "100" name="expertPercent"/>
						</div>

						<div class="form-group">
					    <label for="skillLevel" >Skill Level: </label></br>
							<select id="skillLevel" name ="skillLevel" class="form-control">
								<?php 
									$query = "SELECT * FROM expert_level ORDER BY id";
									$all_data = $db->select($query);
									if($all_data){
										foreach ($all_data as $expert_level) {
										
								?>
								<option value="<?php echo $expert_level['id'];?>"><?php echo $expert_level['expert_level_name'];?></option>
							<?php } } ?>
							</select>
					    </div>

					     <div class="form-group">
					    <label for="skillIntro">Skill Intro: </label>
					    <textarea rows="5" class="form-control" id="skillIntro" name="skillIntro"></textarea>
						</div>
					    

						
					  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>        
                </div>
            </div>
        </div>


<?php include "inc/footer.php";?>