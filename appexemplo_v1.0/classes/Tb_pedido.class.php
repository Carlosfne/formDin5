<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 0.8.0-alpha
 * FormDin Version: 4.2.6-alpha
 * 
 * System sysinfra created in: 2018-09-11 01:58:11
 */

class Tb_pedido {


	public function __construct(){
	}
	//--------------------------------------------------------------------------------
	public static function selectById( $id ){
		$result = Tb_pedidoDAO::selectById( $id );
		return $result;
	}
	//--------------------------------------------------------------------------------
	public static function selectCount( $where=null ){
		$result = Tb_pedidoDAO::selectCount( $where );
		return $result;
	}
	//--------------------------------------------------------------------------------
	public static function selectAll( $orderBy=null, $where=null ){
		//$result = Tb_pedidoDAO::selectAll( $orderBy, $where );
	    $result = Vw_pedido_qtd_itensDAO::selectAll($orderBy, $where);
		return $result;
	}
	//--------------------------------------------------------------------------------
	public static function save( Tb_pedidoVO $objVo ){
		$result = null;
		if( $objVo->getId_pedido() ) {
			$result = Tb_pedidoDAO::update( $objVo );
		} else {
			$result = Tb_pedidoDAO::insert( $objVo );
		}
		return $result;
	}
	//--------------------------------------------------------------------------------
	private static function saveGridOffItem( $idPedido , $listPedidoItens )
	{
	    if( empty($idPedido) ){
	        throw new InvalidArgumentException('ERRO !! idPedido não pode ser null');
	    }
	    
	    $hasArray = ArrayHelper::has('GDITEM_AEI', $listPedidoItens);
	    if($hasArray) {
    	    foreach ($listPedidoItens['GDITEM_AEI'] as $key => $value) {
    	        $idPedidoItem = $listPedidoItens['ID_ITEM'][$key];
    	        $objVo = new Tb_pedido_itemVO();
    	        if ( ($value == 'A') ) {
    	           $objVo->setId_item( $idPedidoItem );
    	        }
    	        $objVo->setId_pedido( $idPedido );
    	        $objVo->setProduto( $listPedidoItens['PRODUTO'][$key] );
    	        $objVo->setPreco( $listPedidoItens['PRECO'][$key] );
    	        $objVo->setQuantidade( $listPedidoItens['QUANTIDADE'][$key] );
    	        
    	        if ( ($value == 'I') || ($value == 'A') ) {
    	            Tb_pedido_item::save($objVo);
    	        } elseif ($value == 'E') {
    	            Tb_pedido_item::delete($idPedidoItem);
    	        }
    	    }
	    }
	}
	//--------------------------------------------------------------------------------
	public static function validarPedidoGridOff( Tb_pedidoVO $objVo )
	{
	    $listItens = $objVo->getList_pedido_item();
	    if( !is_array($listItens) ){
	        throw new DomainException('Só existe pedido se tiver ao menos 1 item');
	    }
	}	
	public static function saveGridOff( Tb_pedidoVO $objVo )
	{
	    self::validarPedidoGridOff($objVo);
	    //Obs a situação ideial é tudo seja feito com controle de transação do banco de dados.
	    
	    $result = null;
	    $idPedido = $objVo->getId_pedido();
	    if( $idPedido ) {
	        $result = Tb_pedidoDAO::update( $objVo );
	        $listPedidoItens = $objVo->getList_pedido_item();
	        self::saveGridOffItem($idPedido, $listPedidoItens);
	        $result = 1;
	    } else {
	        $objVo->setId_pedido( 'Novo' ); //Para manter compatibilidade com exemplo mestre detalhe
	        $listLastPedido = Tb_pedidoDAO::insert( $objVo );
	        $listPedidoItens = $objVo->getList_pedido_item();	        
	        $lastID = ArrayHelper::getArray($listLastPedido, 'ID_PEDIDO');
	        $idPedido = ArrayHelper::get($lastID, 0);
	        self::saveGridOffItem($idPedido, $listPedidoItens);
	        $result = 1;
	    }
	    return $result;
	}
	//--------------------------------------------------------------------------------
	public static function delete( $id )
	{
	    $result = Tb_pedido_item::deleteByIdPedido($id);
		$result = Tb_pedidoDAO::delete( $id );
		return $result;
	}
}
?>