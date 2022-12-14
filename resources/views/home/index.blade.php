@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-4 mb-2">
            <img src="{{ asset('/img/game.png') }}" alt="image" class="img-fluid rounder">
        </div>
        <div class="col-md-6 col-lg-4 mb-2">
            <img src="{{ asset('/img/safe.png') }}" alt="image" class="img-fluid rounder">
        </div>
        <div class="col-md-6 col-lg-4 mb-2">
            <img src="{{ asset('/img/submarine.png') }}" alt="image" class="img-fluid rounder">
        </div>
    </div>
@endsection