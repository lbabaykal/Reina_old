@extends('index')
@section('title', config('app.name') . ' - Поиск')
@section('content')
    <section class="margin-content">

        @include('layouts.search.menu')

        @if($animes->isNotEmpty())
            <div class="py-1 my-2 select-none flex flex-row items-center justify-center">
                <a href="{{ route('anime.index', request()->query()) }}" class="font-bold group flex flex-row items-center justify-center text-3xl">
                    <span class="text-red-500">❮</span>
                    <span class="px-3 group-hover:text-red-500 duration-300">НАЙДЕНО</span>
                    <span class="text-red-500 text-4xl">{{ $animes->total() }}</span>
                    <span class="px-3 group-hover:text-red-500 duration-300">АНИМЕ</span>
                    <span class="text-red-500">❯</span>
                </a>
            </div>

            <div class="w-full mt-2 px-2.5 grid gap-3 place-items-center grid-flow-row grid-cols-8">
                @each('layouts.anime.card', $animes, 'anime')
            </div>
        @endif

        @if($doramas->isNotEmpty())
            <div class="py-1 my-2 select-none flex flex-row items-center justify-center">
                <a href="{{ route('dorama.index', request()->query()) }}" class="font-bold group flex flex-row items-center justify-center text-3xl">
                    <span class="text-violet-500">❮</span>
                    <span class="px-3 group-hover:text-violet-500 duration-300">НАЙДЕНО</span>
                    <span class="text-violet-500 text-4xl">{{ $doramas->total() }}</span>
                    <span class="px-3 group-hover:text-violet-500 duration-300">ДОРАМА</span>
                    <span class="text-violet-500">❯</span>
                </a>
            </div>

            <div class="w-full mt-2 px-2.5 grid gap-3 place-items-center grid-flow-row grid-cols-8">
                @each('layouts.dorama.card', $doramas, 'dorama')
            </div>
        @endif

    </section>
@endsection


