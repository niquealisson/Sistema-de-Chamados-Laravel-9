@extends('layouts.main')


@section('title','Editando Solicitação: '. $event->title)



@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando sua Solicitação: {{ $event->title }}</h1>
    <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Logo da empresa: </label>
            <input type="file" id="image" name="image" class="form-contro-file">
            <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-preview">
        </div>
        <div class="form-group">
            <label for="title">Solicitação: </label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome da Solicitação" value="{{ $event->title }}">
        </div>
        <div class="form-group">
            <label for="title">empresa: </label>
            <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Nome da Empresa" value="{{ $event->empresa }}">
        </div>
        <div class="form-group">
            <label for="date">Data de criação da solicitação: </label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $event->date->format('Y-m-d') }}">
        </div>

        <div class="form-group">
            <label for="title">Descrição da Solicitação: </label>
            <textarea class="form-control" id="description" name="description" placeholder="Descrição">{{ $event->description}}</textarea>
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
        <input type="submit" class="btn btn-primary" value="Editar Solicitação">
    </form>
</div>

@endsection