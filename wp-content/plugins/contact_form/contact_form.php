<?php
/**
* Plugin Name: Contact Form
* Plugin URI: 
* Description: Collect user information
* Version: 1.0.0
* Author: Hayat Ali
* Author URI: 
* License: GPL2
*/

// Plugin Activation
function contact_form_activate() 
{
    global $wpdb;
    if(!get_option('tables_created', false)) {
        global $wpdb;
        $ptbd_table_name = 'cf_contact_form'; // cf_contact_form (contact form)
        if ($wpdb->get_var("SHOW TABLES LIKE '". $ptbd_table_name ."'"  ) != $ptbd_table_name ) {
            $sql  = 'CREATE TABLE '.$ptbd_table_name.'(
            id INT(20) AUTO_INCREMENT,
            user_name VARCHAR(255),
            user_email VARCHAR(255),
            user_query VARCHAR(255),
            order_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY(id))';

            if(!function_exists('dbDelta')) {
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            }
            $wpdb->get_results($sql);
            update_option('tables_created', true);
        }
    }
}
// Plugin Deactivation
function contact_form_deactivate()
{
    global $wpdb;
    $ptbd_table_name = 'cf_contact_form'; // cf_contact_form (contact form)
    if ($wpdb->get_var("SHOW TABLES LIKE '". $ptbd_table_name ."'"  ) == $ptbd_table_name ) {
        $sql  = ' DROP TABLE '.$ptbd_table_name;
        $wpdb->get_results($sql);
        update_option('tables_created', false);
    }
}
add_action( 'activated_plugin','contact_form_activate');
register_deactivation_hook( 'deactivate_plugin', 'contact_form_deactivate' );

// Show Contact Form
add_shortcode('contact_form', 'display_contact_form');
function display_contact_form() 
{
    $html ='<form method="POST" class="mx-0 w-0">
                <div class="mb-3">
                    <label for="Name" class="form-label">Name</label>
                    <input name="username" type="text" class="form-control" id="name">
                    <span class="text-danger">
                        <?php echo (isset($_SESSION["errors"]) && isset($_SESSION["errors"]["username"])) ? $_SESSION["errors"]["username"] : ""; ?>
                    </span>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input name="useremail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Well never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                    <textarea name="userquery" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="mb-3 d-flex justify-content-end">
                    <button name="add_data" type="submit" class="btn btn-primary">Submit Your Query</button>
                </div>
            </form>';
    return $html;
}
// Insert form
function insert_form()
{
    if(isset($_POST['add_data']))
    {
        global $wpdb;
        $tableName='cf_contact_form';
        $userName=$_POST['username'];
        $userEmail=$_POST['useremail'];
        $userPass=$_POST['userquery'];
        $wpdb->insert(
            $tableName,
            array(
                'user_name'=>$userName,
                'user_email'=>$userEmail,
                'user_query'=>$userPass,
            )
        );
    }
}

add_action('init', 'insert_form');

add_shortcode('show_data', 'display_custom_data');
function display_custom_data() 
{
    global $wpdb;
    $table_name = 'cf_contact_form';
    $results = $wpdb->get_results('SELECT * FROM ' . $table_name);
    ob_start(); ?>
<table class="data-table display">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Query</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $result) { ?>
        <tr>
            <td><?php echo esc_html($result->user_name); ?></td>
            <td><?php echo esc_html($result->user_email); ?></td>
            <td><?php echo esc_html($result->user_query); ?></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="delete_data" value="<?php echo $result->id; ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-primary update-data" data-bs-toggle="modal"
                        data-bs-target="#update-data" data-action="update" data-name="<?php echo $result->user_name; ?>"
                        data-email="<?php echo $result->user_email; ?>"
                        data-query="<?php echo $result->user_query; ?>">Update</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<div class="modal fade" id="update-data" tabindex="-1" aria-labelledby="update-dataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user_name1">: </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body show-data">
                <form method="POST" action="" name="submitform">
                    <input type="hidden" value="<?php echo $result->id; ?>" name="updatedata">
                    <div class="mb-3">
                        <label for="Name" class="form-label">Update Name</label>
                        <input name="updated_name" type="text" class="form-control" id="user_name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Update Email address</label>
                        <input name="updated_email" type="email" class="form-control" id="user_email"
                            aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                        <textarea name="updated_query" class="form-control" id="updated_query" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="update_data" value="">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fetch Data in Modal -->
<script>
jQuery(document).ready(function($) {
    $('.update-data').click(function() {
        var name = $(this).data("name");
        var email = $(this).data("email");
        var query = $(this).data("query");
        $('#user_name1').html('<b> Update User: </b>' + name);
        $('#user_name').val(name);
        $('#user_email').val(email);
        $('#updated_query').val(query);
    });
});
</script>
<?php return ob_get_clean();
}
// Delete Custom Data
add_action('init', 'delete_custom_data');
function delete_custom_data()
{
    if (isset($_POST['delete_data'])) {
        global $wpdb;
        $table_name = 'cf_contact_form';
        $id_to_delete = $_POST['delete_data'];
        $wpdb->delete($table_name, array('id' => $id_to_delete));
    }
}
// Update custom Data
add_action('init', 'update_modal_data');
function update_modal_data(){
    if (isset($_POST['updatedata'])) {
        global $wpdb;
        $table_name = 'cf_contact_form';
        $id_to_update = $_POST['updatedata'];
        $updatedName=$_POST['updated_name'];
        $updatedEmail=$_POST['updated_email'];
        $updatedQuery=$_POST['updated_query'];
        $wpdb->update(
            $table_name,
            array(
                'user_name' => $updatedName,
                'user_email' => $updatedEmail,
                'user_query' => $updatedQuery,
            ),
            array('id' => $id_to_update)
        );
    }
}

// Add custom menu item to Wordpress dashboard
add_action('admin_menu', 'add_custom_menu_item');
function add_custom_menu_item() 
{
    add_menu_page(
        'Contact Us',            // Page title
        'Contact Us',            // Menu title
        'manage_options',        // Capability required to access
        'contact_us_admin',      // Menu slug (should be unique)
        'contact_menu_page',     // Callback function to display the page
        'dashicons-email',       // Icon for the menu item (optional)
        99                       // Position in the menu (optional)
    );
}
function contact_menu_page() 
{
    echo '<div class="wrap">';
    echo '<h2>Contact Us Page</h2>';
    if (isset($_GET['page']) && $_GET['page'] == 'contact_us_admin') {
        echo do_shortcode('[show_data]');
    }
    echo '</div>';
}

// Initializing Data Table
add_action('wp_footer', 'initialize_dataTable_script');
function initialize_dataTable_script() 
{ ?>
<script>
jQuery(document).ready(function($) {
    $('.data-table').DataTable();
});
</script>
<?php }