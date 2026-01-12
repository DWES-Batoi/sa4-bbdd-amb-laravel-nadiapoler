@extends('layouts.app')
@extends('layouts.equip')

@section('content')
<div class="container">
  <h1 class="title">Llistat de partits</h1>

  <div class="grid-cards">
    @foreach ($partits as $partit)
    <article class="card">
      <header class="card__header">
        <h2 class="card__title">
          {{ $partit->local?->nom ?? 'Equip desconegut' }}
          vs
          {{ $partit->visitant?->nom ?? 'Equip desconegut' }}
        </h2>
        <span class="card__badge">ID: {{ $partit->id }}</span>
      </header>
      <div class="card__body">
        <p><strong>Data:</strong> {{ $partit->data?->format('d/m/Y') ?? 'Sense data' }}</p>
        <p><strong>Resultat:</strong> {{ $partit->gols_local }} - {{ $partit->gols_visitant }}</p>
      </div>

      <footer class="card__footer">
        <a class="btn btn--ghost" href="{{ route('partits.show', $partit) }}">Veure</a>
        <a class="btn btn--primary" href="{{ route('partits.edit', $partit) }}">Editar</a>

        <form method="POST" action="{{ route('partits.destroy', $partit) }}" class="inline">
          @csrf
          @method('DELETE')
          <button class="btn btn--danger" type="submit">Eliminar</button>
        </form>
      </footer>
    </article>
    @endforeach
  </div>
</div>
@endsection