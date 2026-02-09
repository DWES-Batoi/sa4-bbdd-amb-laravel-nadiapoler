@extends('layouts.app')
@extends('layouts.equip')

@section('title', __("Detall de Jugadora"))

@section('content')
<x-jugadora
    :nom="$jugadora->equip?->nom ?? __('Sense equip')"
    :equip="$jugadora->equip?->nom ?? __('Sense equip')"
    :data_naixement="$jugadora->data_naixement"
    :dorsal="$jugadora->dorsal"
    :foto="$jugadora->foto" />

@endsection
