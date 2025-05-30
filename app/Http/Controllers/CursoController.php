<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Para upload de imagens

class CursoController extends Controller
{
    // Aplicar middleware de autenticação para operações específicas
    public function __construct()
    {
        // Apenas 'index' e 'show' são públicos
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource. (LISTAGEM - Público)
     */
    public function index()
    {
        $cursos = Curso::orderBy('nome')->paginate(10); // Exemplo de paginação
        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource. (INSERÇÃO - Autenticado)
     */
    public function create()
    {
        return view('cursos.create');
    }

    /**
     * Store a newly created resource in storage. (INSERÇÃO - Autenticado)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'duracao' => 'required|integer|min:1',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validação da imagem
        ]);

        $dados = $request->except('imagem'); // Pega todos os dados, exceto a imagem por enquanto

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $nomeImagem = time() . '.' . $request->imagem->extension();
            // Salva em 'storage/app/public/cursos_imagens'
            // Lembre-se de rodar `php artisan storage:link` para criar o link simbólico
            $caminhoImagem = $request->imagem->storeAs('cursos_imagens', $nomeImagem, 'public');
            $dados['imagem'] = $caminhoImagem;
        }

        Curso::create($dados);

        return redirect()->route('cursos.index')->with('success', 'Curso criado com sucesso! 🎉');
    }

    /**
     * Display the specified resource. (DETALHES - Público, se desejado, ou adaptar)
     */
    public function show(Curso $curso)
    {
        return view('cursos.show', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource. (ALTERAÇÃO - Autenticado)
     */
    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }

    /**
     * Update the specified resource in storage. (ALTERAÇÃO - Autenticado)
     */
    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'duracao' => 'required|integer|min:1',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $dados = $request->except('imagem');

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            // Apagar imagem antiga se existir
            if ($curso->imagem && Storage::disk('public')->exists($curso->imagem)) {
                Storage::disk('public')->delete($curso->imagem);
            }
            $nomeImagem = time() . '.' . $request->imagem->extension();
            $caminhoImagem = $request->imagem->storeAs('cursos_imagens', $nomeImagem, 'public');
            $dados['imagem'] = $caminhoImagem;
        }

        $curso->update($dados);

        return redirect()->route('cursos.index')->with('success', 'Curso atualizado com sucesso! 🚀');
    }

    /**
     * Remove the specified resource from storage. (EXCLUSÃO - Autenticado)
     */
    public function destroy(Curso $curso)
    {
        // Apagar imagem associada se existir
        if ($curso->imagem && Storage::disk('public')->exists($curso->imagem)) {
            Storage::disk('public')->delete($curso->imagem);
        }

        $curso->delete();
        return redirect()->route('cursos.index')->with('success', 'Curso excluído com sucesso! 🗑️');
    }
}
