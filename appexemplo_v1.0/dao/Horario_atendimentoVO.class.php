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
class Horario_atendimentoVO
{
    private $idhorario_atendimento = null;
    private $idpessoa_dentista = null;
    private $horario = null;
    public function __construct( $idhorario_atendimento=null, $idpessoa_dentista=null, $horario=null ) {
        $this->setIdhorario_atendimento( $idhorario_atendimento );
        $this->setIdpessoa_dentista( $idpessoa_dentista );
        $this->setHorario( $horario );
    }
    //--------------------------------------------------------------------------------
    public function setIdhorario_atendimento( $strNewValue = null )
    {
        $this->idhorario_atendimento = $strNewValue;
    }
    public function getIdhorario_atendimento()
    {
        return $this->idhorario_atendimento;
    }
    //--------------------------------------------------------------------------------
    public function setIdpessoa_dentista( $strNewValue = null )
    {
        $this->idpessoa_dentista = $strNewValue;
    }
    public function getIdpessoa_dentista()
    {
        return $this->idpessoa_dentista;
    }
    //--------------------------------------------------------------------------------
    public function setHorario( $strNewValue = null )
    {
        $this->horario = $strNewValue;
    }
    public function getHorario()
    {
        return $this->horario;
    }
    //--------------------------------------------------------------------------------
}
?>