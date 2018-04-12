<?php

class Main{

    public $dir_files;
    public $csv_file;
    public $contents;

    /**
     * Main constructor.
     *
     * set paths to use in main script
     */
    public function __construct(){
        $this->dir_files = dirname( __FILE__ ). '/../data/';
        $this->csv_file = $this->dir_files.'base_dados_acervo_tainacan_rhs.csv';
        $this->contents = $this->dir_files.'arquivos/Renomeados';
    }

    /**
     * method responsible for init the whole process
     */
    public function init(){
        global $Metadata, $LogClass, $ItemClass;
        $fields = $Metadata;
        $columns = $this->insertMetadata( $fields );
        $is_header = true;
        $LogClass->set_total_items( 273 ); // the csv qtd

        $resource = fopen( $this->csv_file, "r" );
        while (  ( $line = fgetcsv( $resource, 0, ";") ) !== FALSE ) {
            if( $is_header ){
                $is_header = false;
                continue;
            }
            $item_id = $ItemClass->create_empty_item();
            foreach ($line as $index => $metadata) {
                $this->processItem( $item_id, $metadata, $columns[$index] );
            }
            $LogClass->total_items_inserted();
        }
    }

    /**
     *  read the csv file
     * @return array csv lines
     */
    public function readFile(){
        $csvFile = file( $this->csv_file );
        return ( $csvFile && is_array( $csvFile ) ) ? $csvFile : [];
    }

    /**
     * @param array $metadata
     *
     * @return array with metadata id if is necessary
     */
    public function insertMetadata( Array $metadata ){
        global $MetadataClass;
        $result = [];

        foreach( $metadata as $meta ){
            if( !in_array( $meta['type'], [ 'fixed', 'attachment']  ) ){

                if( $meta['type'] === 'category'){
                    $meta['id'] = $MetadataClass->create_metadata_category( $meta );
                } else {
                    $meta['id'] = $MetadataClass->create_metadata_text( $meta );
                }
            }
            $result[] = $meta;
        }

        return $result;
    }

    /**
     * @param $item_id the id do item
     * @param $rawValue the value from csv
     * @param $columnData the data about the metadata
     *
     * @return int
     */
    public function processItem( $item_id, $rawValue, $columnData ){
        global $ItemMetadata, $ItemClass, $ItemFilesClass, $TagClass, $LogClass;

        if( $columnData['type'] === 'category' ){

            $ItemMetadata->insert_category_metadata( $item_id, $columnData['id'], $rawValue);

        } else if( in_array( $columnData['type'], ['text', 'numeric', 'date', 'textarea'])){

            $values = explode(',', $rawValue );
            foreach ( $values as $index => $value ):
                $ItemMetadata->insert_text_metadata( $item_id, $columnData['id'], trim( $value ), $index);
            endforeach;

        } else if( $columnData['name'] === 'title' ){
            $title = $rawValue;
            $ItemClass->update_item_title( $item_id, $title);

        } else if( $columnData['name'] === 'description' ){
            $ItemClass->update_item_description( $item_id, $rawValue );

        } else if( $columnData['name'] === 'item_type' ){
            $ItemMetadata->insert_fixed_metadata( $item_id, 'socialdb_object_dc_type', $rawValue);

        } else if( $columnData['name'] === 'Nome dos arquivos' && $rawValue && !empty( trim( $rawValue ) )){
            $LogClass->printText( 'INSERINDO ARQUIVO: '. $rawValue );
            $attachment_id = $ItemFilesClass->insert_attachment_by_path( $item_id, $this->contents . '/' .$rawValue );
            $ItemMetadata->insert_fixed_metadata( $item_id, 'socialdb_object_content', $attachment_id);
            $ItemMetadata->insert_fixed_metadata( $item_id, 'socialdb_object_from', 'internal' );

        } else if( $columnData['name'] === 'content' ){
            $content = get_post_meta( $item_id, 'socialdb_object_content', true );

            if( !$content || $content === '') {
                $ItemMetadata->insert_fixed_metadata( $item_id, 'socialdb_object_content', $rawValue );
                $ItemMetadata->insert_fixed_metadata( $item_id, 'socialdb_object_from', 'external' );

                if ( strpos( $rawValue, 'youtube.com') !== false ) {
                    parse_str( parse_url( $rawValue, PHP_URL_QUERY), $vars);
                    $file_id = $ItemFilesClass->insert_attachment_by_url( $item_id,'https://i.ytimg.com/vi/' . $vars['v'] . '/0.jpg');
                    set_post_thumbnail( $item_id, $file_id );
                }
            }

        } else if( $columnData['name'] === 'tags' ){
            $TagClass->insert_tag( $item_id, explode( ',', $rawValue ) );

        } else if( $columnData['type'] === 'attachment' && $rawValue && !empty( trim( $rawValue ) )){
            $LogClass->printText( 'INSERINDO ANEXO: '. $rawValue );
            $files = explode( ',', $rawValue );
            foreach ( $files as $file ) {
                $ItemFilesClass->insert_attachment_by_url( $item_id, $file);
            }
        }


        return $item_id;
    }
}