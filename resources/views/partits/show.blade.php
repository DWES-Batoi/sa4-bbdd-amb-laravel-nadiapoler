@extends('layouts.app')
@extends('layouts.equip')
@section('title', "Detall del Partit")

@section('content')
  <x-partit
    :local="$partit->local->nom"
    :visitant="$partit->visitant->nom"
    :data="$partit->data"
    :gols_local="$partit->gols_local"
    :gols_visitant="$partit->gols_visitant"
  />
@endsection
