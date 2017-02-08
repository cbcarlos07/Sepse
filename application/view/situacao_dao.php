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
                              
                           $situacaoList = new SituacaoList();
                           
                         while ($row = oci_fetch_array($stmt, OCI_ASSOC)){
                             $total++;
                            
                         }
                               
			$conn->closeConnection($con);
			// retorna o resultado da query
			return $total;
		}catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); }
	}
 }