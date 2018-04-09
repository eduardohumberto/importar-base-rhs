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
        $this->contents = $this->dir_files.'arquivos';
    }

    /**
     * method responsible for init the whole process
     */
    public function init(){
        global $Metadata;
        $fields = $Metadata;
        $columns = $this->insertMetadata( $fields );
        $is_header = true;

        foreach ( $this->readFile() as $rawLine) {
            $line = str_getcsv( $rawLine,';');
            foreach ($line as $index => $metadata) {

                if( $is_header ){
                    $is_header = false;
                    continue;
                }
                var_dump($metadata, $columns[$index]);
                echo PHP_EOL;
            }
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
     * @param $rawValue the value from csv
     * @param $columnData the data about the metadata
     */
    public function processItem( $rawValue, $columnData ){
        global $ItemMetadata, $ItemClass;

        $item_id = $ItemClass->create_empty_item();

        if( $columnData['type'] === 'category' ){
            $ItemMetadata->insert_category_metadata($item_id, $columnData['id'], $rawValue);
        } else if( in_array( $columnData['type'], ['text', 'numeric', 'date', 'textarea'])){
            $ItemMetadata->insert_text_metadata($item_id, $columnData['id'], $rawValue);
        }
    }
}