@extends('index')
@section('title', config('app.name') . ' - Аниме')
@section('content')
    <section class="margin-content">
        <div class="w-full mt-2 px-2.5 grid gap-3 place-items-center grid-flow-row grid-cols-8">
            @each('layouts.anime.card', $animes, 'anime')
        </div>

        {{ $animes->links() }}
    </section>
@endsection
