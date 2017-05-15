<?php
/**
 * Created by PhpStorm.
 * User: carlos.bruno
 * Date: 10/05/2017
 * Time: 11:52
 */
include_once '../controller/Situacao_Controller.class.php';
include_once 'ProtocoloListIterator.class.php';
include_once '../beans/Protocolo.class.php';
$sc = new Situacao_Controller();
$_data = $_POST['data'];
$protLista = $sc->listaProtocolo($_data);
$protListIterator = new ProtocoloListIterator($protLista);
$protocolo = new Protocolo();


echo "<table>";


while ($protListIterator->hasNextProtocolo()) {
    $protocolo = $protListIterator->getNextProtocolo();

echo "    <tr>
        <td>
           ".utf8_decode($protocolo->getPedido())."
        </td>
    </tr>";

}

echo "</table>";