@extends('layouts.equip')

@section('title', __('Jugadores'))

@section('content')
<div class="container">
    <h1 class="title equips-index">{{ __('Guia de Jugadores') }}</h1>

    <p class="mb-4">
        <a href="{{ route('jugadores.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">
            {{ __('Nova Jugadora') }}
        </a>
    </p>

    <div class="grid-cards">
        @foreach ($jugadores as $jugadora)
            <article class="card">
                <header class="card__header">
                
                    <span class="card__badge">ID: {{ $jugadora->id }}</span>
                </header>

                <div class="card__body">
                    <p>
                        <strong>{{ __('Equip') }}:</strong>
                        {{ $jugadora->equip->nom ?? __('Sense equip') }}
                    </p>

                    <p>
                        <strong>{{ __('Data Naixement') }}:</strong>
                        {{ $jugadora->data_naixement
                            ? \Carbon\Carbon::parse($jugadora->data_naixement)->format('d/m/Y')
                            : __('No disponible') }}
                    </p>

                    <p>
                        <strong>{{ __('Dorsal') }}:</strong>
                        {{ $jugadora->dorsal ?? '—' }}
                    </p>

                    <p>
                        <strong>{{ __('Foto') }}:</strong><br>
                        @if($jugadora->foto)
                            <img src="{{ asset('storage/' . $jugadora->foto) }}"
                                 class="w-16 h-16 object-cover rounded-full mt-2">
                        @else
                            {{ __('No disponible') }}
                        @endif
                    </p>
                </div>

                <footer class="card__footer">
                    <a class="btn btn--ghost" href="{{ route('jugadores.show', $jugadora) }}">
                        {{ __('Veure') }}
                    </a>

                    <a class="btn btn--primary" href="{{ route('jugadores.edit', $jugadora) }}">
                        {{ __('Editar') }}
                    </a>

                    <form method="POST"
                          action="{{ route('jugadores.destroy', $jugadora) }}"
                          class="inline"
                          onsubmit="return confirm('{{ __('Segur que vols eliminar aquesta jugadora?') }}');">
                        <button class="btn btn--danger" type="submit">
                            {{ __('Eliminar') }}
                        </button>
                    </form>
                </footer>
            </article>
        @endforeach
    </div>
</div>
@endsection
