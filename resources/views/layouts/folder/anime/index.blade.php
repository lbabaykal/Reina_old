@extends('index')
@section('title', 'Избранное '. auth()->user()->name .' - '. config('app.name'))
@section('content')

    @include('layouts.folder.anime.modals.create')

    <section class="margin-content">
        @if ($message = session('message'))
            <div class="w-full text-center text-lime-500">{{ $message }}</div>
        @endif
        <div class="flex flex-row w-full">
            <div class="w-15% mt-2.5 mx-2 select-none">
                <div class="sticky top-[70] bg-blackSimple shadow-[0_9px_6px_-3px_rgb(255,0,0)]">
                    <div class="w-full h-[40] flex flex-row group
                        @if(request()->is('user/folders/animes')) bg-blackActive @endif
                    ">
                        <a href="{{ route('user.folders.animes.index') }}"
                           class="w-full h-full text-xl flex items-center justify-between truncate
                                      group-hover:bg-gray-100 group-hover:text-black">
                                <span class="px-3 truncate">
                                    {{ __('Все') }}
                                </span>
                                <span class="px-2">
                                    {{ auth()->user()->favoriteAnimes()->count() }}
                                </span>
                        </a>
                        <button data-modal-target="anime-folder-create-modal"
                                data-modal-toggle="anime-folder-create-modal"
                                type="button"
                                class="w-[40] h-full flex items-center justify-center text-black bg-orange-400
                                    hover:text-white hover:bg-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                            </svg>
                        </button>
                    </div>
                    @foreach($folders as $folder)
                        <div class="w-full h-[40] flex flex-row items-center group
                        @if(request()->is('user/folders/animes/' . $folder->id)) bg-blackActive @endif
                        ">
                            <a href="{{ route('user.folders.animes.show', $folder) }}"
                               class="w-full h-full text-xl flex items-center justify-between truncate
                                      group-hover:bg-gray-100 group-hover:text-black">
                                <span class="px-3 truncate">
                                    {{ $folder->title }}
                                </span>
                                <span class="px-2">
                                    {{ $folder->favorites_animes_user_count }}
                                </span>
                            </a>
                            @if($folder->user_id == auth()->id())
                                <a href="{{ route('user.folders.animes.edit', $folder->id) }}"
                                   class="w-[40] h-full flex items-center justify-center text-black bg-white invisible
                                        group-hover:text-white group-hover:bg-sky-500 group-hover:visible">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="w-85% mt-2 px-2.5 grid gap-2 grid-flow-row grid-cols-7">
                @each('layouts.anime.card', $animes, 'anime')
            </div>
        </div>
            {{ $animes->links() }}
    </section>
@endsection
