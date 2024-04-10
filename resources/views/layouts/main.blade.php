@extends('index')
@section('title', config('app.name') . ' - Главная')
@section('content')
    <section class="margin-content">
        <div class="w-full py-1 text-4xl text-center font-bold select-none my-2">
            <a href="{{ route('anime.index') }}">АНИМЕ</a>
        </div>

        <div class="w-full mt-2 px-2.5 grid gap-3 place-items-center grid-flow-row grid-cols-8">
            @each('layouts.anime.card', $animes, 'anime')
        </div>

        <div class="w-full py-1 text-4xl text-center font-bold select-none my-2">
            <a href="{{ route('dorama.index') }}">ДОРАМЫ</a>
        </div>

        <div class="w-full mt-2 px-2.5 grid gap-3 place-items-center grid-flow-row grid-cols-8">
            @each('layouts.dorama.card', $dorams, 'dorama')
        </div>
    </section>
@endsection


