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

$primaryKey = 'COD_MUNICIPIO';
$frm = new TForm('Município',650);
$frm->setShowCloseButton(false);
$frm->setFlat(true);
$frm->setMaximize(true);
$frm->setHelpOnLine('Ajuda',600,980,'ajuda/ajuda_tela.php',null);


$frm->addHiddenField( 'BUSCAR' ); //Campo oculto para buscas
$frm->addHiddenField( $primaryKey );   // coluna chave da tabela
$controllerUf = new Uf();
$listUf = $controllerUf->selectAll('NOM_UF');
$frm->addSelectField('COD_UF', 'UF',TRUE,$listUf,null,null,null,null,null,null,' ',null);
//$frm->addMemoField('NOM_MUNICIPIO', 'Nome',200,TRUE,80,3);
$frm->addTextField('NOM_MUNICIPIO', 'Nome',200,true,80);
$frm->addSelectField('SIT_ATIVO', 'Ativo:', true, 'S=Sim,N=Não', true);

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
                $vo = new MunicipioVO();
                $frm->setVo( $vo );
                $controller = new Municipio();
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
            $controller = new Municipio();
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
                'COD_MUNICIPIO'=>$frm->get('COD_MUNICIPIO')
                ,'COD_UF'=>$frm->get('COD_UF')
                ,'NOM_MUNICIPIO'=>$frm->get('NOM_MUNICIPIO')
                ,'SIT_ATIVO'=>$frm->get('SIT_ATIVO')
        );
    }
    return $retorno;
}

if( isset( $_REQUEST['ajax'] )  && $_REQUEST['ajax'] ) {
    $maxRows = ROWS_PER_PAGE;
    $whereGrid = getWhereGridParameters($frm);
    $controller = new Municipio();
    $page = PostHelper::get('page');
    $dados = $controller->selectAllPagination( $primaryKey, $whereGrid, $page,  $maxRows);
    $realTotalRowsSqlPaginator = $controller->selectCount( $whereGrid );
    $mixUpdateFields = $primaryKey.'|'.$primaryKey
                    .',COD_UF|COD_UF'
                    .',NOM_MUNICIPIO|NOM_MUNICIPIO'
                    .',SIT_ATIVO|SIT_ATIVO'
                    ;
    $gride = new TGrid( 'gd'                        // id do gride
    				   ,'Lista de Municípos. Qtd: '.$realTotalRowsSqlPaginator // titulo do gride
    				   );
    $gride->addKeyField( $primaryKey ); // chave primaria
    $gride->setData( $dados ); // array de dados
    $gride->setRealTotalRowsSqlPaginator( $realTotalRowsSqlPaginator );
    $gride->setMaxRows( $maxRows );
    $gride->setUpdateFields($mixUpdateFields);
    $gride->setUrl( 'municipio.php' );

    $gride->addColumn($primaryKey,'id');
	$gride->addColumn('COD_UF','COD UF',null,'center');
	$gride->addColumn('SIG_UF','UF',null,'center');
	$gride->addColumn('NOM_MUNICIPIO','Nome');
	$gride->addColumn('SIT_ATIVO','Ativo',null,'center');

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
                    ,"COD_MUNICIPIO":""
                    ,"COD_UF":""
                    ,"NOM_MUNICIPIO":""
                    ,"SIT_ATIVO":""
                    };
    fwGetGrid('municipio.php','gride',Parameters,true);
}
function buscar() {
    jQuery("#BUSCAR").val(1);
    init();
}
</script>