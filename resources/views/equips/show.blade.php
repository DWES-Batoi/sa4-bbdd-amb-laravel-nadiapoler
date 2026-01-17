@extends('layouts.app')
@extends('layouts.equip')

@section('title', __("Detall d'Equip"))

@section('content')
    <x-equip :equip="$equip" />

  {{-- Millores d’equip --}}
  <div class="mt-6 border rounded-lg shadow-md p-4 bg-gray-50 equipos-show">
    <h3 class="text-lg font-bold mb-2">{{ __('Millores d’equip') }}</h3>

    <p><strong>{{ __('Edat mitjana de les jugadores:') }}</strong> 
      {{ $edatMitjana ? number_format($edatMitjana, 1) . ' anys' : 'Sense dades' }}
    </p>

    <h4 class="font-semibold mt-4 mb-2">{{ __('Últims 5 partits jugats:') }}</h4>
    @if($ultimsPartits->isNotEmpty())
      <ul class="list-disc pl-5">
        @foreach($ultimsPartits as $partit)
          <li>
            {{ $partit->local?->nom ?? __('Equip desconegut') }} 
            vs {{ $partit->visitant?->nom ?? __('Equip desconegut') }} 
            ({{ $partit->data?->format('d/m/Y') ?? __('Sense data') }})
            - {{ __('Resultat') }}: {{ $partit->gols_local }} - {{ $partit->gols_visitant }}
          </li>
        @endforeach
      </ul>
    @else
      <p>{{ __('No hi ha partits registrats.') }}</p>
    @endif
  </div>

@endsection
