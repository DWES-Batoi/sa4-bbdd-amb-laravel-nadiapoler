@extends('layouts.app')
@extends('layouts.equip')
@section('title', "Detall de Jugadora")

@section('content')
<x-jugadora
    :nom="$jugadora->equip->nom"
    :equip="$jugadora->equip->nom"
    :data_naixement="$jugadora->data_naixement"
    :dorsal="$jugadora->dorsal"
    :foto="$jugadora->foto" />
@endsection