@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0"><i class="bi bi-journals"></i> Catálogo de Cursos</h1>
    @auth
        <a href="{{ route('cursos.create') }}" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i> Adicionar Novo Curso</a>
    @endauth
</div>

@if($cursos->isEmpty())
    <div class="alert alert-info shadow-sm">
        <i class="bi bi-info-circle-fill"></i> Nenhum curso cadastrado no momento.
        @auth
            Seja o primeiro a <a href="{{ route('cursos.create') }}" class="alert-link">adicionar um novo curso</a>!
        @else
            Volte em breve para conferir as novidades.
        @endauth
    </div>
@else
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($cursos as $curso)
        <div class="col">
            <div class="card h-100 shadow-sm curso-card">
                @if($curso->imagem)
                    <img src="{{ asset('storage/' . $curso->imagem) }}" class="card-img-top curso-imagem" alt="{{ $curso->nome }}">
                @else
                    <img src="https://via.placeholder.com/350x200.png?text=Imagem+Indispon%C3%ADvel" class="card-img-top curso-imagem" alt="Imagem indisponível">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $curso->nome }}</h5>
                    <p class="card-text text-muted small flex-grow-1">{{ Str::limit($curso->descricao, 120) }}</p>
                    <div class="mt-2">
                        <p class="card-text mb-1"><small class="text-body-secondary"><i class="bi bi-clock"></i> Duração: {{ $curso->duracao }} horas</small></p>
                        <p class="card-text"><strong><i class="bi bi-cash-coin"></i> Preço: R$ {{ number_format($curso->preco, 2, ',', '.') }}</strong></p>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0 text-center pb-3">
                    <a href="{{ route('cursos.show', $curso) }}" class="btn btn-primary btn-sm me-1"><i class="bi bi-eye-fill"></i> Ver Detalhes</a>
                    @auth
                        <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-outline-warning btn-sm me-1"><i class="bi bi-pencil-fill"></i> Editar</a>
                        <form action="{{ route('cursos.destroy', $curso) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este curso? Esta ação não poderá ser desfeita.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash-fill"></i> Excluir</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {{ $cursos->links() }} {{-- Paginação --}}
    </div>
@endif
@endsection
