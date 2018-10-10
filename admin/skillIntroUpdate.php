<?php
	include "inc/header.php";
	include "inc/sidebar.php"
?>
<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$skillIntro = $format->validation($_POST['skillIntro']);

            $skillIntro = mysqli_real_escape_string($db->link, $skillIntro);
            $skill_intro_id = $_GET['skill_intro_id'];

           
		     if($skillIntro == ""){
		         $message = "<span class='err'>Input field should not be empty</span>";
		    }
		     else{
		     	$query_skill = "UPDATE  skill_intro_table SET skill_intro = '$skillIntro' WHERE id = '$skill_intro_id'";
		     	$updated_skill_rows = $db->update($query_skill);
		     	if($updated_skill_rows){

		             $message =   "<span class='succes'> Skill Information Updated  Successfully.</span>";
		         }
		         else{
		             $message = "<span class='err'>Skill Information not updated</span>";
		         }

		         
		  


		     }

	}
?>


  <div class="grid_10">
		
            <div class="box round first grid">
                <h2> Update  Skill  Intro</h2>
                <?php echo $message; ?>
                <div class="block" style="width: 700px;margin:  0 auto;"> 
                <?php 
                	if(isset($_GET['skill_intro_id'])){
                		$skill_intro_id = $_GET['skill_intro_id'];
                	}
                	 $query = "SELECT * FROM skill_intro_table WHERE id = '$skill_intro_id'";
                	$selected_row = $db->select($query);
                	if($selected_row){
                		foreach ($selected_row as $data) {

                	
                ?>              
                  <form action="" method="POST">					

					     <div class="form-group">
					    <label for="skillIntro">Skill Intro: </label>
					    <textarea rows="5" class="form-control" id="skillIntro" name="skillIntro"><?php echo $data['skill_intro'];?></textarea>
						</div>
					    

						
					  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form> 
					<?php 	} } ?>       
                </div>
            </div>
        </div>


<?php include "inc/footer.php";?>