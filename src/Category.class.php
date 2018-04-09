<?php

class Category {

    /**
     * @param $name
     * @param int $parent
     * @return int/bool
     */
    public function create_category_term( $name, $parent = 0 ){

        if( !$parent ){
            $parent = get_term_by('slug', 'socialdb_taxonomy', 'socialdb_category_type' )->term_id;
        }

        $category = wp_insert_term($name, 'socialdb_category_type', array( 'parent' => $parent ) );
        if( isset( $category->error_data )){
            add_term_meta( $category->error_data['term_exists'], 'socialdb_category_owner', get_current_user_id());
            add_term_meta( $category->error_data['term_exists'], 'tainacan_imported', 'tainacan_imported');
            return $category->error_data['term_exists'];
        } else if( isset( $category['term_id'] ) ):
            add_term_meta( $category['term_id'], 'socialdb_category_owner', get_current_user_id());
            add_term_meta( $category['term_id'], 'tainacan_imported', 'tainacan_imported');
            return $category['term_id'];
        endif;

        return false;
    }

}