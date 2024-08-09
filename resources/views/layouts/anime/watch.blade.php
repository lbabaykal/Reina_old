@extends('index')
@section('title', $anime->title_ru . ' - ' . config('app.name'))
@section('content')

    @include('layouts.anime.modals.rate')
    @include('layouts.anime.modals.folders')

    <section class="margin-content">
        <div class="w-full min-h-20 bg-gray-200 text-black flex items-center justify-center">
            <div class="min-w-[1400] w-[1400] flex items-center justify-between ps-2.5 pe-2">
                <div class="w-96 flex flex-col flex-auto">
                    <div class="text-2xl truncate">
                        <a href="{{ route('anime.show', $anime) }}" class="hover:text-love duration-200 transition-all">
                            {{ $anime->title_ru }}
                        </a>
                    </div>

                    <div class="flex items-baseline text-md select-none">

                        <span class="me-2 font-bold">
                            {{ $anime->type->title_ru }}
                        </span>

                        @if($anime->genres->isNotEmpty())
                            <span class="flex flex-row">
                                    @foreach($anime->genres as $genre)
                                        <a href="{{ route('search', ['genre[]' => $genre->id]) }}"
                                           class="underline decoration-1 underline-offset-4 hover:decoration-red-500 hover:text-red-500 tracking-wide mx-1"
                                        >{{ $genre->title_ru }}</a>
                                        @if($loop->last === false)
                                            <span class="text-red-500 text-xl">•</span>
                                        @endif
                                    @endforeach
                            </span>
                        @endif

                        <span class="text-lg text-love font-bold mx-2">
                            {{ $anime->age_rating }}
                        </span>

                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" stroke="currentColor"
                             class="w-4 h-4 mx-1 stroke-amber-400 fill-amber-400 inline-block">
                            <path d="M9.15316 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z"/>
                        </svg>

                        {{ $anime->rating }}

                        <span class="text-sm text-gray-500 ms-1">
                            / {{ $anime->count_assessments }}
                        </span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="mx-2">
                        <button
                            data-popover-target="rate-popover-hover"
                            data-popover-trigger="hover"
                            data-modal-target="anime-rate-modal"
                            data-modal-toggle="anime-rate-modal"
                            type="button"
                            class="group flex items-center py-1.5 px-3 rounded-lg border border-amber-400"
                        >
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" stroke="currentColor"
                                 class="w-6 h-6 stroke-amber-400 group-hover:fill-amber-400
                                 @isset($ratingUser) fill-amber-400 @endisset
                            ">
                                <path d="M9.15316 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z"/>
                            </svg>
                            <span class="ms-2 text-black max-w-48 truncate">
                                @if($ratingUser)
                                    Ваша оценка - {{ $ratingUser }}
                                @else
                                    {{ __('Оценить') }}
                                @endif
                            </span>
                        </button>
                    </div>
                    <div class="mx-2">
                        <button
                            data-popover-target="folders-popover-hover"
                            data-popover-trigger="hover"
                            data-modal-target="anime-folders-modal"
                            data-modal-toggle="anime-folders-modal"
                            type="button"
                            class="group flex items-center py-1.5 px-3 rounded-lg border border-red-500"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                 class="w-6 h-6 stroke-red-500 group-hover:fill-red-500
                                @isset($favoriteUser ) fill-red-500 @endisset
                            ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                            </svg>
                            <span class="ms-2 text-black max-w-40 truncate text-nowrap">
                                @if($favoriteUser)
                                    {{ $foldersUser->where('id', $favoriteUser)->value('title') }}
                                @else
                                    {{ __('В избранное') }}
                                @endif
                            </span>
                        </button>
                    </div>
                    @if($anime->episodes_total !== 1)
                        <div class="mx-2">
                            <button id="EpisodesButton"
                                    data-collapse-toggle="EpisodesDropdown"
                                    class="flex items-center py-1.5 px-5 rounded-lg border border-gray-500 whitespace-nowrap"
                                    type="button">
                                {{ __('Эпизодов') .' '. $anime->episodes_released .'/'. $anime->episodes_total }}
                                <svg class="w-3 h-3 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <div class="w-full flex mt-2.5">
            <div class="flex mx-auto">
                <div class="w-HD aspect-[16/9] bg-violet-600 rounded-lg overflow-hidden">
                    <video class="w-full aspect-[16/9]" controls>
                        <source src="{{ asset('Violet_Evergarden.mp4') }}" type="video/mp4">
                        Ваш браузер не поддерживает видео в формате HTML5.
                    </video>
{{--                        <iframe class="w-full aspect-[16/9]" src="https://www.youtube.com/embed/PvyaVqfylu4" allowfullscreen></iframe>--}}
                </div>

                <div id="EpisodesDropdown"
                     class="w-96 aspect-[9/16] z-10 hidden text-white rounded-md overflow-hidden bg-blackBack/70 backdrop-blur py-1.5 ml-5 border border-blackActive select-none"
                >
                    @if($episodes->isNotEmpty())
                        <div class="max-h-full pl-2.5 pr-1.5 rounded-md overflow-hidden overflow-y-scroll text-base">
                            @foreach($episodes as $episode)
                                <a href="#" class="block p-3 truncate cursor-pointer bg-blackSimple rounded-md hover:bg-gray-100 hover:text-black my-1.5

                                ">
                                    {{ $episode->number }}. {{ $episode->title_ru }}
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="w-full h-full text-love text-2xl flex justify-center items-center">
                            {{ __('Пусто') }}
                        </div>
                    @endif
                        {{--                                @if(request()->is('anime/*/watch'))--}}
                        {{--                                    bg-blackActive text-white--}}
                        {{--                                @else--}}
                        {{--                                    bg-blackSimple--}}
                        {{--                                @endif--}}
                </div>
            </div>
        </div>
    </section>
@endsection
