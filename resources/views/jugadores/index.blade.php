@extends('layouts.equip')

@section('title', __("Guia de Jugadores"))

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6 jugadores-index">{{ __('Guia de Jugadores') }}</h1>

@if (session('success'))
<div class="bg-green-100 text-green-700 p-2 mb-4">{{ session('success') }}</div>
@endif

<p class="mb-4">
  <a href="{{ route('jugadores.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">
    {{ __('Nova Jugadora') }}
  </a>
</p>

<table class="w-full border-collapse border border-gray-300">
  <thead class="bg-gray-200">
    <tr>
      <th class="border border-gray-300 p-2">{{ __('Equip') }}</th>
      <th class="border border-gray-300 p-2">{{ __('Data Naixement') }}</th>
      <th class="border border-gray-300 p-2">{{ __('Dorsal') }}</th>
      <th class="border border-gray-300 p-2">{{ __('Foto') }}</th>
    </tr>
  </thead>
  <tbody>
    @foreach($jugadores as $jugadora)
    <tr class="hover:bg-gray-100">
      <td class="border border-gray-300 px-2 py-1">
        <a href="{{ $jugadora->equip ? route('jugadores.show', $jugadora->id) : '#' }}"
          class="text-blue-700 hover:underline">
          {{ $jugadora->equip ? $jugadora->equip->nom : __('Sense equip') }}
        </a>
      </td>

      <td class="border border-gray-300 px-2 py-1">
        {{ $jugadora->data_naixement
        ? \Carbon\Carbon::parse($jugadora->data_naixement)->format('d/m/Y')
        : __('No disponible') }}
      </td>

      <td class="border border-gray-300 px-2 py-1 text-center">
        {{ $jugadora->dorsal }}
      </td>

      <td class="border border-gray-300 px-2 py-1">
        @if($jugadora->foto)
        <img src="{{ asset('storage/' . $jugadora->foto) }}"
          class="w-10 h-10 object-cover rounded">
        @else
        {{ __('No disponible') }}
        @endif
      </td>
    </tr>


    @endforeach
  </tbody>
</table>
@endsection