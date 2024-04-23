@extends('index')
@section('title', config('app.name') . ' - Избранное ' . auth()->user()->name)
@section('content')
    <section class="margin-content">
        <div class="w-full font-bold select-none my-2 text-center ">
            <a href="{{ route('folders.animes.index') }}"
               class="group">
                <span class="text-4xl py-1 group-hover:text-red-500 duration-300"
                >
                    АНИМЕ
                </span>
                <span class="text-red-500 text-2xl">
                    Все ❯
                </span>
            </a>
        </div>

        <div class="w-full mt-2 px-2.5 grid gap-3 place-items-center grid-flow-row grid-cols-8">
            @each('layouts.anime.card', $foldersAnimes, 'anime')
        </div>

        <div class="w-full font-bold select-none my-2 text-center ">
            <a href="{{ route('folders.doramas.index') }}"
               class="group">
                <span class="text-4xl py-1 group-hover:text-violet-500 duration-300"
                >
                    ДОРАМЫ
                </span>
                    <span class="text-violet-500 text-2xl">
                    Все ❯
                </span>
            </a>
        </div>

        <div class="w-full mt-2 px-2.5 grid gap-3 place-items-center grid-flow-row grid-cols-8">
            @each('layouts.dorama.card', $foldersDoramas, 'dorama')
        </div>

    </section>
@endsection


