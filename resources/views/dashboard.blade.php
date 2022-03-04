@extends('layouts.main')


@section('title', 'Dashboard')



@section('content')


<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1> Minhas Solictações</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if (count($events) > 0)

    @else
    <p>Você ainda não tem solicitações!<a href="/events/create">Faça sua soliçitalção</a></p>
    @endif
</div>


@endsection