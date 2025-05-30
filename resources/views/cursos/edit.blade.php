@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h1 class="mb-0 h4"><i class="bi bi-pencil-square"></i> Editar Curso: {{ $curso->nome }}</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('cursos.update', $curso->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- Importante para o método UPDATE --}}

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Curso <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome', $curso->nome) }}" required autofocus>
                        @error('nome')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição Detalhada <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="5" required>{{ old('descricao', $curso->descricao) }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="duracao" class="form-label">Duração (em horas) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-clock-history"></i></span>
                                <input type="number" class="form-control @error('duracao') is-invalid @enderror" id="duracao" name="duracao" value="{{ old('duracao', $curso->duracao) }}" required min="1">
                                @error('duracao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="preco" class="form-label">Preço (R$) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                <input type="text" class="form-control @error('preco') is-invalid @enderror" id="preco" name="preco" value="{{ old('preco', $curso->preco) }}" required>
                                @error('preco')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem de Capa do Curso (opcional)</label>
                        <input type="file" class="form-control @error('imagem') is-invalid @enderror" id="imagem" name="imagem" accept="image/png, image/jpeg, image/gif, image/svg+xml">
                        <div class="form-text">Deixe em branco para manter a imagem atual. Formatos: PNG, JPG, GIF, SVG. Max: 2MB.</div>
                        @error('imagem')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    @if($curso->imagem)
                        <div class="mb-3">
                            <p class="mb-1">Imagem atual:</p>
                            <img src="{{ asset('storage/' . $curso->imagem) }}" alt="Imagem atual de {{ $curso->nome }}" class="img-thumbnail" style="max-height: 150px; background-color: #f8f9fa;">
                        </div>
                    @else
                        <div class="mb-3">
                            <p class="text-muted"><i class="bi bi-image-alt"></i> Nenhuma imagem cadastrada para este curso.</p>
                        </div>
                    @endif


                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ route('cursos.show', $curso->id) }}" class="btn btn-outline-secondary me-md-2"><i class="bi bi-x-circle"></i> Cancelar</a>
                        <button type="submit" class="btn btn-warning"><i class="bi bi-save-fill"></i> Atualizar Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
