@props([
    'nom',
    'capacitat',
    'equips' => collect(),
])

<div class="estadi border rounded-lg shadow-md p-4 bg-white estadios-estilos">
  <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>

  <p><strong>{{ __('Capacitat') }}:</strong> {{ $capacitat }}</p>

  <p>
    <strong>{{ __('Equips') }}:</strong>
    {{ $equips->count() }}
  </p>
</div>