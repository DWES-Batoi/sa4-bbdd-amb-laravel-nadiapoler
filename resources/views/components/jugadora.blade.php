@props([
    'equip',
    'data_naixement',
    'dorsal',
    'foto' => null,
])

<div class="jugadora border rounded-lg shadow-md p-4 bg-white">
  <h2 class="text-xl font-bold text-blue-800">{{ $equip }}</h2>

  <p><strong>Data Naixement:</strong> {{ $data_naixement->format('d/m/Y') }}</p>
  <p><strong>Dorsal:</strong> {{ $dorsal }}</p>

  <p>
    <strong>Foto:</strong><br>
    @if($foto)
      <img src="{{ asset('storage/' . $foto) }}" alt="Foto" class="w-24 h-24 object-cover rounded">
    @else
      No disponible
    @endif
  </p>
</div>
