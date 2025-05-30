@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0"><i class="bi bi-card-checklist"></i> Minhas Inscrições</h1>
    <a href="{{ route('inscricoes.create') }}" class="btn btn-success"><i class="bi bi-pencil-square"></i> Fazer Nova Inscrição</a>
</div>

@if($inscricoes->isEmpty())
    <div class="alert alert-info shadow-sm">
        <i class="bi bi-info-circle-fill"></i> Você ainda não realizou nenhuma inscrição.
        <a href="{{ route('cursos.index') }}" class="alert-link">Explore nosso catálogo de cursos</a> e inscreva-se!
    </div>
@else
    <div class="card shadow-sm">
        <div class="card-header">
            Lista de Cursos Inscritos
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><i class="bi bi-book-fill"></i> Curso</th>
                        <th scope="col"><i class="bi bi-calendar-event-fill"></i> Data da Inscrição</th>
                        <th scope="col" class="text-center"><i class="bi bi-tools"></i> Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inscricoes as $index => $inscricao)
                    <tr>
                        <th scope="row">{{ $inscricoes->firstItem() + $index }}</th>
                        <td>
                            @if($inscricao->curso)
                                <a href="{{ route('cursos.show', $inscricao->curso->id) }}" class="text-decoration-none">
                                    {{ $inscricao->curso->nome }}
                                </a>
                            @else
                                <span class="text-muted">Curso não encontrado</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($inscricao->data_inscricao)->isoFormat('LL') }}</td> {{-- Data formatada --}}
                        <td class="text-center">
                            {{-- Se houver uma view de detalhes da inscrição --}}
                            {{-- <a href="{{ route('inscricoes.show', $inscricao) }}" class="btn btn-outline-info btn-sm me-1" title="Ver Detalhes"><i class="bi bi-eye"></i></a> --}}

                            {{-- Editar inscrição pode não ser comum, mais comum é cancelar --}}
                            {{-- <a href="{{ route('inscricoes.edit', $inscricao) }}" class="btn btn-outline-warning btn-sm me-1" title="Editar Inscrição"><i class="bi bi-pencil"></i></a> --}}

                            <form action="{{ route('inscricoes.destroy', $inscricao) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja cancelar esta inscrição?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Cancelar Inscrição"><i class="bi bi-x-octagon-fill"></i> Cancelar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($inscricoes->hasPages())
            <div class="card-footer bg-light">
                {{ $inscricoes->links() }}
            </div>
        @endif
    </div>
@endif
@endsection
