<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 1.9.0-alpha
 * FormDin Version: 4.7.5
 * 
 * System appev2 created in: 2019-09-10 09:04:46
 */
class Acesso_perfil_menuDAO 
{

    private static $sqlBasicSelect = 'select
									  pm.idperfilmenu
									 ,pm.idperfil
									 ,(select p.nom_perfil from form_exemplo.acesso_perfil as p where p.idperfil = pm.idperfil) as nom_perfil
									 ,pm.idmenu
									 ,(select m.nom_menu from form_exemplo.acesso_menu as m where m.idmenu = pm.idmenu) as nom_menu
									 ,pm.sit_ativo
									 ,pm.dat_inclusao
									 ,pm.dat_update
									 from form_exemplo.acesso_perfil_menu as pm';

    private $tpdo = null;

    public function __construct($tpdo=null) {

        $this->validateObjType($tpdo);
        if( empty($tpdo) ){
            $tpdo = New TPDOConnectionObj();
        }
        $this->setTPDOConnection($tpdo);
    }
    public function getTPDOConnection()
    {
        return $this->tpdo;
    }
    public function setTPDOConnection($tpdo)
    {
        $this->validateObjType($tpdo);
        $this->tpdo = $tpdo;
    }
    public function validateObjType($tpdo)
    {
        $typeObjWrong = !($tpdo instanceof TPDOConnectionObj);
        if( !is_null($tpdo) && $typeObjWrong ){
            throw new InvalidArgumentException('class:'.__METHOD__);
        }
    }
    private function processWhereGridParameters( $whereGrid )
    {
        $result = $whereGrid;
        if ( is_array($whereGrid) ){
            $where = ' 1=1 ';
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'IDPERFILMENU', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'IDPERFIL', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'IDMENU', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'SIT_ATIVO', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'DAT_INCLUSAO', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'DAT_UPDATE', SqlHelper::SQL_TYPE_TEXT_LIKE);
            $result = $where;
        }
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function selectById( $id )
    {
        if( empty($id) || !is_numeric($id) ){
            throw new InvalidArgumentException(Message::TYPE_NOT_INT.'class:'.__METHOD__);
        }
        $values = array($id);
        $sql = self::$sqlBasicSelect.' where idperfilmenu = ?';
        $result = $this->tpdo->executeSql($sql, $values);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function selectCount( $where=null )
    {
        $where = $this->processWhereGridParameters($where);
        $sql = 'select count(idperfilmenu) as qtd from form_exemplo.acesso_perfil_menu';
        $sql = $sql.( ($where)? ' where '.$where:'');
        $result = $this->tpdo->executeSql($sql);
        return $result['QTD'][0];
    }
    //--------------------------------------------------------------------------------
    public function selectAllPagination( $orderBy=null, $where=null, $page=null,  $rowsPerPage= null )
    {
        $rowStart = SqlHelper::getRowStart($page,$rowsPerPage);
        $where = $this->processWhereGridParameters($where);

        $sql = self::$sqlBasicSelect
        .( ($where)? ' where '.$where:'')
        .( ($orderBy) ? ' order by '.$orderBy:'')
        .( ' LIMIT '.$rowStart.','.$rowsPerPage);

        $result = $this->tpdo->executeSql($sql);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function selectAll( $orderBy=null, $where=null )
    {
        $where = $this->processWhereGridParameters($where);
        $sql = self::$sqlBasicSelect
        .( ($where)? ' where '.$where:'')
        .( ($orderBy) ? ' order by '.$orderBy:'');

        $result = $this->tpdo->executeSql($sql);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function insert( Acesso_perfil_menuVO $objVo )
    {
        $values = array(  $objVo->getIdperfil() 
                        , $objVo->getIdmenu() 
                        , $objVo->getSit_ativo() 
                        , $objVo->getDat_inclusao() 
                        , $objVo->getDat_update() 
                        );
        $sql = 'insert into form_exemplo.acesso_perfil_menu(
                                 idperfil
                                ,idmenu
                                ,sit_ativo
                                ,dat_inclusao
                                ,dat_update
                                ) values (?,?,?,?,?)';
        $result = $this->tpdo->executeSql($sql, $values);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function update ( Acesso_perfil_menuVO $objVo )
    {
        $values = array( $objVo->getIdperfil()
                        ,$objVo->getIdmenu()
                        ,$objVo->getSit_ativo()
                        ,$objVo->getDat_inclusao()
                        ,$objVo->getDat_update()
                        ,$objVo->getIdperfilmenu() );
        $sql = 'update form_exemplo.acesso_perfil_menu set 
                                 idperfil = ?
                                ,idmenu = ?
                                ,sit_ativo = ?
                                ,dat_inclusao = ?
                                ,dat_update = ?
                                where idperfilmenu = ?';
        $result = $this->tpdo->executeSql($sql, $values);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function delete( $id )
    {
        if( empty($id) || !is_numeric($id) ){
            throw new InvalidArgumentException(Message::TYPE_NOT_INT.'class:'.__METHOD__);
        }
        $values = array($id);
        $sql = 'delete from form_exemplo.acesso_perfil_menu where idperfilmenu = ?';
        $result = $this->tpdo->executeSql($sql, $values);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function getVoById( $id )
    {
        if( empty($id) || !is_numeric($id) ){
            throw new InvalidArgumentException(Message::TYPE_NOT_INT.'class:'.__METHOD__);
        }
        $result = $this->selectById( $id );
        $result = \ArrayHelper::convertArrayFormDin2Pdo($result,false);
        $result = $result[0];
        $vo = new Acesso_perfil_menuVO();
        $vo = \FormDinHelper::setPropertyVo($result,$vo);
        return $vo;
    }
}
?>