<?php
include( dirname(__FILE__).'/../config/config.php');

global $wpdb;

$query = "DELETE FROM $wpdb->term_relationships  WHERE object_id IN ( SELECT ID FROM $wpdb->posts WHERE  post_type IN ( 'socialdb_collection', 'socialdb_object') );";
$result = $wpdb->get_results($query);

$query = "DELETE FROM $wpdb->postmeta WHERE post_id IN ( SELECT ID FROM $wpdb->posts  WHERE post_type IN ( 'socialdb_collection', 'socialdb_object') );";
$result = $wpdb->get_results($query);

$query = "DELETE FROM $wpdb->posts WHERE post_type IN ( 'socialdb_collection', 'socialdb_object') ;";
$result = $wpdb->get_results($query);

$query = "DELETE FROM $wpdb->termmeta WHERE term_id NOT IN ( SELECT t.term_id FROM $wpdb->terms t 
INNER JOIN $wpdb->term_taxonomy tt ON t.term_id = tt.term_id WHERE tt.taxonomy in ('socialdb_category_type', 'socialdb_property_type', 'socialdb_tag_type') );";
$result = $wpdb->get_results($query);

$query = "DELETE FROM $wpdb->terms  WHERE term_id IN ( SELECT tt.term_id FROM $wpdb->term_taxonomy tt WHERE tt.taxonomy in ('socialdb_category_type', 'socialdb_property_type', 'socialdb_tag_type') );";
$result = $wpdb->get_results($query);

$query = "DELETE FROM $wpdb->term_taxonomy WHERE taxonomy in ('socialdb_category_type', 'socialdb_property_type', 'socialdb_tag_type');";
$result = $wpdb->get_results($query);

delete_option('collection_root_id');