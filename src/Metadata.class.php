<?php

class Metadata {

    /**
     * @param $slug
     * @return int The id
     */
    public function get_term_id( $slug ){
        return get_term_by('slug',$slug, 'socialdb_property_type')->term_id;
    }

    /**
     * @param $name
     * @param $type
     * @return bool
     */
    public function create_metadata_term( $name, $type ){

        $slug = ( $type === 'category' ) ?  'socialdb_property_term' : 'socialdb_property_data';

        $new_metadata = wp_insert_term(
            $name,
            'socialdb_property_type',
            array('parent' => $this->get_term_id( $slug ))
        );

        if( isset( $new_metadata['term_id'] ) ) :
            add_term_meta( CATEGORY_ROOT_ID, 'socialdb_category_property_id', $new_metadata['term_id'] );
            update_term_meta( $new_metadata['term_id'], 'socialdb_property_created_category', CATEGORY_ROOT_ID);
            update_term_meta( $new_metadata['term_id'], 'socialdb_property_collection_id', COLLECTION_ID );
            update_term_meta( $new_metadata['term_id'], 'socialdb_property_required', 'false');
            update_term_meta( $new_metadata['term_id'], 'socialdb_property_help', '');
            update_term_meta( $new_metadata['term_id'], 'socialdb_property_visualization', 'public');

            update_term_meta($new_metadata['term_id'], 'tainacan_imported', 'tainacan_imported');
            return $new_metadata['term_id'];
        endif;

        return false;
    }

    /**
     * @param  array $args
     * @return int the metadata id
     */
    public function create_metadata_category( $args ){
        $metadata_id = $this->insert_metadata_term( $args['name'], $args['type'] );

        if( $metadata_id ){
            $classCategory = new Category;
            $taxonomy = $classCategory->create_category_term( $args['name'] ); // crio tax com o nome do metadado

            update_term_meta( $metadata_id, 'socialdb_property_term_cardinality', '1');
            update_term_meta( $metadata_id, 'socialdb_property_term_widget', 'tree');
            update_term_meta( $metadata_id, 'socialdb_property_term_root', ( $taxonomy ) ? $taxonomy : '0');

        }

        return $metadata_id;
    }

    /**
     * @param  array $args
     * * @return int the metadata id
     */
    public function create_metadata_text( $args ){
        $metadata_id = $this->insert_metadata_term( $args['name'], $args['type'] );

        if( $metadata_id ){
            $result[] = update_term_meta( $metadata_id, 'socialdb_property_data_widget', $args['type']);
            $result[] = update_term_meta( $metadata_id, 'socialdb_property_data_cardinality', $args['cardinality']);
        }

        return $metadata_id;
    }
}