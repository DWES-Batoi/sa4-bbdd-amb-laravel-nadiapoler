@extends('layouts.app')
@extends('layouts.equip')

@section('title', "Detall d'Equip")

@section('content')
    <x-equip :equip="$equip" />
@endsection

  <x-equip
    :nom="$equip->nom"
    :estadi="$equip->estadi->nom"
    :titols="$equip->titols"
  />

  {{-- Millores d’equip --}}
  <div class="mt-6 border rounded-lg shadow-md p-4 bg-gray-50">
    <h3 class="text-lg font-bold mb-2">Millores d’equip</h3>

    <p><strong>Edat mitjana de les jugadores:</strong> 
      {{ $edatMitjana ? number_format($edatMitjana, 1) . ' anys' : 'Sense dades' }}
    </p>

    <h4 class="font-semibold mt-4 mb-2">Últims 5 partits jugats:</h4>
    @if($ultimsPartits->isNotEmpty())
      <ul class="list-disc pl-5">
        @foreach($ultimsPartits as $partit)
          <li>
            {{ $partit->local?->nom ?? 'Equip desconegut' }} 
            vs {{ $partit->visitant?->nom ?? 'Equip desconegut' }} 
            ({{ $partit->data?->format('d/m/Y') ?? 'Sense data' }})
            - Resultat: {{ $partit->gols_local }} - {{ $partit->gols_visitant }}
          </li>
        @endforeach
      </ul>
    @else
      <p>No hi ha partits registrats.</p>
    @endif
  </div>

