<?php
	include "inc/header.php";
	include "inc/sidebar.php"
?>
<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$languageName = $format->validation($_POST['languageName']);
			$laguageFamiliar = $format->validation($_POST['laguageFamiliar']);
			
			$languageName = mysqli_real_escape_string($db->link, $languageName);
            $laguageFamiliar = mysqli_real_escape_string($db->link, $laguageFamiliar); 

            $languageId = $_GET['languageId'];
           
		     if($languageName == "" OR $laguageFamiliar == ""){
		         $message = "<span class='err'>Input field should not be empty</span>";
		    }
		     else{
		     	$query_language = "UPDATE language_table SET 
		     	language_name = '$languageName',
		     	language_familiar = '$laguageFamiliar'
		     	WHERE id = '$languageId'";
		     	$inserted_language_rows = $db->update($query_language);
		     	if($inserted_language_rows){

		             $message =   "<span class='succes'> Language Information Updated  Successfully.</span>";
		         }
		         else{
		             $message = "<span class='err'>Language Information not Updated</span>";
		         }

		      }

	}
?>


  <div class="grid_10">
		
            <div class="box round first grid">
                <h2> Add Language </h2>
                <?php echo $message; ?>
                <div class="block" style="width: 700px;margin:  0 auto;">   
                	<?php
                		if(isset($_GET['languageId'])){
                			$languageId = $_GET['languageId'];
                		}
		                $query = "SELECT * FROM language_table WHERE id = '$languageId'";
		                $allData = $db->select($query);
		                if ($allData){
		                  foreach ($allData as  $data) {
		                       
				?>
                  <form action="" method="POST">
					 
                  	 <div class="form-group">
					    <label for="languageName">Language Name: </label>
					    <input type="text"class="form-control" id="languageName"   name="languageName" value="<?php echo $data['language_name'];?>" />
						</div>
						
						 <div class="form-group">
					    <label for="laguageFamiliar">Familiar with: </label>
					    <textarea rows="5" class="form-control" id="laguageFamiliar" name="laguageFamiliar"><?php echo $data['language_familiar'];?></textarea>
						</div>
					    

						
					  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form> 
				<?php }} ?>
                </div>
            </div>
        </div>


<?php include "inc/footer.php";?>