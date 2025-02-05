<?php

/*
 * Formdin Framework
 * Copyright (C) 2012 Ministério do Planejamento
 * ----------------------------------------------------------------------------
 * This file is part of Formdin Framework.
 *
 * Formdin Framework is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public License version 3
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License version 3
 * along with this program; if not,  see <http://www.gnu.org/licenses/>
 * or write to the Free Software Foundation, Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA  02110-1301, USA.
 * ----------------------------------------------------------------------------
 * Este arquivo é parte do Framework Formdin.
 *
 * O Framework Formdin é um software livre; você pode redistribuí-lo e/ou
 * modificá-lo dentro dos termos da GNU LGPL versão 3 como publicada pela Fundação
 * do Software Livre (FSF).
 *
 * Este programa é distribuído na esperança que possa ser útil, mas SEM NENHUMA
 * GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer MERCADO ou
 * APLICAÇÃO EM PARTICULAR. Veja a Licença Pública Geral GNU/LGPL em português
 * para maiores detalhes.
 *
 * Você deve ter recebido uma cópia da GNU LGPL versão 3, sob o título
 * "LICENCA.txt", junto com esse programa. Se não, acesse <http://www.gnu.org/licenses/>
 * ou escreva para a Fundação do Software Livre (FSF) Inc.,
 * 51 Franklin St, Fifth Floor, Boston, MA 02111-1301, USA.
 */

d($_REQUEST);

$frm = new TForm('Exemplo Mensagem apenas PHP', 200, 900);
$frm->addTextField('nome', 'Nome:', 30);

$frm->addButton('Msg Alert', 'msgalert', null, null, null, true, false);
$frm->addButton('Msg POP Sucesso', 'msgpopsu', null, null, null, false, false);
$frm->addButton('Msg POP Error', 'msgpoperror', null, null, null, false, false);
$frm->addButton('Msg POP Attention', 'msgpopattention', null, null, null, false, false);


$acao = isset($acao) ? $acao : null;
switch ($acao) {
    case 'msgalert':
        $frm->setMessage('Mensagem Alert Normal');
    break;
    //--------------------------------------------------------------------------------
    case 'msgpopsu':
        $frm->setPopUpMessage('Mensagem Pop-up sucesso');
    break;
    //--------------------------------------------------------------------------------
    case 'msgpoperror':
        $frm->setPopUpMessage('Mensagem Pop-up Error',null,'ERROR');
    break;
    //--------------------------------------------------------------------------------
    case 'msgpopattention':
        $frm->setPopUpMessage('Mensagem Pop-up Attention',null,'ATTENTION');
    break;
}

$frm->show();
?>