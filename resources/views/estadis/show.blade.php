@extends('layouts.equip')

@section('title', __("Detall d'Estadi"))

@section('content')
<div class="show">

  <x-estadi
    :nom="$estadi->nom"
    :capacitat="$estadi->capacitat"
    :equips="$estadi->equips" />
</div>
@endsection
