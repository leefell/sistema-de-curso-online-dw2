@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h1 class="mb-0 h4"><i class="bi bi-pencil-square"></i> Realizar Nova Inscrição</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('inscricoes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="curso_id" class="form-label">Selecione o Curso <span class="text-danger">*</span></label>
                        <select class="form-select @error('curso_id') is-invalid @enderror" id="curso_id" name="curso_id" required autofocus>
                            <option value="" disabled {{ old('curso_id', request()->get('curso_id')) ? '' : 'selected' }}>-- Escolha um curso --</option>
                            @foreach ($cursos as $id => $nome)
                                <option value="{{ $id }}" {{ old('curso_id', request()->get('curso_id')) == $id ? 'selected' : '' }}>
                                    {{ $nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('curso_id')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="data_inscricao" class="form-label">Data da Inscrição <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('data_inscricao') is-invalid @enderror" id="data_inscricao" name="data_inscricao" value="{{ old('data_inscricao', date('Y-m-d')) }}" required>
                        @error('data_inscricao')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info small">
                        <i class="bi bi-info-circle"></i> Ao confirmar, você estará se inscrevendo no curso selecionado na data especificada.
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ url()->previous(route('cursos.index')) }}" class="btn btn-outline-secondary me-md-2"><i class="bi bi-x-circle"></i> Voltar</a>
                        <button type="submit" class="btn btn-success"><i class="bi bi-check2-circle"></i> Confirmar Inscrição</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
