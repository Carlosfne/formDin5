<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 1.3.1-alpha
 * FormDin Version: 4.4.3-alpha
 * 
 * System xx created in: 2019-04-11 00:32:52
 */

class Pessoa
{


    public function __construct()
    {
    }
    //--------------------------------------------------------------------------------
    public static function selectById( $id )
    {
        $result = PessoaDAO::selectById( $id );
        return $result;
    }
    //--------------------------------------------------------------------------------
    public static function selectCount( $where=null )
    {
        $result = PessoaDAO::selectCount( $where );
        return $result;
    }
    //--------------------------------------------------------------------------------
    public static function selectAll( $orderBy=null, $where=null )
    {
        $result = PessoaDAO::selectAll( $orderBy, $where );
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function save( PessoaVO $objVo )
    {
        $result = null;
        if( $objVo->getIdpessoa() ) {
            $result = PessoaDAO::update( $objVo );
        } else {
            $result = PessoaDAO::insert( $objVo );
        }
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function delete( $id )
    {
        $result = PessoaDAO::delete( $id );
        return $result;
    }

}
?>