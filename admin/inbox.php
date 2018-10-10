<?php
include "inc/header.php";
include "inc/sidebar.php"
?>
<?php
    if(isset($_GET['contactId'])){
        $contactId = $_GET['contactId'];

        $deleteQuery = "DELETE FROM user_contact_table WHERE id = '$contactId'";
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
    if($_GET['seenId']){
        $seenId = $_GET['seenId'];
        $update_query = "UPDATE user_contact_table SET status = '1' WHERE id = '$seenId'";
        $updated_rwo = $db->update($update_query);

    }



?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Unseen Message</h2>
        <div class="block">
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th width="10%">NO.</th>
                    <th width="30%">Contact Email</th>
                    <th width="30%">Contact Text</th>
                    <th width="30%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM user_contact_table WHERE status = '0' ORDER BY id DESC";
                $allData = $db->select($query);
                if ($allData){
                    $i=0;
                    foreach ($allData as  $data) {
                        $i++;

				?>
                <tr class="odd gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['contact_email'] ?></td>
                    <td><?php echo $format->textShort($data['contact_text']); ?></td>
                     <td>
                        
                       <a class="btn btn-info btn-sm"  href="viewContact.php?contactId=<?php echo $data['id'];?>&&contactEmail=<?php echo $data['contact_email'];?>">View</a> ||

                        <a class="btn btn-primary btn-sm" onclick="return confirm('are you sure to delete post');" href="?contactId=<?php echo $data['id']?>">Delete</a>
                        ||

                        <a class="btn btn-primary btn-sm" onclick="return confirm('are you sure you have seened it??');" href="?seenId=<?php echo $data['id']?>">Seen</a>

                    </td>
 				</tr>
            <?php }}?>
            </tbody>
        </table>

       </div>
    </div>
</div>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Seen Message</h2>
        <div class="block">
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th width="20%">NO.</th>
                    <th width="30%">Contact Email</th>
                    <th width="30%">Contact Text</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM user_contact_table WHERE status = '1' ORDER BY id DESC";
                $allData = $db->select($query);
                if ($allData){
                    $i=0;
                    foreach ($allData as  $data) {
                        $i++;

                ?>
                <tr class="odd gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['contact_email'] ?></td>
                    <td><?php echo $format->textShort($data['contact_text'],50); ?></td>
                     <td>
                        
                       <a class="btn btn-info btn-sm"  href="viewContact.php?contactId=<?php echo $data['id'];?>&&contactEmail=<?php echo $data['contact_email'];?>">View</a> ||

                        <a class="btn btn-primary btn-sm" onclick="return confirm('are you sure to delete post');" href="?contactId=<?php echo $data['id']?>">Delete</a>

                    </td>
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