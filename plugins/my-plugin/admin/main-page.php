<?php
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix.'emp';
    if(isset($_GET['my_search_term'])){
        $q = "SELECT * FROM `$wp_emp` WHERE `name` LIKE '%".$_GET['my_search_term']."%';";
    }else{
        $q = "SELECT * FROM `$wp_emp`";
    }
    // $q = "SELECT * FROM `$wp_emp`";
    $results = $wpdb->get_results($q);

    // print_r($result);
    ob_start();
?>
<div class="wrap">
    <h2>My Plugin Page</h2>
    <div class="my-form">

        <form action="<?php echo admin_url('admin.php');?>" id="my-search-form">
        <input type="hidden" name="page" value="my-plugin-page">
        <input type="text" name="my_search_term" id="my-search-term">
        <input type="submit" value="search" name="search">
        </form>
    </div>
<table class="wp-list-table widefat fixed striped table-view-list posts">
    <thead>
    <tr>
        <td>Id</td>
        <td>Name</td>
        <td>Email</td>
        <td>Phone</td>
    </tr>
</thead>
<tbody id="my-table-result">
    <?php
    foreach($results as $row){
    ?>
    <tr>
        <td><?php echo $row->id; ?></td>
        <td><?php echo $row->name; ?></td>
        <td><?php echo $row->email; ?></td>
        <td><?php echo $row->phone; ?></td>
    </tr>
    <?php
    }
?>
</tbody>
</table>
</div>
<?php
    echo ob_get_clean();