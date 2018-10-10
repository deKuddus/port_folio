<?php 
    include "inc/header.php";

?>
    
    <div class="container sections-wrapper">
        <div class="row">
            <div class="primary col-lg-8 col-12">
                <section class="about section">
                     <div class="section-inner">
                        <h2 class="heading">About Me</h2>
                        <?php
                            $query = "SELECT * FROM user WHERE  id ='1'";
                            $user = $db->select($query);
                            if($user){
                            while ($data = $user->fetch_assoc()){

                            ?>
                           <div class="content">
                            <p><?php echo $data['about'];?></p>
                         
                        </div><!--//content-->
                    <?php } } ?>
                    </div><!--//section-inner-->                 
                </section><!--//section-->
    
                   <section class="latest section">
                    <div class="section-inner">
                        <h2 class="heading">Latest Projects</h2>
                        <div class="content"> 


                        <?php 

                            $query = "SELECT * FROM project_table  ORDER BY id DESC LIMIT 1";
                            $project = $db->select($query);
                            if($project){
                                while($data = $project->fetch_assoc()){
                        ?>   
                                               
                            <div class="item featured text-center">
                                <h3 class="title"><a href="" target="_blank"><?php echo $data['category'];?></a></h3>
                                <p class="summary"><?php echo $data['title'];?></p>
                                <div class="featured-image has-ribbon">
                                    <a href="" target="_blank">
                                    <img class="img-fluid project-image" src="admin/<?php echo $data['image'];?>" alt="project name" />
                                    </a>
                                    <div class="ribbon">
                                        <div class="text">New</div>
                                    </div>
                                </div>
                                    
                                <div class="desc text-left">                                    
                                    <p><?php echo $data['about'];?>.</p>
                                </div><!--//desc-->         
                                <a class="btn btn-cta-secondary" href="" target="_blank"><i class="fas fa-thumbs-up"></i> Back my project</a>                 
                            </div><!--//item-->
                        <?php } } ?>

                            <hr class="divider" />

                            <?php 
                                $query = "SELECT * FROM  project_table ORDER BY id DESC";
                                $projectItems = $db->select($query);
                                if($projectItems){
                                    foreach( $projectItems as $data){

                            ?>

                            <div class="item row">
                                <a class="col-md-4 col-12" href="https://themes.3rdwavemedia.com/bootstrap-templates/resume/instance-bootstrap-portfolio-theme-for-developers/" target="_blank">
                                <img class="img-fluid project-image" src="admin/<?php echo $data['image'];?>" alt="project name" />
                                </a>
                                <div class="desc col-md-8 col-12">
                                    <h3 class="title"><a href="" target="_blank"><?php echo $data['title'];?></a></h3>
                                    <p class="mb-2"><?php echo $format->textShortMin($data['about'],100);?>.</p>
                                    <p><a class="more-link" href="projectDetails.php?projectDetailsId=<?php echo $data['id'];?>" target="_blank"><i class="fas fa-external-link-alt"></i>See Details</a></p>
                                </div><!--//desc-->                          
                            </div><!--//item-->
                            
                    <?php } } ?>
                            
                           
                        </div><!--//content-->  
                    </div><!--//section-inner-->                
                </section><!--//section-->

                
                <section class="projects section">
                    <div class="section-inner">
                        <h2 class="heading">Other Projects</h2>
                        <div class="content">
                             <?php 
                                $query = "SELECT * FROM  project_table ORDER BY id DESC";
                                $projectItems = $db->select($query);
                                if($projectItems){
                                    foreach( $projectItems as $data){

                            ?>

                            <div class="item">
                                <h3 class="title"><a href=""><?php echo $data['category'];?></a> <span class="badge badge-theme">Free</span></h3>
                                <p class="summary"><?php echo $format->textShortMin($data['about'],100);?></p>
                                <p><a class="more-link" href="" target="_blank"><i class="fas fa-external-link-alt"></i>Find out more</a></p>
                            </div><!--//item-->
                            <?php } } ?>


                            <a class="btn btn-cta-secondary" href="#">More on CoderWall <i class="fas fa-chevron-right"></i></a>
                            
                        </div><!--//content-->  
                    </div><!--//section-inner-->                 
                </section><!--//section-->
                
               <section class="experience section">
                    <div class="section-inner">
                        <h2 class="heading">Work Experience</h2>
                        <div class="content">
                            <?php 

                                $query = "SELECT * FROM experience_table ORDER BY id DESC";
                                $selectData = $db->select($query);
                                if($selectData){
                                    foreach ($selectData as  $data) {
                                 
                            ?>

                            <div class="item">
                                <h3 class="title"><?php echo $data['position'];?> - <span class="place"><a href="<?php echo $data['company_web'];?>"><?php echo $data['company_name'];?></a></span> <span class="year">(<?php echo $data['start_date'];?> - <?php
                                    if($data['end_date'] == ""){
                                        echo "Present";
                                    }else{
                                        echo $data['end_date'];
                                    }

                                ?>)</span></h3>
                                <p><?php echo $data['about_job'];?>.</p>
                            </div><!--//item-->
                        
                            <?php } } ?>
                         
                            
                        </div><!--//content-->  
                    </div><!--//section-inner-->                 
                </section><!--//section-->
                <section class="github section">
                    <div class="section-inner">
                        <h2 class="heading">My GitHub</h2>
                        
                            <!-- Prepare a container for your calendar. -->
                            <div class="calendar">
                                <!-- Loading stuff -->
                                Loading the data just for you.
                            </div>

                            <script>
                                GitHubCalendar(".calendar", "kuddus37");
                            </script>
                        
                    </div><!--//secton-inner-->
                </section><!--//section-->
            </div><!--//primary-->


<?php 
    include "inc/sidevar.php";
    include "inc/footer.php";

?>

  