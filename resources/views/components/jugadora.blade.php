@props(['nom', 'equip', 'data_naixement', 'dorsal', 'foto'])

<div class="jugadora border rounded-lg shadow-md p-4 bg-white jugadoras-estilos">
    <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>
    <p><strong>{{ __('Equip') }}:</strong> {{ $equip ?? __('Sense equip') }}</p>
    <p><strong>{{ __('Data Naixement') }}:</strong> {{ $data_naixement ?? __('No disponible') }}</p>
    <p><strong>{{ __('Dorsal') }}:</strong> {{ $dorsal ?? '—' }}</p>

    @if($foto)
        <img src="{{ asset('storage/' . $foto) }}" alt="{{ __('Foto') }}" class="w-16 h-16 object-cover rounded">
    @else
        <p>{{ __('No disponible') }}</p>
    @endif
</div>
