<?php
/**
 * Created by PhpStorm.
 * Company: MuellerTek
 * User: Micheal Mueller
 * Date: 2/22/2018
 * Time: 3:16 PM
 */

$user = $_COOKIE['user'];
$page = $_COOKIE['page'];

$user = explode(',', $user);

foreach($user as $value){
    $values = preg_replace('/{/','', $value);
    $values = preg_replace('/"/','', $values);
    $values = explode(':', $values);
    $data['user'][$values[0]] = $values[1];
}

require '../../colormarketing.org/public_html/wp-load.php';

$wordpress = new wp();

if(!username_exists($data['user']['username'])){
    //send them to the login to be added.

    header('Location:http://colormarketing.org/digital-color-forecasts/');
}else {
    $username = $data['user']['username'];

    $user_id = username_exists($username);
    $userdata = get_userdata($user_id);
    $user = set_current_user($user_id);


    if(is_wp_error($user)) {
        echo $user->get_error_message();
    }else{
        if(wp_validate_auth_cookie() == false) {
            wp_set_auth_cookie($user_id, true);
        }
    }
    //do_action('wp_login', $userdata->ID, $user);
    //wp_login($username, $pass);
    //do_action('wp_login', $username, $userdata);

    header('Location:'.$page);
}


?>
