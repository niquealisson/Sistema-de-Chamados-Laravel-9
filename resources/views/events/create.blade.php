@extends('layouts.main')


@section('title','Criar Solicitação')



@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie sua Solicitação</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Imagem Exemplo da solicitação, Ou logo da Empresa: </label>
            <input type="file" id="image" name="image" class="form-contro-file"value="{{ old('image') }}">
        </div>


        <div class="form-group">
            <label for="title">Nome da Solicitação: </label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome da Solicitação" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="title">Nome da Empresa: </label>
            <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Nome da Empresa" value="{{ old('empresa') }}">
        </div>

        <div class="form-group">
            <label for="date">Data de criação da solicitação: </label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
        </div>

        <div class="form-group">
            <label for="title">Descrição da Solicitação: </label>
            <textarea class="form-control" id="description" name="description" placeholder="Descrição">{{ old('description') }}</textarea>
        </div>
        <label for="title">Uregncia? </label>
        <select name="private" id="private" class="form-control">
            <option value="0">Não</option>
            <option value="1">Sim</option>
        </select>
        <div class="form-group">
            <label for="title">Adcione a opção</label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Nova Funcionalidade"> Nova Funcionalidade
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Correção de BUGS"> Correção de Bugs
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Enviar Solicitação">
    </form>
</div>

@endsection