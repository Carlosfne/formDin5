<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 1.9.0-alpha
 * FormDin Version: 4.7.5
 * 
 * System appev2 created in: 2019-09-10 09:04:47
 */
class UfVO
{
    private $cod_uf = null;
    private $nom_uf = null;
    private $sig_uf = null;
    private $cod_regiao = null;
    public function __construct( $cod_uf=null, $nom_uf=null, $sig_uf=null, $cod_regiao=null ) {
        $this->setCod_uf( $cod_uf );
        $this->setNom_uf( $nom_uf );
        $this->setSig_uf( $sig_uf );
        $this->setCod_regiao( $cod_regiao );
    }
    //--------------------------------------------------------------------------------
    public function setCod_uf( $strNewValue = null )
    {
        $this->cod_uf = $strNewValue;
    }
    public function getCod_uf()
    {
        return $this->cod_uf;
    }
    //--------------------------------------------------------------------------------
    public function setNom_uf( $strNewValue = null )
    {
        $this->nom_uf = $strNewValue;
    }
    public function getNom_uf()
    {
        return $this->nom_uf;
    }
    //--------------------------------------------------------------------------------
    public function setSig_uf( $strNewValue = null )
    {
        $this->sig_uf = $strNewValue;
    }
    public function getSig_uf()
    {
        return $this->sig_uf;
    }
    //--------------------------------------------------------------------------------
    public function setCod_regiao( $strNewValue = null )
    {
        $this->cod_regiao = $strNewValue;
    }
    public function getCod_regiao()
    {
        return $this->cod_regiao;
    }
    //--------------------------------------------------------------------------------
}
?>