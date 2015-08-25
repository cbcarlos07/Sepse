<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 include 'ConnectionFactory.class.php';
 include_once 'Paciente.class.php';
 include_once 'SituacaoPaciente.class.php';
 include_once 'SituacaoList.class.php';
 include_once 'SituacaoListIterator.class.php';
 class Situacao_DAO  {
       
       
        public function lista($inicio, $fim){
            $conn = new ConnectionFactory();
            $con = $conn->getConnection();
            //$paciente = new Paciente();
            //$sp = new SituacaoPaciente();
			try{
				// executo a query
                            //$con = ociparse($connection_resource, $sql_text)
                                $query = "SELECT  P.NM_PACIENTE  PACIENTE
                                                  ,A.CD_ATENDIMENTO ATENDIMENTO
                                    FROM  ATENDIME  A
                                         ,PACIENTE  P
                                         ,PRE_MED   PM
                                         ,ITPRE_MED IPM
                                         ,TIP_PRESC TP
                                   WHERE  A.CD_PACIENTE    =   P.CD_PACIENTE
                                     AND  A.CD_ATENDIMENTO =   PM.CD_ATENDIMENTO
                                     AND  IPM.CD_PRE_MED   =   PM.CD_PRE_MED
                                     AND  IPM.CD_TIP_PRESC =   TP.CD_TIP_PRESC
                                     AND  A.TP_ATENDIMENTO =   'I'
                                     AND  TP.CD_TIP_PRESC  =   13334
                                     AND  A.DT_ALTA            IS NULL";
				$stmt = ociparse($con, $query);
                                        //("select p.nm_prestador nome from dbamv.prestador p");
				//$stmt = $this->conex->query($query);
                                oci_execute($stmt);
			   // desconecta 
                              
                           $situacaoList = new SituacaoList();
                           
                         while ($row = oci_fetch_array($stmt, OCI_ASSOC)){
                             
                            // $status = substr($row["SITUACAO"], 2,35);  // retorna "abcde"
                             
                             //echo $status."<br>";
                         /*    if(isset($row["MSG.MENSAGEM"])){
                               $mensagem = $row["MENSAGEM"];  
                             }else{
                               $mensagem = "";  
                             }
                          * */
                          
                             $sp =  new SituacaoPaciente(); 
                             $paciente = new Paciente();                                                       
                             $sp->setAtendimento($row["ATENDIMENTO"]);
                             $paciente->setNome($row["PACIENTE"]);
                             $sp->setPaciente($paciente);
                             $sp->setCirurgiaPrincipal("");
                             $sp->setPrestador("");
                             $sp->setSituacao("");
                             $sp->setMensagem("");
                             
                             $situacaoList->addSituacao($sp);
                             
                         }  
                          
                               
			$conn->closeConnection($con);
			// retorna o resultado da query
			return $situacaoList;
		}catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); }
	}
        
        public function recuperarTotal(){
            $conn = new ConnectionFactory();
            $con = $conn->getConnection();
            //$paciente = new Paciente();
            //$sp = new SituacaoPaciente();
			try{
				// executo a query
                            //$con = ociparse($connection_resource, $sql_text)
                                $query = "SELECT  P.NM_PACIENTE  PACIENTE
                                FROM  ATENDIME  A
                                     ,PACIENTE  P
                                     ,PRE_MED   PM
                                     ,ITPRE_MED IPM
                                     ,TIP_PRESC TP
                               WHERE  A.CD_PACIENTE    =   P.CD_PACIENTE
                                 AND  A.CD_ATENDIMENTO =   PM.CD_ATENDIMENTO
                                 AND  IPM.CD_PRE_MED   =   PM.CD_PRE_MED
                                 AND  IPM.CD_TIP_PRESC =   TP.CD_TIP_PRESC
                                 AND  A.TP_ATENDIMENTO =   'I'
                                 AND  TP.CD_TIP_PRESC  =   13334
                                 AND  A.DT_ALTA            IS NULL";
				$stmt = ociparse($con, $query);
                                        //("select p.nm_prestador nome from dbamv.prestador p");
				//$stmt = $this->conex->query($query);
                                oci_execute($stmt);
			   // desconecta 
                              
                           $situacaoList = new SituacaoList();
                           $total = 0;
                         while ($row = oci_fetch_array($stmt, OCI_ASSOC)){
                             $total++;
                            
                         }
                               
			$conn->closeConnection($con);
			// retorna o resultado da query
			return $total;
		}catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); }
	}
 }