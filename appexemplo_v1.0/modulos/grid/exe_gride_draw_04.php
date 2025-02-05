<?php
// simulação de dados para o gride
$dados = null;
$dados['ID'][]    = 1;
$dados['NOME'][]  = 'Linha1';
$dados['ATIVO'][] = 'S';
$dados['GRUPO'][] = 'A';
$dados['VALOR'][] = '7';


$dados['ID'][]    = 2;
$dados['NOME'][]  = 'Linha2';
$dados['ATIVO'][] = 'S';
$dados['GRUPO'][] = 'A';
$dados['VALOR'][] = '4';


$dados['ID'][]    = 3;
$dados['NOME'][]  = 'Linha3';
$dados['ATIVO'][] = 'N';
$dados['GRUPO'][] = 'C';
$dados['VALOR'][] = '5';

$dados['ID'][]    = 4;
$dados['NOME'][]  = 'Linha4';
$dados['ATIVO'][] = 'N';
$dados['GRUPO'][] = 'C';
$dados['VALOR'][] = '10';


$dados['ID'][]    = 5;
$dados['NOME'][]  = 'Linha5';
$dados['ATIVO'][] = 'S';
$dados['GRUPO'][] = 'C';
$dados['VALOR'][] = '3';


$frm = new TForm('Gride Draw 04 - Desativando Botões v2', 300, 700);

$html1 = '<b>ATENÇÃO</b>: Quando a ATIVO=N desativa os botões. Faz uso da função setVisible';
$frm->addHtmlField('html1', $html1, null, null, null, null)->setCss('border', '1px solid #ffeb3b')->setCss('background-color', '#ffffcc')->setCss('margin-bottom', '10px');

$gride = new TGrid('gdTeste' // id do gride
                , 'Título do Gride' // titulo do gride
                , $dados   // array de dados
                , null     // altura do gride
                , null     // largura do gride
                , 'ID');     // chave primaria
$gride->setOnDrawActionButton('confButton');

$gride->addColumn('ID', 'id');
$gride->addColumn('NOME', 'Nome', 100);
$gride->addColumn('ATIVO', 'Ativo');
$gride->addColumn('GRUPO', 'grupo');
$gride->addColumn('VALOR', 'Valor');


$gride->addbutton('Alterar', $gride->getId() .'_alterar', null, null, null, 'alterar.gif', null, 'Alterar' );
$gride->addButton('Excluir', $gride->getId() .'_excluir', null, 'fwGridConfirmDelete()', null, 'lixeira.gif', null, 'Excluir' );
$gride->addButton('Detalhes', null, null, 'openModal(ICODIGO,ICODIGO)');


$frm->addHtmlField('gride', $gride);

$frm->setAction('POST PAGINA');
$frm->show();


function confButton($rowNum, TButton $button, $objColumn, $aData)
{
    if ($aData['ATIVO']=='N') {
        $Property = $button->getProperty('name');
        if($Property == 'gdTesteDetalhes'){
            $button->setVisible(false);
        }
    }
}

?>
<script>

//Window.keepMultiModalWindow=true;
function openModal(campo,valor) {
	var dados = fwFV2O(campo,valor); // tranforma os parametros enviados pelo gride em um objeto 
	
    fwModalBox(dados['SNOME'],'index.php?modulo=layouts.php',350,400,null,dados);
}
</script>
