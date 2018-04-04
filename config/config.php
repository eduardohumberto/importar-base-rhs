<?php

define( 'WP_USE_THEMES', false);

//SE FOR MULTISITE ESTES PARAMETROS DEVEM SER ALTERADOS
$_SERVER['HTTP_HOST'] = 'mhn.medialab.ufg.br';
$_SERVER['REQUEST_URI'] = '/';

include('/home/l3p/apache_sites/mhn.medialab.ufg.br/web/wp-config.php');

define('CATEGORY_ROOT_ID',6863);
define('COLLECTION_ID',106);
define('AUTHOR',1);

//metadados
define('PATRIMONIO',6868); //ok
//define('OBJETO',136); desconsiderar pois eh mapeado para o post-title  //ok
define('TITULO',6870); //ok
define('AUTOR',6916); //fonte mapeado para o source do tainacan //ok
define('ALTURA',6872);//ok
define('LARGURA',6874);//ok
define('COMPRIMENTO',6876);//ok
define('ORIGEM',6878);
//define('OBS',142); mapeado para post content //ok
define('TERMOS',6880);
define('PAIS',6882);
define('AQUI',6886);
define('PESO',6888);
define('TECNICAS',6890);
define('CLASSE',6892);
define('DATAPRO',6895);
define('PROCE',6897);
define('ECON',6899);
define('VALOR',6901);
define('MATERIAIS',6903);
define('DEST',6905);
define('CLASSE_NUM',6907);
define('REVISION', 6909);



//TERMO RAIZ DE CLASSE
define('CLASSE_TERM',6893);
define('PAIS_TERM',6883);
define('REVISION_VALUE',6912);


//LOCAL IMAGENS
define('PATH_FILES_IMPORT','/home/l3p/MHN_files/MHN/SERET/Imagens/');
