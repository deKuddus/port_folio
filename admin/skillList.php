<?php
include "inc/header.php";
include "inc/sidebar.php"
?>
<?php
    if(isset($_GET['skillid'])){
        $skillId = $_GET['skillid'];

        $deleteQuery = "DELETE FROM skill_table WHERE id = '$skillId'";
        $success = $db->delete($deleteQuery);
        if($success){
            echo "<script>
                    $( document ).ready(function() {
                            alert('Data  deleted success fully');
                            location.window = 'view.php';
                        });
                </script>";
        }else{
            echo "<script>
                    $( document ).ready(function() {
                            alert('Data NOT deleted success fully');
                            location.window = 'view.php';
                        });
                </script>";
}

    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>My Data</h2>
        <div class="block">
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th width="10%">NO.</th>
                    <th width="20%">Skill On</th>
                    <th width="25%">Expert Level</th>
                    <th width="25%">Expert Percent</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM skill_table ORDER BY id";
                $allData = $db->select($query);
                if ($allData){
                    $i=0;
                    foreach ($allData as  $data) {
                        $i++;

				?>
                <tr class="odd gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['skill_on'] ?></td>
                    <td><?php 
                    if($data['expert_level'] ==1){
                        echo "Expert";
                    }elseif($data['expert_level'] == 2){
                        echo "Intermidiate";
                    }else{
                        echo "Beginner";
                    }

                    ?></td>
                    <td><?php echo $data['expert_percent'];  ?></td>

                    <td>
                        
                       <a href="skillUpdate.php?skillid=<?php echo $data['id'];?>&&expertlevel=<?php echo $data['expert_level'];?>">Edit</a>||

                        <a onclick="return confirm('are you sure to delete post');" href="?skillid=<?php echo $data['id']?>">Delete</a></td>
 				</tr>
            <?php }}?>
            </tbody>
        </table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>


<?php include "inc/footer.php";?>