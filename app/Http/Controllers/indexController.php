<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cep;
use App\Helper\Consulta;

class indexController extends Controller
{
    function index(){
    	return view('index');
    }

    function pesquisar(Request $request){
    	$this->validate($request, [
    		'cep' => ['required', 'numeric'],
    	]);

    	$cep = DB::table('cep')->select('id')->where('cep', '=', $request->cep)->first();

    	if(!empty($cep)){
    		return redirect('/listar/' . $cep->id);
    	}

    	$dados = Consulta::cep($request->cep);

    	if(!empty($dados)){
    		$cep = new Cep();

    		$cep->cep = $dados->return->cep;
    		$cep->cidade = $dados->return->cidade;
    		$cep->estado = $dados->return->uf;
    		$cep->bairro = $dados->return->bairro;
    		$cep->endereco = $dados->return->end;

    		$cep->save();

    		return redirect('/listar/' . $cep->id);
    	}

    	return view('index', ['mensagem' => 'CEP inválido']);
    }

    function listar($cep){
    	$objCep = DB::table('cep')->select('cidade')->where('id', '=', $cep)->first();

    	if(!empty($objCep->cidade)){
    		return view('listar', ['cidade' => $objCep->cidade]);
    	}

    	return redirect('/');
    }
}
