<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteContato;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {
        // Apenas salva no banco quando o formulário for enviado (método POST)
        if ($request->isMethod('post')) {
            $regras = [
                'nome' => 'required|min:3|max:50',
                'telefone' => 'required',
                'email' => 'required|email',
                'motivo_contatos' => 'required',
                'mensagem' => 'required|max:2000',
            ];

            $feedback = [
                'nome.required' => 'O campo nome é obrigatório.',
                'nome.min' => 'O nome deve ter ao menos 3 caracteres.',
                'email.email' => 'O e-mail deve ser válido.',
                'motivo_contatos.required' => 'O motivo do contato é obrigatório.',
                'mensagem.required' => 'A mensagem é obrigatória.',
            ];

            $request->validate($regras, $feedback);

            $contato = new SiteContato();
            $contato->nome = $request->input('nome');
            $contato->telefone = $request->input('telefone');
            $contato->email = $request->input('email');
            $contato->motivo_contatos = $request->input('motivo_contatos');
            $contato->mensagem = $request->input('mensagem');
            $contato->save();

            return redirect()->route('site.contato')->with('success', 'Mensagem enviada com sucesso!');
        }

        return view('site.contato');
    }
}
