@extends('index')
@section('title', $anime->title_ru . ' - ' . config('app.name'))
@section('content')

    @include('layouts.anime.modals.rate')
    @include('layouts.anime.modals.folders')

    <section class="">
        <div class="relative w-full aspect-[16/7] flex flex-row select-none">
            <div class="absolute bottom-24 left-24 min-w-[500] max-w-[8000] flex flex-col justify-end justify-items-stretch items-center z-10 bg-black/60 backdrop-blur rounded py-2.5 px-5">

                <div class="w-full text-3xl font-bold text-center my-1">
                    {{ $anime->title_ru }}
                </div>

                <div class="w-full flex flex-row items-center justify-center my-1 text-gray-300 text-lg divide-x divide-gray-500">
                    <span class="px-2 py-0.5 text-lime-400 font-bold text-xl">{{ $anime->rating }}</span>
                    @if($anime->episodes_total > 1)
                        <span class="px-2">
                            {{ $anime->episodes_released }} / {{ $anime->episodes_total }}
                        </span>
                    @endif
                    <span class="px-2">
                        {{ \Carbon\CarbonInterval::minutes($anime->duration)->cascade()->forHumans(['short' => true]) }}
                    </span>
                    <a href="{{ route('anime.index', ['year_from' => \Illuminate\Support\Carbon::parse($anime->release)->format('Y')]) }}"
                       class="px-2 underline decoration-1 underline-offset-4 hover:decoration-love hover:text-love tracking-wide"
                    >
                        {{ \Illuminate\Support\Carbon::parse($anime->release)->format('Y') }}
                    </a>
                    <span class="px-2 text-love text-xl font-bold">{{ $anime->age_rating }}</span>
                </div>

                <div class="w-full my-1 text-gray-300 flex flex-row justify-center items-center content-center">
                     @foreach($anime->genres as $genre)
                         <div class="text-nowrap mx-0.5">
                             <a href="{{ route('anime.index', ['genre[]' => $genre->id]) }}"
                                class="underline decoration-1 underline-offset-4 hover:decoration-love hover:text-love tracking-wide"
                             >{{ $genre->title_ru }}</a>
                             @if($loop->last === false)
                                 <span class="text-red-500 text-xs">&#9679;</span>
                             @endif
                         </div>
                     @endforeach
                </div>

                <div class="w-full flex flex-row justify-center items-center content-center my-2">
                    <a href="{{ route('anime.watch', $anime) }}" class="relative group p-0.5 mx-1">
                        <div class="absolute inset-0 group-hover:bg-gradient-to-r from-orange-500 via-red-500 to-violet-600 rounded-lg blur-md"></div>
                        <div class="px-12 py-3 rounded relative transition duration-300 flex flex-row justify-center items-center text-white font-bold bg-gradient-to-r from-orange-500 via-red-500 to-violet-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 inline-block"><path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" /></svg>
                            &nbsp;Смотреть онлайн
                        </div>
                    </a>

                    <div data-popover
                         id="rate-popover-hover"
                         role="tooltip"
                         class="absolute z-10 invisible inline-block text-amber-400 bg-black border border-gray-500 transition-opacity duration-300 rounded shadow-sm opacity-0">
                        <div class="px-4 py-2">
                            Оценить
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                    <button
                        data-popover-target="rate-popover-hover"
                        data-popover-trigger="hover"
                        data-modal-target="anime-rate-modal"
                        data-modal-toggle="anime-rate-modal"
                        type="button"
                        class="group block bg-gray-600/80 hover:bg-gray-500 p-2.5 rounded mx-1"
                    >
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" stroke="currentColor"
                             class="w-7 h-7 stroke-amber-400 group-hover:fill-amber-400
                            @isset($ratingUser) fill-amber-400 @endisset
                            ">
                            <path d="M9.15316 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z"/>
                        </svg>
                    </button>


                    <div data-popover
                         id="folders-popover-hover"
                         role="tooltip"
                         class="absolute z-10 invisible inline-block text-red-500 bg-black border border-gray-500 transition-opacity duration-300 rounded shadow-sm opacity-0">
                        <div class="px-4 py-2">
                            Добавить в избранное
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                    <button
                        data-popover-target="folders-popover-hover"
                        data-popover-trigger="hover"
                        data-modal-target="anime-folders-modal"
                        data-modal-toggle="anime-folders-modal"
                        type="button"
                        class="group block bg-gray-600/80 hover:bg-gray-500 p-2.5 rounded mx-1"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             class="w-7 h-7 stroke-red-500 group-hover:fill-red-500
                             @isset($favoriteUser ) fill-red-500 @endisset
                             ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="absolute top-0 left-0 w-full h-full bg-center bg-cover shadow-[0px_-80px_100px_25px_rgba(0,0,0,1)_inset]"
                 style="background-image: url('{{ $anime->cover ? Storage::disk('anime_covers')->url($anime->cover) : asset('assets/cover.jpg') }}')">
            </div>
        </div>

        @include('layouts.anime.description')

    </section>
@endsection
