<?php
/**
 * User: xudongbo
 * Date: 23/06/19
 * plugin name: test_plugin
 * plugin URI: http://dongboxu.com/test_plugin
 * description: A simple plugin to add xml file to posts.
 * author: xudongbo
 * author URI: http://dongboxu.com
 * version: 1.0
 */

// add plugin to left menu
function register_menu_plugin()
{
    add_menu_page("test_plugin", "test_plugin", 8, __FILE__, "test_plugin");
}

// content page of plugin
function test_plugin()
{ ?>
    <h1>WordPress Extra Post Info</h1>
    <form enctype="multipart/form-data" method="post"
          action="<?php echo plugins_url('form_submit.php', __FILE__); ?>">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Extra post info:</th>
                    <td>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </td>
                </tr>
            </table>
        <?php submit_button(); ?>
    </form>
<?php }

// add action register_menu_plugin hook to admin-menu
if (is_admin()) {
    add_action("admin_menu", "register_menu_plugin");
}
