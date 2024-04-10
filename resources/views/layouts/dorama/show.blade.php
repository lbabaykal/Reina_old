@extends('index')
@section('title', config('app.name') . ' - ' . $dorama->title_ru)
@section('content')

    @dump($dorama->title_ru)
    <section class="w-full bg-red-400">
        <h1>
            {{ $dorama->title_ru }}
        </h1>

    </section>

@endsection


