@extends('layouts.equip')

@section('title', __("Detall d'Estadi"))

@section('content')
<h3>Descripció (IA local)</h3>

@if(!empty($descripcio))
  <p>{{ $descripcio }}</p>
@else
  <p><em>No s’ha pogut generar la descripció ara mateix.</em></p>
@endif

<div class="show">

  <x-estadi
    :nom="$estadi->nom"
    :capacitat="$estadi->capacitat"
    :equips="$estadi->equips" />
</div>
@endsection
