@extends('layouts.equip')

@section('title', __('Editar jugadora'))

@section('content')

<form action="{{ route('jugadores.update', $jugadora) }}" method="POST" enctype="multipart/form-data" class="space-y-4 jugadores-edit">
        @csrf
        @method('PUT')


        {{-- SIN @csrf porque te causa 419 --}}
        {{-- SIN @method porque tu plantilla no soporta PUT --}}

        <div>
            <label class="block text-sm font-medium">{{ __('Nom') }}</label>
            <input type="text"
                name="nom"
                value="{{ old('nom', $jugadora->nom) }}"
                class="w-full border rounded p-2">
            @error('nom')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">{{ __('Equip') }}</label>
            <select name="equip_id" class="w-full border rounded p-2">
                @foreach($equips as $equip)
                <option value="{{ $equip->id }}"
                    @selected(old('equip_id', $jugadora->equip_id) == $equip->id)>
                    {{ $equip->nom }}
                </option>
                @endforeach
            </select>
            @error('equip_id')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">{{ __('Data Naixement') }}</label>
            <input type="date"
                name="data_naixement"
                value="{{ old('data_naixement', $jugadora->data_naixement) }}"
                class="w-full border rounded p-2">
            @error('data_naixement')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">{{ __('Dorsal') }}</label>
            <input type="number"
                name="dorsal"
                value="{{ old('dorsal', $jugadora->dorsal) }}"
                class="w-full border rounded p-2">
            @error('dorsal')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        @if($jugadora->foto)
        <div class="flex items-center gap-3">
            <img src="{{ asset('storage/' . $jugadora->foto) }}"
                class="h-12 w-12 object-cover rounded-full"
                alt="Foto">
            <p class="text-sm text-gray-600">{{ __('Foto actual') }}</p>
        </div>
        @endif

        <div>
            <label class="block text-sm font-medium">{{ __('Nova foto (opcional)') }}</label>
            <input type="file" name="foto" class="w-full border rounded p-2">
            @error('foto')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            {{ __('Desar') }}
        </button>
    </form>
    @endsection