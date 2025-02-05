<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 1.9.0-alpha
 * FormDin Version: 4.7.5-alpha
 * 
 * System appev2 created in: 2019-09-01 16:03:51
 */

defined('APLICATIVO') or die();
require_once 'modulos/includes/acesso_view_allowed.php';

$primaryKey = 'IDPEDIDO_ITEM';
$frm = new TForm('Item',800,950);
$frm->setShowCloseButton(false);
$frm->setFlat(true);
$frm->setMaximize(true);
$frm->setHelpOnLine('Ajuda',600,980,'ajuda/ajuda_tela.php',null);


$frm->addHiddenField( 'BUSCAR' ); //Campo oculto para buscas
$frm->addHiddenField( $primaryKey );   // coluna chave da tabela
$controllerPedido = new Pedido();
$listPedido = $controllerPedido->selectAll();
$frm->addSelectField('IDPEDIDO', 'IDPEDIDO',true,$listPedido,null,null,null,null,null,null,' ',null);

$controllerPessoa = new Pessoa();
$listPessoa = $controllerPessoa->selectAll();
$frm->addSelectField('IDPESSOA', 'Pessoa',TRUE,$listPessoa,null,null,null,null,null,null,' ',null);

$controllerMarca = new Marca();
$listMarca = $controllerMarca->selectAll();
$frm->addSelectField('IDMARCA', 'Marca',TRUE,$listMarca,null,null,null,null,null,null,' ',null);

$controllerProduto = new Produto();
$listProduto = $controllerProduto->selectAll();
$frm->addSelectField('IDPRODUTO', 'Produto',TRUE,$listProduto,null,null,null,null,null,null,' ',null);

$frm->combinarSelects('IDPESSOA', 'IDMARCA', 'vw_pessoa_marca_produto', 'IDPESSOA', 'IDMARCA', 'NOM_MARCA', null, null, 'Nenhum', null, null, true);

$frm->combinarSelects('IDMARCA', 'IDPRODUTO', 'vw_pessoa_marca_produto', 'IDMARCA', 'IDPRODUTO', 'NOM_PRODUTO', null, null, 'Nenhum', null, null, true);

$frm->addNumberField('QTD_UNIDADE', 'Quantidade',10,TRUE,0);
$frm->addNumberField('PRECO', 'Preço Unitário',12,TRUE,0,false);

$frm->addButton('Buscar', null, 'btnBuscar', 'buscar()', null, true, false);
$frm->addButton('Salvar', null, 'Salvar', null, null, false, false);
$frm->addButton('Limpar', null, 'Limpar', null, null, false, false);


$acao = isset($acao) ? $acao : null;
switch( $acao ) {
    //--------------------------------------------------------------------------------
    case 'Limpar':
        $frm->clearFields();
    break;
    //--------------------------------------------------------------------------------
    case 'Salvar':
        try{
            if ( $frm->validate() ) {
                $vo = new Pedido_itemVO();
                $frm->setVo( $vo );
                $controller = new Pedido_item();
                $resultado = $controller->save( $vo );
                if($resultado==1) {
                    $frm->setMessage('Registro gravado com sucesso!!!');
                    $frm->clearFields();
                }else{
                    $frm->setMessage($resultado);
                }
            }
        }
        catch (DomainException $e) {
            $frm->setMessage( $e->getMessage() );
        }
        catch (Exception $e) {
            MessageHelper::logRecord($e);
            $frm->setMessage( $e->getMessage() );
        }
    break;
    //--------------------------------------------------------------------------------
    case 'gd_excluir':
        try{
            $id = $frm->get( $primaryKey ) ;
            $controller = new Pedido_item();
            $resultado = $controller->delete( $id );
            if($resultado==1) {
                $frm->setMessage('Registro excluido com sucesso!!!');
                $frm->clearFields();
            }else{
                $frm->setMessage($resultado);
            }
        }
        catch (DomainException $e) {
            $frm->setMessage( $e->getMessage() );
        }
        catch (Exception $e) {
            MessageHelper::logRecord($e);
            $frm->setMessage( $e->getMessage() );
        }
    break;
}


function getWhereGridParameters(&$frm)
{
    $retorno = null;
    if($frm->get('BUSCAR') == 1 ){
        $retorno = array(
                'IDPEDIDO_ITEM'=>$frm->get('IDPEDIDO_ITEM')
                ,'IDPEDIDO'=>$frm->get('IDPEDIDO')
                ,'IDPRODUTO'=>$frm->get('IDPRODUTO')
                ,'QTD_UNIDADE'=>$frm->get('QTD_UNIDADE')
                ,'PRECO'=>$frm->get('PRECO')
        );
    }
    return $retorno;
}

if( isset( $_REQUEST['ajax'] )  && $_REQUEST['ajax'] ) {
    $maxRows = ROWS_PER_PAGE;
    $whereGrid = getWhereGridParameters($frm);
    $controller = new Pedido_item();
    $page = PostHelper::get('page');
    $dados = $controller->selectAllPagination( $primaryKey, $whereGrid, $page,  $maxRows);
    $realTotalRowsSqlPaginator = $controller->selectCount( $whereGrid );
    $mixUpdateFields = $primaryKey.'|'.$primaryKey
                    .',IDPEDIDO|IDPEDIDO'
                    .',IDPRODUTO|IDPRODUTO'
                    .',QTD_UNIDADE|QTD_UNIDADE'
                    .',PRECO|PRECO'
                    ;
    $gride = new TGrid( 'gd'                        // id do gride
    				   ,'Itens do Pedido. Qtd: '.$realTotalRowsSqlPaginator // titulo do gride
    				   );
    $gride->addKeyField( $primaryKey ); // chave primaria
    $gride->setData( $dados ); // array de dados
    $gride->setRealTotalRowsSqlPaginator( $realTotalRowsSqlPaginator );
    $gride->setMaxRows( $maxRows );
    $gride->setUpdateFields($mixUpdateFields);
    $gride->setUrl( 'pedido_item.php' );

    $gride->addColumn($primaryKey,'id');
	$gride->addColumn('IDPEDIDO','Id Pedido');
	$gride->addColumn('IDPRODUTO','id Produto');
	$gride->addColumn('QTD_UNIDADE','Quantidade');
	$gride->addColumn('PRECO','Preço Unitário');

    $gride->show();
    die();
}

$frm->addHtmlField('gride');
$frm->addJavascript('init()');
$frm->show();

?>
<script>
function init() {
    var Parameters = {"BUSCAR":""
                    ,"IDPEDIDO_ITEM":""
                    ,"IDPEDIDO":""
                    ,"IDPRODUTO":""
                    ,"QTD_UNIDADE":""
                    ,"PRECO":""
                    };
    fwGetGrid('pedido_item.php','gride',Parameters,true);
}
function buscar() {
    jQuery("#BUSCAR").val(1);
    init();
}
</script>