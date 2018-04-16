<?php

class ItemMetadata {

    /**
     * insert fixed metadata
     *
     * @param $id
     * @param $key
     * @param $value
     */
    public function insert_fixed_metadata( $id, $key, $value ){
        update_post_meta( $id, $key, $value );
    }

    /**
     * insert textmetadata
     *
     * @param $id item id
     * @param $metadata_id the metadata id
     * @param $value the
     * @param $index if multiple each value must have an unique index
     */
    public function insert_text_metadata( $id, $metadata_id, $value, $index = 0 ){
        global $Tainacan_ItemMetadata_Model;
        $Tainacan_ItemMetadata_Model->saveValue(
            $id,
            $metadata_id,
            0,
            'text',
            $index,
            $value,
            false
        );
    }

    /**
     * @param $id item id
     * @param $metadata_id meta key
     * @param $value
     * @param $index
     */
    public function insert_category_metadata( $id, $metadata_id, $value, $index = 0 ){
        global $Tainacan_ItemMetadata_Model;
        $categoryClass = new Category();
        $term_id = 0;

        if( $value === '' ){
           return;
        }

        $taxonomy_id = get_term_meta( $metadata_id,'socialdb_property_term_root', true );

        $terms = get_terms([
            'taxonomy' => 'socialdb_category_type',
            'parent'=> $taxonomy_id,
            'name'=> $value,
            'hide_empty' => false,
        ]);

        if( $terms ){
            if( is_array( $terms )  ){
                foreach( $terms as $term ){
                    $term_id = $term->term_id;
                    break;
                }
            }
        } else {
            $term_id = $categoryClass->create_category_term( $value, $taxonomy_id );
        }

        $Tainacan_ItemMetadata_Model->saveValue(
            $id,
            $metadata_id,
            0,
            'term',
            $index,
            $term_id,
            false
        );
    }

}
