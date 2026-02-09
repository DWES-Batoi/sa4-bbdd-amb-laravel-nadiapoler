@extends('layouts.equip')

@section('title', __('Equips'))

@section('content')
<div class="container">
  <h1 class="title equips-index">{{ __('Llistat d\'equips') }}</h1>

  <div class="grid-cards">
    @foreach ($equips as $equip)
      <article class="card">
        <header class="card__header">
          <h2 class="card__title">{{ $equip->nom }}</h2>
          <span class="card__badge">{{ __('ID') }}: {{ $equip->id }}</span>
        </header>

        <div class="card__body">
          <p><strong>{{ __('Ciutat') }}:</strong> {{ $equip->ciutat ?? '—' }}</p>
          <p><strong>{{ __('Estadi') }}:</strong> {{ $equip->estadi->nom ?? '—' }}</p>
        </div>

        <footer class="card__footer">
          <a class="btn btn--ghost" href="{{ route('equips.show', $equip) }}">{{ __('Veure') }}</a>
          <a class="btn btn--primary" href="{{ route('equips.edit', $equip) }}">{{ __('Editar') }}</a>

          <form method="POST"
                action="{{ route('equips.destroy', $equip) }}"
                class="inline"
                onsubmit="return confirm('{{ __('Segur que vols eliminar aquest equip?') }}');">
            @csrf
            @method('DELETE')
            <button class="btn btn--danger" type="submit">{{ __('Eliminar') }}</button>
          </form>
        </footer>
      </article>
    @endforeach
  </div>
</div>
@endsection