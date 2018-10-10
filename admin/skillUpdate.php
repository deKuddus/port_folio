<?php
	include "inc/header.php";
	include "inc/sidebar.php"
?>
<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$skillIntro = $format->validation($_POST['skillIntro']);

			$skillOn = implode(",", $_POST["skillOn"]);
			$skillOn = $format->validation($skillOn);

			$expertPercent = $format->validation($_POST['expertPrtcent']);
			$expertLevel = $format->validation($_POST['skillLevel']);
			/*var_dump($expertlevel);
			die;*/
			
			$skillIntro = mysqli_real_escape_string($db->link, $skillIntro);
            $skillOn = mysqli_real_escape_string($db->link, $skillOn); 
            $expertPercent = mysqli_real_escape_string($db->link, $expertPercent);
            $expertLevel = mysqli_real_escape_string($db->link, $expertLevel);

            $skillId = $_GET['skillid'];

		     if($skillIntro == "" OR $skillOn == "" OR $expertPercent == "" OR $expertLevel == ""){
		         $message = "<span class='err'>Input field should not be empty</span>";
		    }elseif($expertPercent < 0 OR $expertPercent > 100 ){
		    	$message = "<span class='err'>Skill percent level can not be Negative or more than 100</span>";
		    }
		     else{

		         $query = " UPDATE   skill_table  SET 
		         skill_intro = '$skillIntro',
		         skill_on = '$skillOn',
		         expert_level = '$expertLevel',
		         expert_percent = '$expertPercent'
		         WHERE id = '$skillId'";
		         $updated_rows = $db->update($query);
		         if($updated_rows){
		             $message =   "<span class='succes'> Skill Information updated  Successfully.</span>";
		         }
		         else{
		             $message = "<span class='err'>Skill Information not Updated.</span>";
		         }

		         



		     }

	}
?>

  <div class="grid_10">
		
            <div class="box round first grid">
                <h2> Add Skill </h2>
                <?php echo $message; ?>
                <div class="block" style="width: 700px;margin:  0 auto;">  
         			<?php 
         			if(isset($_GET['skillid']) AND isset($_GET['expertlevel'])){

         				$skillId = $_GET['skillid'];
         				$expert_level = $_GET['expertlevel'];
         				}
         				$query = "SELECT * FROM skill_table WHERE id = '$skillId'";
         				$all_data = $db->select($query);
         				if($all_data){
         					foreach ($all_data as $data) {

         			?>             
                  <form action="" method="POST">

						<div class="form-group">
					    <label for="skillOn">Skill ON: </label>
					    <input type="text" class="form-control" id="skillOn"  name="skillOn[]" value = "<?php echo $data['skill_on'];?>">
						</div>
											    	
					   <div class="form-group">
					    <label for="expertPrtcent">Expert Level on Percent: </label>
					    <input type="number"class="form-control" id="expertPrtcent" name = "expertPrtcent" value = "<?php echo $data['expert_percent'];?>"/>
						</div>

						<div class="form-group" >
					    <label for="skillLevel" >Skill Level: </label></br>
					    <select id="skillLevel" name ="skillLevel" class="form-control">
								<?php 
									$query = "SELECT * FROM expert_level ORDER BY id";
									$all_data = $db->select($query);
									if($all_data){
										foreach ($all_data as $expert_level) {
										
								?>
								<option value="<?php echo $expert_level['id'];?>" <?php  if($data['expert_level'] == $expert_level['id']) { ?>
											selected = "selected"
										<?php } ?>

									><?php echo $expert_level['expert_level_name'];?></option>
							<?php } } ?>
							</select>

					    </div>

					      <div class="form-group">
					    <label for="skillIntro">Skill Intro: </label>
					    <textarea rows="5" class="form-control" id="skillIntro" name="skillIntro"><?php echo $data['skill_intro'];?></textarea>
						</div>
					    

						
					  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form> 
					<?php }} ?>       
                </div>
            </div>
        </div>



<?php include "inc/footer.php";?>