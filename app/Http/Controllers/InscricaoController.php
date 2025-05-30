<?php

namespace App\Http\Controllers;

use App\Models\Inscricao;
use App\Models\Curso; // Para listar cursos no formulário de inscrição
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Para associar inscrição ao usuário logado

class InscricaoController extends Controller
{
    // Todas as operações de Inscrição requerem autenticação
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource. (LISTAGEM - Autenticado)
     * Poderia ser uma lista de "Minhas Inscrições" ou todas as inscrições (admin)
     */
    public function index()
    {
        // Exemplo: Listar inscrições do usuário logado
        // $inscricoes = Inscricao::where('user_id', Auth::id())->with('curso')->latest()->paginate(10);
        // Ou listar todas se for um admin (requer lógica de roles/permissions)
        $inscricoes = Inscricao::with('curso')->latest()->paginate(10);
        return view('inscricoes.index', compact('inscricoes'));
    }

    /**
     * Show the form for creating a new resource. (INSERÇÃO - Autenticado)
     */
    public function create()
    {
        $cursos = Curso::orderBy('nome')->pluck('nome', 'id'); // Para um select no formulário
        return view('inscricoes.create', compact('cursos'));
    }

    /**
     * Store a newly created resource in storage. (INSERÇÃO - Autenticado)
     */
    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'data_inscricao' => 'required|date',
        ]);

        $dados = $request->all();
        // Se você adicionou user_id à tabela Inscrições:
        // $dados['user_id'] = Auth::id();

        Inscricao::create($dados);

        return redirect()->route('inscricoes.index')->with('success', 'Inscrição realizada com sucesso! ✅');
    }

    /**
     * Display the specified resource.
     * (Pode não ser necessário um 'show' individual para inscrições, a menos que haja detalhes específicos)
     */
    public function show(Inscricao $inscricao)
    {
        // Se precisar carregar o curso associado: $inscricao->load('curso');
        return view('inscricoes.show', compact('inscricao'));
    }

    /**
     * Show the form for editing the specified resource. (ALTERAÇÃO - Autenticado)
     * (Editar uma inscrição pode ser complexo, talvez apenas cancelar/excluir seja mais comum)
     */
    public function edit(Inscricao $inscricao)
    {
        $cursos = Curso::orderBy('nome')->pluck('nome', 'id');
        return view('inscricoes.edit', compact('inscricao', 'cursos'));
    }

    /**
     * Update the specified resource in storage. (ALTERAÇÃO - Autenticado)
     */
    public function update(Request $request, Inscricao $inscricao)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'data_inscricao' => 'required|date',
        ]);

        $inscricao->update($request->all());

        return redirect()->route('inscricoes.index')->with('success', 'Inscrição atualizada com sucesso! 🔄');
    }

    /**
     * Remove the specified resource from storage. (EXCLUSÃO - Autenticado)
     * (Cancelar Inscrição)
     */
    public function destroy(Inscricao $inscricao)
    {
        $inscricao->delete();
        return redirect()->route('inscricoes.index')->with('success', 'Inscrição cancelada com sucesso! ❌');
    }
}
