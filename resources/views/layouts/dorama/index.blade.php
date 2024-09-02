@extends('index')
@section('title', config('app.name') . ' - Дорамы')
@section('content')
    <section class="margin-content">

        @include('layouts.search.menu')

        @if($doramas->isNotEmpty())
            <div class="w-full mt-2 px-2.5 grid gap-3 place-items-center grid-flow-row grid-cols-8">
                @each('layouts.dorama.card', $doramas, 'dorama')
            </div>
        @endif

        {{ $doramas->links() }}

    </section>
@endsection
