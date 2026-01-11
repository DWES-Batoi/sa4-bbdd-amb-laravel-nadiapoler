@props([
    'local',
    'visitant',
    'data',
    'gols_local',
    'gols_visitant'
])

<div class="partit border rounded-lg shadow-md p-4 bg-white">
  <h2 class="text-xl font-bold text-blue-800">{{ $local }} vs {{ $visitant }}</h2>
  <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($data)->format('d/m/Y') }}</p>
  <p><strong>Resultat:</strong> {{ $gols_local }} - {{ $gols_visitant }}</p>
</div>
