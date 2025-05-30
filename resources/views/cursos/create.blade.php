@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0 h4"><i class="bi bi-plus-lg"></i> Cadastrar Novo Curso</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('cursos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Curso <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}" required autofocus>
                        @error('nome')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição Detalhada <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="5" required>{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="duracao" class="form-label">Duração (em horas) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-clock-history"></i></span>
                                <input type="number" class="form-control @error('duracao') is-invalid @enderror" id="duracao" name="duracao" value="{{ old('duracao') }}" required min="1" placeholder="Ex: 40">
                                @error('duracao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="preco" class="form-label">Preço (R$) <span class="text-danger">*</span></label>
                             <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                <input type="text" class="form-control @error('preco') is-invalid @enderror" id="preco" name="preco" value="{{ old('preco') }}" required placeholder="Ex: 99.90">
                                @error('preco')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem de Capa do Curso (opcional)</label>
                        <input type="file" class="form-control @error('imagem') is-invalid @enderror" id="imagem" name="imagem" accept="image/png, image/jpeg, image/gif, image/svg+xml">
                        <div class="form-text">Formatos aceitos: PNG, JPG, GIF, SVG. Tamanho máximo: 2MB.</div>
                        @error('imagem')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ route('cursos.index') }}" class="btn btn-outline-secondary me-md-2"><i class="bi bi-x-circle"></i> Cancelar</a>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Salvar Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
