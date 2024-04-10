@extends('index')
@section('title', config('app.name') . ' - Дорамы')
@section('content')
    <section class="margin-content">
        <div class="w-full mt-2 px-2.5 grid gap-3 place-items-center grid-flow-row grid-cols-8">
            @each('layouts.dorama.card', $dorams, 'dorama')
        </div>

        {{ $dorams->links() }}
    </section>
@endsection
