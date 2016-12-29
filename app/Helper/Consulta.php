<?php

namespace App\Helper;

class Consulta{

	static function cep($cep){
		try{
			$SoapClient = new \SoapClient("https://apps.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente?wsdl");
			return $SoapClient->consultaCEP(['cep' => $cep]);	
		}catch (\Exception $e) { 
		    return false;
		} 
	} 
}