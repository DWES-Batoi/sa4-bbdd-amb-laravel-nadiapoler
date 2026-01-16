@props(['nom', 'equip', 'data_naixement', 'dorsal', 'foto'])

<div class="jugadora border rounded-lg shadow-md p-4 bg-white jugadoras-estilos">
    <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>
    <p><strong>Equip:</strong> {{ $equip ?? 'Sense equip' }}</p>
    <p><strong>Data Naixement:</strong> {{ $data_naixement ?? 'No disponible' }}</p>
    <p><strong>Dorsal:</strong> {{ $dorsal ?? '—' }}</p>
    @if($foto)
        <img src="{{ asset('storage/' . $foto) }}" alt="Foto" class="w-16 h-16 object-cover rounded">
    @else
        <p>No disponible</p>
    @endif
</div>
