<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 include 'ConnectionFactory.class.php';





 //include_once 'services/SituacaoListIterator.class.php';
 class Situacao_DAO  {
       
       
        public function lista($inicio, $fim){
            include_once 'beans/SituacaoPaciente.class.php';
            include_once 'beans/Paciente.class.php';
            include_once 'services/SituacaoList.class.php';
            $conn = new ConnectionFactory();
            $con = $conn->getConnection();
            //$paciente = new Paciente();
            //$sp = new SituacaoPaciente();
			try{
				// executo a query
                            //$con = ociparse($connection_resource, $sql_text)
                                $query = "SELECT CD_PED_LAB,
                                               NM_PACIENTE,
                                               SETOR,
                                               SOM,
                                               DT_PEDIDO,
                                               HR_PED_LAB,
                                               TIPO
                                               FROM DBAMV.VDIC_HAM_PROT_SEPSE";
				$stmt = ociparse($con, $query);
                                        //("select p.nm_prestador nome from dbamv.prestador p");
				//$stmt = $this->conex->query($query);
                                oci_execute($stmt);
			   // desconecta 
                              
                           $situacaoList = new SituacaoList();
                           
                         while ($row = oci_fetch_array($stmt, OCI_ASSOC)){
                            
                             $sp =  new SituacaoPaciente();                                                                                 
                             $sp->setPedido($row["CD_PED_LAB"]);                             
                             $sp->setPaciente($row["NM_PACIENTE"]);
                             $sp->setLocal($row["SETOR"]);
                             $sp->setDescricao($row["TIPO"]);
                             
                             $situacaoList->addSituacao($sp);
                             
                         }  
                          
                               
			$conn->closeConnection($con);
			// retorna o resultado da query
			return $situacaoList;
		}catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); }
	}

     public function laudosConformeNaoConforme($data){
         include_once '../beans/Laudos.class.php';
         include_once '../services/LaudosList.class.php';
         $conn = new ConnectionFactory();
         $con = $conn->getConnection();
         //$paciente = new Paciente();
         //$sp = new SituacaoPaciente();
         try{
             // executo a query
             //$con = ociparse($connection_resource, $sql_text)
             $query = "SELECT CONF
                              ,COUNT(*) TOTAL
                        FROM (
                        SELECT CASE 
                                  WHEN TEMPO_TOTAL = 'CONFORME'
                                     THEN TEMPO_TOTAL
                                  ELSE 'NAO CONFORME'
                               END CONF
                          FROM DBAMV.VDIC_HAM_PROTOCOLO_SEPSE 
                         WHERE DATA_FILTRO = :data_ 
                        )
                        GROUP BY CONF";
             $stmt = ociparse($con, $query);
             //("select p.nm_prestador nome from dbamv.prestador p");
             //$stmt = $this->conex->query($query);
             oci_bind_by_name($stmt, ":data_", $data);
             oci_execute($stmt);
             // desconecta

             $laudosList = new LaudosList();

             while ($row = oci_fetch_array($stmt, OCI_ASSOC)){

                 $sp =  new Laudos();
                 $sp->setConforme($row["CONF"]);
                 $sp->setTotal($row["TOTAL"]);

                 $laudosList->addLaudos($sp);

             }


             $conn->closeConnection($con);
             // retorna o resultado da query
             return $laudosList;
         }catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); }
     }

     public function listaProtocolo($data){
         include_once '../beans/Protocolo.class.php';
         include_once '../services/ProtocoloList.class.php';
         $conn = new ConnectionFactory();
         $con = $conn->getConnection();
         //$paciente = new Paciente();
         //$sp = new SituacaoPaciente();
         try{
             // executo a query
             //$con = ociparse($connection_resource, $sql_text)
             $query = "SELECT SETOR
                            ,CD_PED_LAB pedido 
                            ,DATA_PEDIDO
                            ,PACIENTE NM_PACIENTE
                            ,LAUDO
                            ,BIOQUIMICO
                            ,TEMPO_TOTAL
                            ,TEMPO
                            ,INDICADOR
                            ,LACTATO
                            ,LEUCO
                            ,PLAQUETAS
                              FROM DBAMV.VDIC_HAM_PROTOCOLO_SEPSE where data_filtro = :data_
                        ";
             //TO_CHAR(DATA_FILTRO,'MM/YYYY') = NVL ('04/2017',TO_CHAR(SYSDATE,'MM/YYYY'))
             $stmt = ociparse($con, $query);
           //  echo "Data: ".$data;
             oci_bind_by_name($stmt, ":data_", $data);
             oci_execute($stmt);
             // desconecta

             $protocoloList = new ProtocoloList();

             while ($row = oci_fetch_array($stmt, OCI_ASSOC)){
                 if(isset($row['LACTATO'])){
                     $lactato = $row['LACTATO'];
                 }else{
                     $lactato = "";
                 }

                 if(isset($row['LEUCO'])){
                     $leuco = $row['LEUCO'];
                 }else{
                     $leuco = "";
                 }

                 if(isset($row['PLAQUETAS'])){
                     $plaquetas = $row['PLAQUETAS'];
                 }else{
                     $plaquetas = "";
                 }

                 if(isset($row['BIOQUIMICO'])){
                     $bioquimico = $row['BIOQUIMICO'];
                 }else{
                     $bioquimico = "";
                 }

                // echo "Bioquimico: ".$bioquimico;
                 $sp =  new Protocolo();
                 $sp->setSetor($row['SETOR']);
                 $sp->setPedido($row["PEDIDO"]);
                 $sp->setDataPedido($row['DATA_PEDIDO']);
                // $sp->setDataPedido($row['DATA_PEDIDO']);
                 $sp->setPaciente($row["NM_PACIENTE"]);
                 $sp->setLaudo($row['LAUDO']);
                 $sp->setBioquimico($bioquimico);
                 $sp->setTempoTotal($row['TEMPO_TOTAL']);
                 $sp->setTempo($row['TEMPO']);
                 $sp->setIndicador($row['INDICADOR']);
                 $sp->setLactato($lactato);
                 $sp->setLeuco($leuco);
                 $sp->setPlaquetas($plaquetas);


                 $protocoloList->addProtocolo($sp);

             }


             $conn->closeConnection($con);
             // retorna o resultado da query
             return $protocoloList;
         }catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); }
     }
        
        public function recuperarTotal(){
            $conn = new ConnectionFactory();
            $con = $conn->getConnection();
            $total = 0;
            //$paciente = new Paciente();
            //$sp = new SituacaoPaciente();
			try{
				// executo a query
                            //$con = ociparse($connection_resource, $sql_text)
                                $query = "SELECT CD_PED_LAB,
                                               NM_PACIENTE,
                                               SETOR,
                                               SOM,
                                               DT_PEDIDO,
                                               HR_PED_LAB,
                                               TIPO
                                               FROM DBAMV.VDIC_HAM_PROT_SEPSE
                                     ";
				$stmt = ociparse($con, $query);
                                        //("select p.nm_prestador nome from dbamv.prestador p");
				//$stmt = $this->conex->query($query);
                                oci_execute($stmt);
			   // desconecta 
                              

                           
                         while ($row = oci_fetch_array($stmt, OCI_ASSOC)){
                             $total++;
                            
                         }
                               
			$conn->closeConnection($con);
			// retorna o resultado da query
			return $total;
		}catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); }
	}

     public function listaSepsePorBioqumico($data){
         include_once '../beans/Bioquimico.class.php';
         include_once '../services/BioquimicoList.class.php';
         $conn = new ConnectionFactory();
         $con = $conn->getConnection();
         //$paciente = new Paciente();
         //$sp = new SituacaoPaciente();
         try{
             // executo a query
             //$con = ociparse($connection_resource, $sql_text)
             $query = "SELECT DISTINCT BIO.BIOQUIMICO
                              ,DECODE(CONF.TOTAL,NULL,0,CONF.TOTAL) CONFORME
                              ,DECODE(N_CONF.TOTAL,NULL,0,N_CONF.TOTAL) FORA_TEMPO
                          FROM (
                                SELECT BIOQUIMICO
                                      ,COUNT(*) TOTAL
                                  FROM DBAMV.VDIC_HAM_PROTOCOLO_SEPSE 
                                 WHERE DATA_FILTRO = :data_
                                 -- AND TP_ATENDIMENTO = 'I'
                                   AND TEMPO_TOTAL = 'CONFORME'
                                GROUP BY BIOQUIMICO
                                ORDER BY 2 DESC
                               ) CONF
                              ,(
                               SELECT BIOQUIMICO
                                      ,COUNT(*) TOTAL
                                  FROM DBAMV.VDIC_HAM_PROTOCOLO_SEPSE 
                                 WHERE DATA_FILTRO = :data_-- AND TP_ATENDIMENTO = 'I'
                                   AND TEMPO_TOTAL <> 'CONFORME'
                                GROUP BY BIOQUIMICO
                                ORDER BY 2 DESC
                              ) N_CONF
                             ,(
                               SELECT BIOQUIMICO
                                  FROM DBAMV.VDIC_HAM_PROTOCOLO_SEPSE 
                                 WHERE DATA_FILTRO = :data_
                             ) BIO
                             
                         WHERE BIO.BIOQUIMICO = CONF.BIOQUIMICO(+)
                           AND BIO.BIOQUIMICO = N_CONF.BIOQUIMICO(+)
                        ORDER BY 2 DESC
                        ";
             //TO_CHAR(DATA_FILTRO,'MM/YYYY') = NVL ('04/2017',TO_CHAR(SYSDATE,'MM/YYYY'))
             $stmt = ociparse($con, $query);
             //  echo "Data: ".$data;
             oci_bind_by_name($stmt, ":data_", $data);
             oci_execute($stmt);
             // desconecta

             $bioquimicoList = new BioquimicoList();

             while ($row = oci_fetch_array($stmt, OCI_ASSOC)){
                 $bioquimico = new Bioquimico();
                 $nome = "";
                 if(isset($row['BIOQUIMICO']))  {
                     $nome = $row['BIOQUIMICO'];
                 }
                 $bioquimico->setBioquimico($nome);
                 $bioquimico->setConforme($row['CONFORME']);
                 $bioquimico->setTempo($row['FORA_TEMPO']);

                 $bioquimicoList->addBioquimico($bioquimico);

             }


             $conn->closeConnection($con);
             // retorna o resultado da query
             return $bioquimicoList;
         }catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); }


     }

             public function listaSepseNaoConforme($data){
             include_once '../beans/Laudos.class.php';
             include_once '../services/LaudosList.class.php';
             $conn = new ConnectionFactory();
             $con = $conn->getConnection();
             //$paciente = new Paciente();
             //$sp = new SituacaoPaciente();
             try{
                 // executo a query
                 //$con = ociparse($connection_resource, $sql_text)
                 $query = "SELECT TEMPO
                                      ,COUNT(*) TOTAL
                                  FROM (
                                        SELECT CASE
                                                 WHEN MAIOR_HR BETWEEN 0.766666 AND 0.81666
                                                   THEN '4 MINUTOS'
                                                 WHEN MAIOR_HR BETWEEN 0.81667 AND 0.883333
                                                   THEN '8 MINUTOS'
                                                 WHEN MAIOR_HR BETWEEN 0.883334 AND 1
                                                   THEN '15 MINUTOS'
                                                 WHEN MAIOR_HR > 1
                                                   THEN 'ACIMA 15 MINUTOS'
                                                 END TEMPO
                                          FROM DBAMV.VDIC_HAM_PROTOCOLO_SEPSE A
                                         WHERE DATA_FILTRO = :data_
                                        -- AND TP_ATENDIMENTO = 'I'
                                           AND TEMPO_TOTAL <> 'CONFORME'
                                       )
                                GROUP BY TEMPO
                                ORDER BY 1 DESC
                                ";
                 //TO_CHAR(DATA_FILTRO,'MM/YYYY') = NVL ('04/2017',TO_CHAR(SYSDATE,'MM/YYYY'))
                 $stmt = ociparse($con, $query);
                 //  echo "Data: ".$data;
                 oci_bind_by_name($stmt, ":data_", $data);
                 oci_execute($stmt);
                 // desconecta

                 $laudoList = new LaudosList();

                 while ($row = oci_fetch_array($stmt, OCI_ASSOC)){
                     $laudo = new Laudos();
                     $laudo->setConforme($row['TEMPO']);
                     $laudo->setTotal($row['TOTAL']);

                     $laudoList->addLaudos($laudo);

                 }


                 $conn->closeConnection($con);
                 // retorna o resultado da query
                 return $laudoList;
             }catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); }


         }

     public function listaSepseMediaDeTempo($data){
         include_once '../beans/Laudos.class.php';
         include_once '../services/LaudosList.class.php';
         $conn = new ConnectionFactory();
         $con = $conn->getConnection();
         //$paciente = new Paciente();
         //$sp = new SituacaoPaciente();
         try{
             // executo a query
             //$con = ociparse($connection_resource, $sql_text)
             $query = "SELECT 'CONFORME' DESCRICAO
                              ,DBAMV.FNC_CONVERTE_DIA_HR2(SUM(MAIOR_HR)/SUM(CONTADOR)/24) MEDIA
                          FROM DBAMV.VDIC_HAM_PROTOCOLO_SEPSE A
                         WHERE DATA_FILTRO = :data_
                           AND TEMPO_TOTAL = 'CONFORME'
                           
                        UNION
                        
                        SELECT 'NAO CONFORME'
                              ,DBAMV.FNC_CONVERTE_DIA_HR2(SUM(MAIOR_HR)/SUM(CONTADOR)/24)
                          FROM DBAMV.VDIC_HAM_PROTOCOLO_SEPSE A
                         WHERE DATA_FILTRO = :data_
                           AND TEMPO_TOTAL <> 'CONFORME'
                        ";
             //TO_CHAR(DATA_FILTRO,'MM/YYYY') = NVL ('04/2017',TO_CHAR(SYSDATE,'MM/YYYY'))
             $stmt = ociparse($con, $query);
             //  echo "Data: ".$data;
             oci_bind_by_name($stmt, ":data_", $data);
             oci_execute($stmt);
             // desconecta

             $laudoList = new LaudosList();

             while ($row = oci_fetch_array($stmt, OCI_ASSOC)){
                 $laudo = new Laudos();
                 $media = "";
                 if(isset($row['MEDIA']))
                     $media = $row['MEDIA'];

                 $laudo->setConforme($row['DESCRICAO']);
                 $laudo->setTotal($media);

                 $laudoList->addLaudos($laudo);

             }


             $conn->closeConnection($con);
             // retorna o resultado da query
             return $laudoList;
         }catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); }


     }

 }