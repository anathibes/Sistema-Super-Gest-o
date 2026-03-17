<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
  public function fornecedores() {
      $fornecedores = [ 
      0 => [
        'nome' => 'Fornecedor 1', 
        'status' => 'N',
        'cnpj' => '00' ,
        'ddd' => '11' , //São Paulo (SP)
        'telefone' => '0000-0000'
        ],
        1 => [
        'nome' => 'Fornecedor 2',
        'status' => 'S' ,
        'cnpj' => null,
        'ddd' => '85', //Fortaleza (CE)
        'telefone' => '0000-0000'
        ],

        2 => [
        'nome' => 'Fornecedor 3',
        'status' => 'S' ,
        'cnpj' => null,
        'ddd' => '32', //Juiz de fora (MG)
        'telefone' => '0000-0000'
        ]
      ];
      
      $msg = !empty($fornecedores[0]['cnpj']) ? 'CNPJ informado' : '';

      return view('app.fornecedor.index', compact('fornecedores','msg'));
  }
}
