<?php

include( dirname(__FILE__).'/../config/config.php');

delete_term_meta( CATEGORY_ROOT_ID, 'socialdb_category_property_id');

global $wpdb;

$query = "DELETE FROM $wpdb->term_relationships  WHERE object_id IN ( SELECT post_id FROM $wpdb->postmeta  WHERE  meta_key LIKE 'socialdb_object_collection' AND  meta_value LIKE '".COLLECTION_ID."' );";
$result = $wpdb->get_results($query);

$query = "DELETE FROM $wpdb->postmeta WHERE post_id IN ( SELECT ID FROM $wpdb->posts  WHERE post_parent = " . COLLECTION_ID . " );";
$result = $wpdb->get_results($query);

$query = "DELETE FROM $wpdb->posts WHERE post_parent = " . COLLECTION_ID . " ;";
$result = $wpdb->get_results($query);

$query = "DELETE FROM $wpdb->terms  WHERE term_id IN ( SELECT term_id FROM $wpdb->termmeta  WHERE  meta_key LIKE 'tainacan_imported' AND  meta_value LIKE 'tainacan_imported' );";
$result = $wpdb->get_results($query);

$query = "DELETE FROM $wpdb->term_taxonomy WHERE term_id IN ( SELECT term_id FROM $wpdb->termmeta  WHERE  meta_key LIKE 'tainacan_imported' AND  meta_value LIKE 'tainacan_imported' );";
$result = $wpdb->get_results($query);

$query = "DELETE FROM $wpdb->termmeta WHERE term_id NOT IN ( SELECT term_id FROM $wpdb->terms );";
$result = $wpdb->get_results($query);

$query = "DELETE FROM $wpdb->terms  WHERE term_id IN ( SELECT tt.term_id FROM $wpdb->term_taxonomy tt WHERE tt.taxonomy in ('socialdb_tag_type') );";
$result = $wpdb->get_results($query);

$query = "DELETE FROM $wpdb->term_taxonomy WHERE term_id NOT IN ( SELECT term_id FROM $wpdb->terms );";
$result = $wpdb->get_results($query);
