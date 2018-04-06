<?php

class Tag {

    /**
     * @param $item_id
     * @param array $tags
     */
    public function insert_tag( $item_id, array $tags ){
        $term_taxonomy_ids = wp_set_object_terms( $item_id, $tags, 'socialdb_tag_type', true );

        if ( is_wp_error( $term_taxonomy_ids ) ) {
            // There was an error somewhere and the terms couldn't be set.
        } else {
            wp_set_object_terms( COLLECTION_ID, $tags, 'socialdb_tag_type', true );
        }
    }

}