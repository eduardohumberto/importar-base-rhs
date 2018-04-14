# importar-base-rhs

Etapas para migração

## 1º Alterar configuração

Dentro da pasta config alterar o arquivo config.php os seguintes parâmetros

// ( Obrigatório ) o id da categoria raiz da coleção, na página da coleção é possível recuperar
// essa informação
define('CATEGORY_ROOT_ID', 112);

// ( Obrigatório ) o id da coleção, na página da coleção é possível recuperar
// essa informação
define('COLLECTION_ID',33);

// ( Não obrigatório ) o id do usuario que sera 'dono' das entidades criadas
define('AUTHOR',1);

// ( Obrigatório ) A url do ambiente que será importado - Atenção essencial setar este parâmetro
corretamente
// Exemplo real: $_SERVER['HTTP_HOST'] = 'mhn.medialab.ufg.br';

$_SERVER['HTTP_HOST'] = 'localhost';

// o diretorio do ambiente a ser importado - Atenção essencial setar este parâmetro corretamente

// Exemplo: $_SERVER['REQUEST_URI'] = '/tainacan';

$_SERVER['REQUEST_URI'] = '/tainacan';

// caminho fisico da instalacao do wordpress que será importado

define('DIR_TAINACAN','/home/eduardo/Projetos/wordpress_tainacan/wordpress_tainacan');

## 2º Baixar arquivos que serão importados

solicitar o arquivo zipado ( eduardo.humberto1992@gmail.com ) e extraí-lo dentro da pasta ./data

## 3º execução

executar o arquivo main.php e aguardar seu encerramento

Ex. $ php main.php
