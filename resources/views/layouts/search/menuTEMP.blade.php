<div class="w-full">
    <div class="flex flex-col">
        <div class="w-full flex-row">

            <button form="search"
                    type="submit"
                    class=""
            >
                Поиск
            </button>

            <div>
                <button id="TypeSearchButton"
                        data-dropdown-toggle="TypeSearch"
                        class="inline-flex items-center justify-center w-[200] px-3 py-2 font-medium text-white bg-blue-700 rounded hover:bg-blue-800"
                        type="button">
                    {{ __('Тип') }}
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>

                <button id="CountrySearchButton"
                        data-dropdown-toggle="CountrySearch"
                        class="inline-flex items-center justify-center w-[200] px-3 py-2 font-medium text-white bg-blue-700 rounded hover:bg-blue-800"
                        type="button">
                    {{ __('Страна') }}
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>

                <button id="GenreSearchButton"
                        data-dropdown-toggle="GenreSearch"
                        class="inline-flex items-center justify-center w-[200] px-3 py-2 font-medium text-white bg-blue-700 rounded hover:bg-blue-800"
                        type="button">
                    {{ __('Жанр') }}
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>

                <button id="StudioSearchButton"
                        data-dropdown-toggle="StudioSearch"
                        class="inline-flex items-center justify-center w-[200] px-3 py-2 font-medium text-white bg-blue-700 rounded hover:bg-blue-800"
                        type="button">
                    {{ __('Студия') }}
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="">
            кнопка поиска сброса и текстовое поле
        </div>


    </div>





    <nav class="flex flex-row justify-between px-4 py-1 border-y border-blackActive">
        <button id="mega-menu-full-dropdown-button"
                data-collapse-toggle="mega-menu-full-dropdown"
                class="flex items-center justify-between w-[200] py-2 px-3 font-medium text-gray-900 border-b border-gray-100 bg-white hover:bg-gray-50"
        >
            {{ __('Сортировка') }}
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>

        <div class="">

            <button form="search"
                    type="submit"
                    class=""
            >
                Поиск
            </button>


            <button
                class="middle none center bg-gradient-to-tr from-pink-600 to-pink-400 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            >
                Поиск
            </button>
        </div>

        <button id="mega-menu-full-dropdown-button"
                data-collapse-toggle="mega-menu-full-dropdown"
                class="flex items-center justify-between w-[200] py-2 px-3 font-medium text-gray-900 border-b border-gray-100 bg-white hover:bg-gray-50"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>

            {{ __('Фильтры') }}
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>

    </nav>




    <div id="mega-menu-full-dropdown"
         class="bg-blackSimple border-blackActive shadow-sm border-y hidden pt-3"
    >
        <form id="search" method="GET" class="flex flex-row justify-center">

            <div class="bg-blackSimple text-white rounded-lg shadow w-60 overflow-hidden select-none mx-5">
                <div class="text-center font-bold">
                    {{ __('Тип') }}
                </div>
                <ul class="min-h-20 max-h-72 px-1 py-1 overflow-y-auto">
                    @foreach($types as $type)
                        <li>
                            <div class="flex items-center ps-2 rounded hover:bg-blackActive">
                                <input id="type_{{ $type->id }}"
                                       type="checkbox"
                                       name="type[]"
                                       value="{{ $type->id }}"
                                       @if(request()->exists('type'))
                                           @foreach(request('type') as $typeValue)
                                               @checked($type->id === (int) $typeValue)
                                           @endforeach
                                       @endif
                                       class="w-4 h-4 p-2 mx-1 text-love bg-gray-500 border-gray-500 rounded ring-0 focus:ring-0"
                                >
                                <label for="type_{{ $type->id }}"
                                       class="w-full py-2 ms-2 rounded truncate"
                                >
                                    {{ $type->title_ru }}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul >
            </div>

            <div class="bg-blackSimple text-white rounded-lg shadow w-60 overflow-hidden select-none mx-5">
                <div class="text-center font-bold">
                    {{ __('Страна') }}
                </div>
                <ul class="min-h-20 max-h-72 px-2 py-2 overflow-y-auto">
                    @foreach($countries as $country)
                        <li>
                            <div class="flex items-center ps-2 rounded hover:bg-blackActive">
                                <input id="country_{{ $country->id }}"
                                       type="checkbox"
                                       name="country[]"
                                       value="{{ $country->id }}"
                                       @if(request()->exists('country'))
                                           @foreach(request('country') as $countryValue)
                                               @checked($country->id === (int) $countryValue)
                                           @endforeach
                                       @endif
                                       class="w-4 h-4 p-2 mx-1 text-love bg-gray-500 border-gray-500 rounded ring-0 focus:ring-0"
                                >
                                <label for="country_{{ $country->id }}"
                                       class="w-full py-2 ms-2 rounded truncate"
                                >
                                    {{ $country->title_ru }}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-blackSimple text-white rounded-lg shadow w-60 overflow-hidden select-none mx-5">
                <div class="font-bold flex flex-row justify-center items-center">
                    {{ __('Жанр') }}
                    <label class="inline-flex items-center cursor-pointer ms-3">
                        <input type="checkbox"
                               name="strict_genre"
                               class="sr-only peer"
                            @checked(request()->exists('strict_genre'))
                        >
                        <span class="relative w-9 h-5 bg-red-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-400 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-lime-300"></span>
                    </label>
                </div>
                <ul class="min-h-20 max-h-72 px-2 py-2 overflow-y-auto">
                    @foreach($genres as $genre)
                        <li>
                            <div class="flex items-center ps-2 rounded hover:bg-blackActive">
                                <input id="genre_{{ $genre->id }}"
                                       type="checkbox"
                                       name="genre[]"
                                       value="{{ $genre->id }}"
                                       @if(request()->exists('genre'))
                                           @foreach(request('genre') as $genreValue)
                                               @checked($genre->id === (int) $genreValue)
                                           @endforeach
                                       @endif
                                       class="w-4 h-4 p-2 mx-1 text-love bg-gray-500 border-gray-500 rounded ring-0 focus:ring-0"
                                >
                                <label for="genre_{{ $genre->id }}"
                                       class="w-full py-2 ms-2 rounded truncate"
                                >
                                    {{ $genre->title_ru }}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-blackSimple text-white rounded-lg shadow w-60 overflow-hidden select-none mx-5">
                <div class="font-bold flex flex-row justify-center items-center">
                    {{ __('Студия') }}
                    <label class="inline-flex items-center cursor-pointer ms-3">
                        <input type="checkbox"
                               name="strict_studio"
                               class="sr-only peer"
                            @checked(request()->exists('strict_studio'))
                        >
                        <span class="relative w-9 h-5 bg-red-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-400 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-lime-300"></span>
                    </label>
                </div>
                <ul class="min-h-20 max-h-72  px-2 py-2 overflow-y-auto">
                    @foreach($studios as $studio)
                        <li>
                            <div class="flex items-center ps-2 rounded hover:bg-blackActive">
                                <input id="studio_{{ $studio->id }}"
                                       type="checkbox"
                                       name="studio[]"
                                       value="{{ $studio->id }}"
                                       @if(request()->exists('studio'))
                                           @foreach(request('studio') as $studioValue)
                                               @checked($studio->id === (int) $studioValue)
                                           @endforeach
                                       @endif
                                       class="w-4 h-4 p-2 mx-1 text-love bg-gray-500 border-gray-500 rounded ring-0 focus:ring-0"
                                >
                                <label for="studio_{{ $studio->id }}"
                                       class="w-full py-2 ms-2 rounded truncate"
                                >
                                    {{ $studio->title }}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </form>
    </div>






</div>













<form id="search" method="GET">

    <div id="TypeSearch"
         class="z-10 hidden bg-blackSimple text-white rounded-lg shadow w-60 overflow-hidden select-none"
    >
        <ul aria-labelledby="TypeSearchButton"
            class="min-h-20 max-h-72 px-2 py-2 overflow-y-auto"
        >
            @foreach($types as $type)
                <li>
                    <div class="flex items-center ps-2 rounded hover:bg-blackActive">
                        <input id="type_{{ $type->id }}"
                               type="checkbox"
                               name="type[]"
                               value="{{ $type->id }}"
                               @if(request()->exists('type'))
                                   @foreach(request('type') as $typeValue)
                                       @checked($type->id === (int) $typeValue)
                                   @endforeach
                               @endif
                               class="w-4 h-4 p-2 mx-1 text-love bg-gray-500 border-gray-500 rounded ring-0 focus:ring-0"
                        >
                        <label for="type_{{ $type->id }}"
                               class="w-full py-2 ms-2 rounded truncate"
                        >
                            {{ $type->title_ru }}
                        </label>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <div id="CountrySearch"
         class="z-10 hidden bg-blackSimple text-white rounded-lg shadow w-60 overflow-hidden select-none"
    >
        <ul aria-labelledby="CountrySearchButton"
            class="min-h-20 max-h-72 px-2 py-2 overflow-y-auto"
        >
            @foreach($countries as $country)
                <li>
                    <div class="flex items-center ps-2 rounded hover:bg-blackActive">
                        <input id="country_{{ $country->id }}"
                               type="checkbox"
                               name="country[]"
                               value="{{ $country->id }}"
                               @if(request()->exists('country'))
                                   @foreach(request('country') as $countryValue)
                                       @checked($country->id === (int) $countryValue)
                                   @endforeach
                               @endif
                               class="w-4 h-4 p-2 mx-1 text-love bg-gray-500 border-gray-500 rounded ring-0 focus:ring-0"
                        >
                        <label for="country_{{ $country->id }}"
                               class="w-full py-2 ms-2 rounded truncate"
                        >
                            {{ $country->title_ru }}
                        </label>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <div id="GenreSearch"
         class="z-10 hidden bg-blackSimple text-white rounded-lg shadow w-60 overflow-hidden select-none"
    >
        <div class="p-2 text-center">
            <label class="inline-flex items-center cursor-pointer">
                                <span class="me-3">
                                    {{ __('Строгий поиск?') }}
                                </span>
                <input type="checkbox"
                       name="strict_genre"
                       class="sr-only peer"
                    @checked(request()->exists('strict_genre'))
                >
                <span class="relative w-9 h-5 bg-red-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-400 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-lime-300"></span>
            </label>
        </div>
        <ul aria-labelledby="GenreSearchButton"
            class="min-h-20 max-h-72 px-2 py-2 overflow-y-auto"
        >
            @foreach($genres as $genre)
                <li>
                    <div class="flex items-center ps-2 rounded hover:bg-blackActive">
                        <input id="genre_{{ $genre->id }}"
                               type="checkbox"
                               name="genre[]"
                               value="{{ $genre->id }}"
                               @if(request()->exists('genre'))
                                   @foreach(request('genre') as $genreValue)
                                       @checked($genre->id === (int) $genreValue)
                                   @endforeach
                               @endif
                               class="w-4 h-4 p-2 mx-1 text-love bg-gray-500 border-gray-500 rounded ring-0 focus:ring-0"
                        >
                        <label for="genre_{{ $genre->id }}"
                               class="w-full py-2 ms-2 rounded truncate"
                        >
                            {{ $genre->title_ru }}
                        </label>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <div id="StudioSearch"
         class="z-10 hidden bg-blackSimple text-white rounded-lg shadow w-60 overflow-hidden select-none"
    >
        <div class="p-2 text-center">
            <label class="inline-flex items-center cursor-pointer">
                                <span class="me-3">
                                    {{ __('Строгий поиск?') }}
                                </span>
                <input type="checkbox"
                       name="strict_studio"
                       class="sr-only peer"
                    @checked(request()->exists('strict_studio'))
                >
                <span class="relative w-9 h-5 bg-red-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-400 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-lime-300"></span>
            </label>
        </div>
        <ul aria-labelledby="StudioSearchButton"
            class="min-h-20 max-h-72  px-2 py-2 overflow-y-auto"
        >
            @foreach($studios as $studio)
                <li>
                    <div class="flex items-center ps-2 rounded hover:bg-blackActive">
                        <input id="studio_{{ $studio->id }}"
                               type="checkbox"
                               name="studio[]"
                               value="{{ $studio->id }}"
                               @if(request()->exists('studio'))
                                   @foreach(request('studio') as $studioValue)
                                       @checked($studio->id === (int) $studioValue)
                                   @endforeach
                               @endif
                               class="w-4 h-4 p-2 mx-1 text-love bg-gray-500 border-gray-500 rounded ring-0 focus:ring-0"
                        >
                        <label for="studio_{{ $studio->id }}"
                               class="w-full py-2 ms-2 rounded truncate"
                        >
                            {{ $studio->title }}
                        </label>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</form>
