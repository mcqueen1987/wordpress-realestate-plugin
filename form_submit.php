<?php
/**
 * Created by xudongbo.
 * User: xudongbo
 * Date: 24/06/19
 * Time: 1:12 AM
 */
require_once(dirname(dirname(__FILE__)) . '/../wp-load.php');

// get xml file
$path = $_FILES["fileToUpload"]['tmp_name'];
if (empty($path)) {
    return;
}
$originalXml = simplexml_load_string(file_get_contents($path));

// save each properties as post
foreach ($originalXml->residential as $residential) {
    $address = implode([
        $residential->address->streetNumber,
        $residential->address->street,
        $residential->address->suburb,
        $residential->address->city,
        $residential->address->state,
        $residential->address->postcode,
    ], ', ');
    $id = isset($user_ID) ? (int)$user_ID : 0;
    // save property info as post_content in each post
    $new_post = array(
        'ID' => '',
        'post_author' => $id,
        'post_category' => array("property"),
        'post_content' => $residential->asXML(),
        'post_title' => $address,
        'post_status' => 'publish',
        'post_type' => 'property',
    );
    $post_id = wp_insert_post($new_post);
}

// redirect you to the newly created post
$post = get_post($post_id);
wp_redirect($post->guid);

