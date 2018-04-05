<?php

define( 'WP_USE_THEMES', false);

//SE FOR MULTISITE ESTES PARAMETROS DEVEM SER ALTERADOS
$_SERVER['HTTP_HOST'] = 'mhn.medialab.ufg.br';
$_SERVER['REQUEST_URI'] = '/';

include('/home/l3p/apache_sites/mhn.medialab.ufg.br/web/wp-config.php');

define('CATEGORY_ROOT_ID',6863);
define('COLLECTION_ID',106);
define('AUTHOR',1);

$metadata = [
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

define('ARRAY_METADATA', $metadata);
