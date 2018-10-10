<?php
include "inc/header.php";
include "inc/sidebar.php"
?>
<?php
    if(isset($_GET['skill_intro_id'])){
        $skill_intro_id = $_GET['skill_intro_id'];

        $deleteQuery = "DELETE FROM skill_intro_table WHERE id = '$skill_intro_id'";
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
                    <th width="30%">NO.</th>
                    <th width="40%">Skill On</th>
                    <th width="30%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM skill_intro_table ORDER BY id";
                $allData = $db->select($query);
                if ($allData){
                    $i=0;
                    foreach ($allData as  $data) {
                        $i++;

				?>
                <tr class="odd gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $format->textShort($data['skill_intro'],100) ?></td>
                    <td>
                        
                       <a href="skillIntroUpdate.php?skill_intro_id=<?php echo $data['id'];?>">Edit</a>||

                        <a onclick="return confirm('are you sure to delete post');" href="?skill_intro_id=<?php echo $data['id']?>">Delete</a></td>
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