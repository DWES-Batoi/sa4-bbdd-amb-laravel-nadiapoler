<!--@extends('layouts.app')-->
@extends('layouts.equip')
@section('title', 'Afegir nou partit')

@section('content')
<h1 class="text-2xl font-bold mb-4">Afegir nou partit</h1>

@if ($errors->any())
  <div class="bg-red-100 text-red-700 p-2 mb-4">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('partits.store') }}" method="POST" class="space-y-4">
  @csrf

  <div>
    <label for="local_id" class="block font-bold">Equip local:</label>
    <select name="local_id" id="local_id" class="border p-2 w-full">
      @foreach ($equips as $equip)
        <option value="{{ $equip->id }}" {{ old('local_id') == $equip->id ? 'selected' : '' }}>
          {{ $equip->nom }}
        </option>
      @endforeach
    </select>
  </div>

  <div>
    <label for="visitant_id" class="block font-bold">Equip visitant:</label>
    <select name="visitant_id" id="visitant_id" class="border p-2 w-full">
      @foreach ($equips as $equip)
        <option value="{{ $equip->id }}" {{ old('visitant_id') == $equip->id ? 'selected' : '' }}>
          {{ $equip->nom }}
        </option>
      @endforeach
    </select>
  </div>

  <div>
    <label for="data" class="block font-bold">Data:</label>
    <input type="date" name="data" id="data" value="{{ old('data') }}" class="border p-2 w-full">
  </div>

  <div>
    <label for="gols_local" class="block font-bold">Gols local:</label>
    <input type="number" name="gols_local" id="gols_local" value="{{ old('gols_local') }}" class="border p-2 w-full">
  </div>

  <div>
    <label for="gols_visitant" class="block font-bold">Gols visitant:</label>
    <input type="number" name="gols_visitant" id="gols_visitant" value="{{ old('gols_visitant') }}" class="border p-2 w-full">
  </div>

  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
    Afegir
  </button>
</form>
@endsection
