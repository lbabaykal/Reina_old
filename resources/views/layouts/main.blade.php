@extends('index')
@section('title', config('app.name') . ' - Главная')
@section('content')
    <section class="margin-content">
        <div class="py-2 select-none flex flex-row items-center justify-center">
            <a href="{{ route('anime.index') }}" class="font-bold group flex flex-row items-center justify-center">
                <span class="text-red-500 text-3xl">❮</span>
                <span class="group-hover:text-red-500 text-4xl px-3 duration-300">АНИМЕ</span>
                <span class="text-red-500 text-3xl">❯</span>
            </a>
        </div>

        <div class="w-full px-2.5 grid gap-3 place-items-center grid-flow-row grid-cols-8">
            @each('layouts.anime.card', $animes, 'anime')
        </div>

        <div class="py-2 select-none flex flex-row items-center justify-center">
            <a href="{{ route('dorama.index') }}" class="font-bold group flex flex-row items-center justify-center">
                <span class="text-violet-500 text-3xl">❮</span>
                <span class="group-hover:text-violet-500 text-4xl px-3 duration-300">ДОРАМЫ</span>
                <span class="text-violet-500 text-3xl">❯</span>
            </a>
        </div>

        <div class="w-full px-2.5 grid gap-3 place-items-center grid-flow-row grid-cols-8">
            @each('layouts.dorama.card', $doramas, 'dorama')
        </div>
    </section>
@endsection


