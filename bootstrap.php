<?php
/*
Plugin Name: Meta View Count
Description: Simple counter for posts and pages, working through cache mechanism (like W3 Total Cache, Hyper Cache etc.).
Author: Oncle Tom
Version: 1.0.0-dev
Author URI: http://case.oncle-tom.net/
Plugin URI: http://wordpress.org/extend/plugins/meta-view-count/

  This plugin is released under version 3 of the GPL:
  http://www.opensource.org/licenses/gpl-3.0.html
*/

require dirname(__FILE__) . '/lib/Object.php';
require dirname(__FILE__) . '/lib/Receiver.php';
require dirname(__FILE__) . '/lib/Setup.php';

add_action('wp_ajax_update_view_count', array('MetaViewCountSetup', 'AjaxHandler'));
add_action('wp_ajax_nopriv_update_view_count', array('MetaViewCountSetup', 'AjaxHandler'));
add_action('wp', array('MetaViewCountSetup', 'Wp'));
