@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg curso-detalhe-card">
        <div class="row g-0">
            <div class="col-md-5">
                @if($curso->imagem)
                    <img src="{{ asset('storage/' . $curso->imagem) }}" class="img-fluid rounded-start curso-detalhe-imagem" alt="{{ $curso->nome }}">
                @else
                    <img src="https://via.placeholder.com/600x400.png?text=Imagem+Indispon%C3%ADvel" class="img-fluid rounded-start curso-detalhe-imagem" alt="Imagem indisponível">
                @endif
            </div>
            <div class="col-md-7 d-flex flex-column">
                <div class="card-body flex-grow-1">
                    <h1 class="card-title display-6 mb-3"><i class="bi bi-book-fill text-primary"></i> {{ $curso->nome }}</h1>
                    <p class="card-text lead">{{ $curso->descricao }}</p>
                    <hr>
                    <div class="mb-2">
                        <p class="mb-1"><strong><i class="bi bi-clock-history text-secondary"></i> Duração:</strong> {{ $curso->duracao }} horas</p>
                        <p class="mb-1"><strong><i class="bi bi-currency-dollar text-success"></i> Preço:</strong> R$ {{ number_format($curso->preco, 2, ',', '.') }}</p>
                    </div>
                    <p class="card-text"><small class="text-muted">Cadastrado em: {{ $curso->created_at->format('d/m/Y \à\s H:i') }}</small></p>
                     @if($curso->updated_at != $curso->created_at)
                         <p class="card-text"><small class="text-muted">Última atualização: {{ $curso->updated_at->format('d/m/Y \à\s H:i') }}</small></p>
                     @endif
                </div>
                <div class="card-footer bg-light text-center p-3">
                    @auth
                        <a href="{{ route('inscricoes.create', ['curso_id' => $curso->id]) }}" class="btn btn-success btn-lg me-2">
                            <i class="bi bi-check2-circle"></i> Inscrever-se Agora
                        </a>
                        <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-warning me-2"><i class="bi bi-pencil-square"></i> Editar Curso</a>
                        <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja realmente excluir este curso? Esta ação é irreversível!');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Excluir Curso</button>
                        </form>
                    @else
                        <p class="mb-1">Interessado neste curso?</p>
                        <a href="{{ route('login') }}?redirect={{ url()->current() }}" class="btn btn-info me-2"><i class="bi bi-box-arrow-in-right"></i> Faça login para se inscrever</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-info"><i class="bi bi-person-plus-fill"></i> Ou registre-se</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 text-center">
        <a href="{{ route('cursos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left-circle"></i> Voltar ao Catálogo de Cursos</a>
    </div>
</div>
@endsection
