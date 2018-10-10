        <style type="text/css">
            .item:a{hover:black;}
        </style>

          <div class="secondary col-lg-4 col-12">
                 <aside class="info aside section">
                    <div class="section-inner">
                        <h2 class="heading sr-only">Basic Information</h2>
                        <div class="content">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-map-marker-alt"></i><span class="sr-only">Location:</span>Foy's Lake, Chittagong,Bangladesh</li>
                                <li><i class="fas fa-envelope"></i><span class="sr-only">Email:</span><a href="#">ma.kuddus37@gmail.com</a></li>
                                <li><i class="fas fa-link"></i><span class="sr-only">Website:</span><a href="#">https://www.website.com</a></li>
                            </ul>
                        </div><!--//content-->  
                    </div><!--//section-inner-->                 
                </aside><!--//aside-->
                
                <aside class="skills aside section">
                    <div class="section-inner">
                        <h2 class="heading">Skills</h2>
                        <div class="content">
                            <?php 
                                $skill_query = "SELECT * FROM skill_intro_table ORDER BY id DESC LIMIT 1";
                                $selected_row = $db->select($skill_query);
                                if($selected_row){
                                    foreach ($selected_row as $data) {
                            ?>
                            <p class="intro">
                                 <?php echo $format->textShort($data['skill_intro'],100);?>
                            </p>
                            <?php }} ?>
                            <div class="skillset">
                               
                                <div class="item">

                                     <?php 
                                        $skill_query = "SELECT * FROM skill_table ORDER BY id";
                                        $selected_row = $db->select($skill_query);
                                        if($selected_row){
                                            foreach ($selected_row as $data) {
                                                $explode_data = explode(" , " ,$data['skill_on']);
                                    ?>
                                    <h3 class="level-title"><?php foreach ($explode_data as $value){
                                        echo $value;
                                    }?><p style="font-size: 9px;">
                                        <?php 
                                            if($data['expert_level'] == 1){
                                                echo "Expert";
                                            }elseif($data['expert_level'] == 2){
                                                echo "Intermidiae";
                                            }else{
                                                echo "Beginer";
                                            }
                                        ?>

                                    </p>
                                </h3>
                                    <div class="progress">
                                        <!-- <div class="level-bar-inner" data-level="96%">
                                        </div>  --> 
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $data['expert_percent'];?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>                                    
                                    </div><!--//level-bar--> </br>
                                    <?php } } ?>                                
                                </div><!--//item-->
                                
                                <p><a class="more-link" href="#"><i class="fas fa-external-link-alt"></i>More on Coderwall</a></p> 
                            </div>              
                        </div><!--//content-->  
                    </div><!--//section-inner-->                 
                </aside><!--//section-->
                
                <aside class="testimonials aside section">
                    <div class="section-inner">
                        <h2 class="heading">Testimonials</h2>
                        <div class="content">
                            <div class="item">
                              <?php 
                                    $skill_query = "SELECT * FROM testimonial_table ORDER BY id DESC";
                                    $selected_row = $db->select($skill_query);
                                    if($selected_row){
                                        foreach ($selected_row as $data) {
        
                                ?>
                                <blockquote class="quote">                                  
                                    <p><i class="fas fa-quote-left"></i><?php echo $data['testimonial_text'];?></p>
                                </blockquote>                
                                <p class="source"><span class="name"><?php echo $data['testimonial_by'];?></span><br /><span class="title"><?php echo $data['testimonial_profession'];?></span></p>          
                            <?php } }  ?>                                                   
                            </div><!--//item-->
                            
                            <p><a class="more-link" href="https://www.linkedin.com/in/abdulkuddus37/"><i class="fas fa-external-link-alt"></i>More on Linkedin</a></p> 
                            
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->
                
                <aside class="education aside section">
                    <div class="section-inner">
                        <h2 class="heading">Education</h2>
                        <div class="content">
                            <?php
                                $query = "SELECT * FROM education_table ORDER BY id DESC";
                                $allData = $db->select($query);
                                if ($allData){
                                    $i=0;
                                    foreach ($allData as  $data) {
                                        $i++;

                            ?>
                            <div class="item">                      
                                <h3 class="title"><i class="fas fa-graduation-cap"></i><?php echo $data['graduation_title'];?></h3>
                                <h4 class="university"><?php echo $data['institution'];?>
                                <span class="year">  (<?php echo $data['start_date'];?> - 
                                    <?php  if($data['end_date'] == ""){
                                    echo "Present Now";
                                    }else{
                                        echo $data['end_date'];
                                    }?>
                                )</span>
                                </h4>
                            </div><!--//item-->
                           <?php } } ?>
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->
                            
                <aside class="languages aside section">
                    <div class="section-inner">
                        <h2 class="heading">Languages</h2>
                        <div class="content">
                            <ul class="list-unstyled">
                                 <?php
                                    $query = "SELECT * FROM language_table ORDER BY id";
                                    $allData = $db->select($query);
                                    if ($allData){
                                        foreach ($allData as  $data) {
                                     ?>
                                <li class="item">
                                    <span class="title"><strong><?php echo $data['language_name']; ?>:</strong></span>
                                    <span class="level"><?php echo $data['language_familiar']; ?> <br class="visible-xs"/><i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> </span>
                                </li><!--//item-->
                               <?php } } ?>
                            </ul>
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->
                
                  <aside class="list music aside section">
                    <div class="section-inner">
                        <h2 class="heading">Latest Blog Post</h2>
                        <div class="content">
                          <?php 
                                $query = "SELECT * FROM post_table ORDER BY id DESC LIMIT 3";
                                $allPost =  $db->select($query);
                                if($allPost){
                                    foreach ($allPost as $result) {
                            ?>
                             <div class="item">
                                <h3 class="title"> <?php echo $result['title'] ?> - <!-- <span class="place"><a href="#">Startup Hub</a></span> --> <span class="year" style="font-size: 12px;">( <?php echo $result['date']; ?>)</span></h3>
                                <p style="text-align: justify;"> <?php echo $format->textShort($result['body'],50); ?>... <a href="detailsPost.php?postId=<?php echo $result['id'];?>&&postTitle=<?php echo $result['title'];?>" style="padding: 5px;border-radius: 4px; border: 1px solid black;color: gray;text-decoration: none;">see more</a> </p>
                            </div><!--//item-->
                            <?php }} ?>
                            <button class="btn btn-info">See more blog post</button>
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->
                
                
                <aside class="list music aside section">
                    <div class="section-inner">
                        <h2 class="heading">Favourite coding music</h2>
                        <div class="content">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-headphones"></i> <a href="#">Etiam hendrerit urna nunc</a></li>
                                <li><i class="fas fa-headphones"></i> <a href="#">Ut sollicitudin in mauris non auctor</a></li>
                                <li><i class="fas fa-headphones"></i> <a href="#">Etiam hendrerit urna nunc</a></li>
                                <li><i class="fas fa-headphones"></i> <a href="#">Duis et felis bibendum</a></li>
                            </ul>
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->
                
                <aside class="list conferences aside section">
                    <div class="section-inner">
                        <h2 class="heading">Conferences</h2>
                        <div class="content">
                            <ul class="list-unstyled">
                                <li><i class="far fa-calendar-alt"></i> <a href="#" target="_blank">WWDC 2014</a> (San Francisco)</li>
                                <li><i class="far fa-calendar-alt"></i> <a href="#">Hive</a> (Seattle)</li>
                            </ul>
                        </div><!--//content-->
                    </div><!--//section-inner-->
                </aside><!--//section-->
              
            </div><!--//secondary-->    
        </div><!--//row-->
    </div><!--//masonry-->
    
   

