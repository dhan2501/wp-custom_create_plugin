<?php
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix.'emp';
    $q = "SELECT * FROM `$wp_emp`";
    $results = $wpdb->get_results($q);

    // print_r($result);
    ob_start();
?>
<div class="wrap">
<table class="wp-list-table widefat fixed striped table-view-list posts">
    <thead>
    <tr>
        <td>Id</td>
        <td>Name</td>
        <td>Email</td>
        <td>Phone</td>
    </tr>
</thead>
<tbody>
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