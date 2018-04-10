<?php

define('CATEGORY_ROOT_ID',112);
define('COLLECTION_ID',33);
define('AUTHOR',1);

define( 'WP_USE_THEMES', false);

//SE FOR MULTISITE ESTES PARAMETROS DEVEM SER ALTERADOS
// $_SERVER['HTTP_HOST'] = 'mhn.medialab.ufg.br';
// $_SERVER['REQUEST_URI'] = '/';
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['REQUEST_URI'] = '/wordpress_tainacan';

define('DIR_TAINACAN','/home/eduardo/Projetos/wordpress_tainacan/wordpress_tainacan');
// include('/home/l3p/apache_sites/mhn.medialab.ufg.br/web/wp-config.php');

/** DO NOT GO FURTHER THIS LINE **/

include( DIR_TAINACAN.'/wp-config.php');
include( DIR_TAINACAN.'/wp-content/themes/tainacan/models/object/object_save_values.php');

global $Metadata;

$Metadata = [
    array(
        'name' => 'title',
        'type' => 'fixed',
        'table' => 'post',
        'attr' => 'post_title',
    ),
    array(
        'name' => 'Categorias',
        'type' => 'category'
    ),
    array(
        'name' => 'ID',
        'type' => 'fixed'
    ),
    array(
        'name' => 'Nome dos arquivos',
        'type' => 'fixed'
    ),
    array(
        'name' => 'description',
        'type' => 'fixed',
        'table' => 'post',
        'attr' => 'post_content'
    ),
    array(
        'name' => 'content',
        'type' => 'fixed',
        'table' => 'meta',
        'attr' => 'socialdb_object_content'
    ),
    array(
        'name' => 'item_type',
        'type' => 'fixed',
        'table' => 'meta',
        'attr' => 'socialdb_object_dc_type'
    ),
    array(
        'name' => 'tags',
        'type' => 'fixed',
        'table' => 'tags'
    ),
    array(
        'name' => 'Participantes',
        'type' => 'text',
        'cardinality' => 'n'
    ),
    array(
        'name' => 'Autores',
        'type' => 'text',
        'cardinality' => 'n'
    ),
    array(
        'name' => 'Ano',
        'type' => 'numeric',
        'cardinality' => '1'
    ),
    array(
        'name' => 'Data',
        'type' => 'date',
        'cardinality' => '1'
    ),
    array(
        'name' => 'Edição',
        'type' => 'category'
    ),
    array(
        'name' => 'Editor',
        'type' => 'text',
        'cardinality' => '1'
    ),
    array(
        'name' => 'Idioma',
        'type' => 'category'
    ),
    array(
        'name' => 'Evento',
        'type' => 'text',
        'cardinality' => '1'
    ),
    array(
        'name' => 'Files',
        'type' => 'attachment',
        'cardinality' => '1'
    )
];

global $Tainacan_ItemMetadata_Model;

$Tainacan_ItemMetadata_Model = new ObjectSaveValuesModel;

include_once 'includes.php';

global $MainClass;
$MainClass = new Main();

global $MetadataClass;
$MetadataClass = new Metadata();

global $ItemClass;
$ItemClass = new Item();

global $ItemMetadata;
$ItemMetadata = new ItemMetadata();

global $ItemFilesClass;
$ItemFilesClass = new ItemFiles();

global $TagClass;
$TagClass = new Tag();

global $LogClass;
$LogClass = new LogTainacan();