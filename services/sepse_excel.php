<?php
$_data = $_POST['data'];

// Incluimos a classe PHPExcel
include  'Classes/PHPExcel.php';

// Instanciamos a classe
$objPHPExcel = new PHPExcel();

// Criando uma nova planilha dentro do arquivo


// Definimos o estilo da fonte
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true)
        ->setSize(15);
$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getFont()->setBold(true)
        ->setSize(14);
 $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

$style_title = array(

    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'CCCCCC')
    )

);
 
 $objPHPExcel->getActiveSheet()->getStyle('A1:L2')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($style_title);

  // Define a planilha ativa para o PHPExcel operar
  $objPHPExcel->setActiveSheetIndex(0);

// Criamos as colunas
$objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:K1')// mesclando celulas
            ->setCellValue('A1', 'PROTOCOLO DE SEPSE '.$_data )
            ->setCellValue('A2', 'SETOR' ) 
            ->setCellValue('B2', "PEDIDO " )
            ->setCellValue("C2", "DATA DO PEDIDO" )
            ->setCellValue("D2", "PACIENTE" )
            ->setCellValue("E2", "LAUDO" )
            ->setCellValue("F2", "BIOQUIMICO" )
            ->setCellValue("G2", "TEMPO TOTAL" )
            ->setCellValue("H2", "TEMPO" )
            ->setCellValue("I2", "INDICADOR" )
            ->setCellValue("J2", "LACTATO" )
            ->setCellValue("K2", "LEUCO" )
            ->setCellValue("L2", "PLAQUETAS" );



// Podemos configurar diferentes larguras paras as colunas como padrão
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);


//recuprando os dados 

           include_once '../controller/Situacao_Controller.class.php';
           include_once 'ProtocoloListIterator.class.php';
           include_once '../beans/Protocolo.class.php';
           $sc = new Situacao_Controller();
           
           $protLista = $sc->listaProtocolo($_data);
           $protListIterator = new ProtocoloListIterator($protLista);
           $protocolo = new Protocolo();


$indice = 2;

while ($protListIterator->hasNextProtocolo()){
    $protocolo = $protListIterator->getNextProtocolo();
    $indice++;
/*$I = 0;
while ($I < 10){
    $indice++;
    $I++;*/
    // Também podemos escolher a posição exata aonde o dado será inserido (coluna, linha, dado);
    //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $indice, 'teste');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $indice, utf8_decode($protocolo->getSetor()));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $indice, utf8_decode($protocolo->getPedido()));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $indice, utf8_decode($protocolo->getDataPedido()));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $indice, utf8_decode($protocolo->getPaciente()));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $indice, utf8_decode($protocolo->getLaudo()));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $indice, utf8_decode($protocolo->getBioquimico()));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $indice, $protocolo->getTempoTotal());
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $indice, $protocolo->getTempo());
    $cor = "ff0000";
    if($protocolo->getIndicador() == "verde"){
        $cor = "2a9f0f";
    }

    cellColor('I'.$indice, $cor);

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $indice, utf8_decode($protocolo->getLactato()));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $indice, utf8_decode($protocolo->getLeuco()));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $indice, utf8_decode($protocolo->getPlaquetas()));

}




// Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
$objPHPExcel->getActiveSheet()->setTitle(utf8_decode('PROTOCOLO SEPSE'));
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Manaus');
/*$data = date('d.m.Y');
$hora = date('H');
$minuto = date('i');
$dados = $data.' '.$hora.'h'.$minuto;*/
$dataArray = explode('/', $_data);
$mes   = $dataArray[0];
$ano   = $dataArray[1];
$dados = $mes."".$ano;
$nome_do_arquivo = "protocolo_sepse_$dados";
$dia_hoje = date('d');
$ano_hoje = date('Y');
$hora_hoje = date('H:i:s');
$dataStr =  'Manaus, '.ucfirst(gmstrftime('%A')).', '.$dia_hoje.' de '.ucfirst(gmstrftime('%B')).' '.$ano_hoje.' '.$hora_hoje;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $indice+5, $dataStr);




//segunda planinha
$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'LAUDOS');

// Attach the "My Data" worksheet as the first worksheet in the PHPExcel object
$objPHPExcel->addSheet($myWorkSheet, 1);

$objPHPExcel->setActiveSheetIndex(1);

//$objPHPExcel->getActiveSheet()->setTitle(utf8_decode('LAUDOS'));


// Definimos o estilo da fonte
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true)
    ->setSize(15);
$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getFont()->setBold(true)
    ->setSize(14);
$style = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    )
);

$style_title = array(

    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'CCCCCC')
    )

);

$objPHPExcel->getActiveSheet()->getStyle('A1:K2')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($style_title);

// Criamos as colunas
$objPHPExcel->setActiveSheetIndex(1)
    ->mergeCells('A1:K1')// mesclando celulas
    ->setCellValue('A1', 'TOTAL DE LAUDOS CONFORMES E NÃO CONFORMES '.$_data )
    ->setCellValue('A2', 'DESCRIÇÃO' )
    ->setCellValue('B2', "TOTAL " );

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

include_once 'LaudosListIterator.class.php';
include_once '../beans/Laudos.class.php';
$sc = new Situacao_Controller();

$protLista = $sc->laudosConformeNaoConforme($_data);
$protListIterator = new LaudosListIterator($protLista);
$laudos = new Laudos();


$indice = 2;

while ($protListIterator->hasNextLaudos()){
    $laudos = $protListIterator->getNextLaudos();
    $indice++;
    /*$I = 0;
    while ($I < 10){
        $indice++;
        $I++;*/
    // Também podemos escolher a posição exata aonde o dado será inserido (coluna, linha, dado);
    //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $indice, 'teste');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $indice, $laudos->getConforme());
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $indice, $laudos->getTotal());


}

//$objPHPExcel->setActiveSheetIndex(0);

/**** FIM DA SEGUNDA PLANILHA **/





/****  TERCEIRA PLANILHA **/
$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'BIOQUIMICOS');

// Attach the "My Data" worksheet as the first worksheet in the PHPExcel object
$objPHPExcel->addSheet($myWorkSheet, 2);

$objPHPExcel->setActiveSheetIndex(2);

//$objPHPExcel->getActiveSheet()->setTitle(utf8_decode('LAUDOS'));


// Definimos o estilo da fonte
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true)
    ->setSize(15);
$objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true)
    ->setSize(14);
$style = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    )
);


$style_title = array(

    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'CCCCCC')
    )

);

$objPHPExcel->getActiveSheet()->getStyle('A1:K2')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($style_title);

// Criamos as colunas
$objPHPExcel->setActiveSheetIndex(2)
    ->mergeCells('A1:C1')// mesclando celulas
    ->setCellValue('A1', 'SEPSE POR BIOQUIMICO '.$_data )
    ->setCellValue('A2', 'BIOQUIMICO' )
    ->setCellValue('B2', 'CONFORME' )
    ->setCellValue('C2', "FORA DO TEMPO" );

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

include_once 'BioquimicoListIterator.class.php';
include_once '../beans/Bioquimico.class.php';
$sc = new Situacao_Controller();

$bioLista = $sc->listaSepsePorBioqumico($_data);
$bioListIterator = new BioquimicoListIterator($bioLista);
$bioquimico = new Bioquimico();


$indice = 2;

while ($bioListIterator->hasNextBioquimico()){
    $bioquimico = $bioListIterator->getNextBioquimico();
    $indice++;
    /*$I = 0;
    while ($I < 10){
        $indice++;
        $I++;*/
    // Também podemos escolher a posição exata aonde o dado será inserido (coluna, linha, dado);
    //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $indice, 'teste');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $indice, $bioquimico->getBioquimico());
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $indice, $bioquimico->getConforme());
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $indice, $bioquimico->getTempo());


}

//$objPHPExcel->setActiveSheetIndex(0);

/**** FIM DA TERECEIRA PLANILHA **/



/****  QUARTA PLANILHA **/
$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'NAO CONFORME');

// Attach the "My Data" worksheet as the first worksheet in the PHPExcel object
$objPHPExcel->addSheet($myWorkSheet, 3);

$objPHPExcel->setActiveSheetIndex(3);

//$objPHPExcel->getActiveSheet()->setTitle(utf8_decode('LAUDOS'));


// Definimos o estilo da fonte
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true)
    ->setSize(15);
$objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true)
    ->setSize(14);
$style = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    )
);

$style_title = array(

    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'CCCCCC')
    )

);

$objPHPExcel->getActiveSheet()->getStyle('A1:K2')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($style_title);

// Criamos as colunas
$objPHPExcel->setActiveSheetIndex(3)
    ->mergeCells('A1:C1')// mesclando celulas
    ->setCellValue('A1', 'SEPSE NAO CONFORME '.$_data )
    ->setCellValue('A2', 'TEMPO' )
    ->setCellValue('B2', 'TOTAL' );

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

include_once 'BioquimicoListIterator.class.php';
include_once '../beans/Bioquimico.class.php';
$sc = new Situacao_Controller();

$naoConformeLista = $sc->listaSepseNaoConforme($_data);
$naoConformeListIterator = new LaudosListIterator($naoConformeLista);
$naoConforme = new Laudos();


$indice = 2;

while ($naoConformeListIterator->hasNextLaudos()){
    $naoConforme = $naoConformeListIterator->getNextLaudos();
    $indice++;
    /*$I = 0;
    while ($I < 10){
        $indice++;
        $I++;*/
    // Também podemos escolher a posição exata aonde o dado será inserido (coluna, linha, dado);
    //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $indice, 'teste');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $indice, $naoConforme ->getConforme());
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $indice, $naoConforme ->getTotal());



}

$objPHPExcel->setActiveSheetIndex(0);

/**** FIM DA QUARTA PLANILHA **/




/****  QUINTA PLANILHA **/
$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'MEDIA DE TEMPO');

// Attach the "My Data" worksheet as the first worksheet in the PHPExcel object
$objPHPExcel->addSheet($myWorkSheet, 4);

$objPHPExcel->setActiveSheetIndex(4);

//$objPHPExcel->getActiveSheet()->setTitle(utf8_decode('LAUDOS'));


// Definimos o estilo da fonte
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true)
    ->setSize(15);
$objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true)
    ->setSize(14);
$style = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    )

);

$style_title = array(

    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'CCCCCC')
    )

);

$objPHPExcel->getActiveSheet()->getStyle('A1:K2')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($style_title);

// Criamos as colunas
$objPHPExcel->setActiveSheetIndex(4)
    ->mergeCells('A1:C1')// mesclando celulas
    ->setCellValue('A1', 'MEDIA DE TEMPO '.$_data )
    ->setCellValue('A2', 'DESCRICAO' )
    ->setCellValue('B2', 'MEDIA' );

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

include_once 'BioquimicoListIterator.class.php';
include_once '../beans/Bioquimico.class.php';
$sc = new Situacao_Controller();

$mediaDeTempoLista = $sc->listaSepseMediaDeTempo($_data);
$mediaDeTempoListIterator = new LaudosListIterator($mediaDeTempoLista);
$mediaDeTempo = new Laudos();


$indice = 2;

while ($mediaDeTempoListIterator->hasNextLaudos()){
    $mediaDeTempo = $mediaDeTempoListIterator->getNextLaudos();
    $indice++;
    /*$I = 0;
    while ($I < 10){
        $indice++;
        $I++;*/
    // Também podemos escolher a posição exata aonde o dado será inserido (coluna, linha, dado);
    //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $indice, 'teste');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $indice, $mediaDeTempo ->getConforme());
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $indice, $mediaDeTempo ->getTotal());



}

$objPHPExcel->setActiveSheetIndex(0);

/**** FIM DA QUINTA PLANILHA **/






// Cabeçalho do arquivo para ele baixar
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$nome_do_arquivo.'.xls"');
header('Cache-Control: max-age=0');
// Se for o IE9, isso talvez seja necessário
header('Cache-Control: max-age=1');

// Acessamos o 'Writer' para poder salvar o arquivo
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

// Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
$objWriter->save('php://output'); 
//$objWriter->save('php://C:/'.$nome_do_arquivo.'xls'); 
//$objWriter->save();

exit;

function cellColor($cells,$color){
    global $objPHPExcel;

    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
            'rgb' => $color
        )
    ));
}
