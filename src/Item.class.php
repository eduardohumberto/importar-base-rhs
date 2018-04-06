<?php

class Item {

    /**
     * @return int/
     */
    public function create_empty_item(){
        $post = array(
            'post_title' => time(),
            'post_type' => 'socialdb_object',
            'post_author' => get_current_user_id()
        );
        $id = wp_insert_post($post);

        return $id;
    }

    /**
     * @param $ID
     * @param $title
     * @param $description
     */
    public function update_item( $ID, $title, $description ){
        $item = array(
            'ID' => $ID,
            'post_title' => $title,
            'post_status' => 'publish',
            'post_content' => $description,
            'post_parent' => COLLECTION_ID
        );
        wp_update_post( $item );
        wp_set_object_terms( $ID, array( CATEGORY_ROOT_ID ), 'socialdb_category_type', true);
    }
}