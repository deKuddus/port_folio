<?php
include "inc/header.php";
include "inc/sidebar.php";
?>
<?php 
    if($_GET['postdeleteID']){
        $postdeleteID = $_GET['postdeleteID'];
        $deleteQuery = "DELETE FROM post_table WHERE id = '$postdeleteID'";
        $success = $db->delete($deleteQuery);
        if($success){
            $message = "<div class = 'succ'>Post has been deleted sluccesfully.</div>";
        }else{
            $message = "<div class = 'err'>Post Not deleted sluccesfully.</div>";
        }
    }
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <?php echo $message; ?>
        <div class="block">
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th width="5%">NO.</th>
                    <th width="15%">Post Title</th>
                    <th width="10%">Description</th>
                    <th width="15%">Category</th>
                    <th width="10%">Tag</th>
                    <th width="10%">Author</th>
<!--                     <th width="10%">image</th>
 -->                    <th width="15%">Date</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT post_table.*, category_table.category_name FROM post_table INNER JOIN category_table ON post_table.category =category_table.id ORDER BY post_table.id DESC";
                
                $selected_rows = $db->select($query);
                if ($selected_rows){
                    $i=0;
                    foreach ($selected_rows as $data) {
                      
                        $i++;


                        ?>
                <tr class="odd gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['title'] ?></a></td>
                    <td><?php echo $format->textShort($data['body'],50);  ?></td>
                    <td><?php echo $data['category_name'] ?></td>
                    <td><?php echo $data['tag'] ?></td>
                    <td><?php echo $data['author'] ?></td>
                    <!-- <td><img src="<?php /*echo $data['image']*/ ?>" height="40px" width="40px" alt=""></td> -->
                    <td><?php echo $format->dateFormat($data['date']); ?></td>

                    <td>
                        <a href="postView.php?viewpostid=<?php echo $data['id']?>">View</a> ||
                        
                       <a href="postUpdate.php?postEditID=<?php echo $data['id']?>">Edit</a> ||

                        <a onclick="return confirm('are you sure to delete post');" href="?postdeleteID=<?php echo $data['id']?>">Delete</a></td>



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