<div class="w-full">

    <nav class="flex flex-row justify-between px-4 pt-4 pb-1">
        <button class="flex items-center justify-between w-[200] py-2 px-3 font-medium text-white bg-blackSimple border-b border-love hover:bg-blackActive"
        >
            {{ __('Сортировка') }}
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>

        <div class="flex items-center justify-between">
            <input form="search"
                   type="search"
                   name="title"
                   placeholder="Поиск по ключевым словам..."
                   value="{{ request('title') }}"
                   class="w-[600] bg-blackSimple text-white border-x-0 border-t-0 duration-200 transition text-center rounded-s-md focus:ring-0 focus:border-b-love hover:bg-blackActive focus:bg-blackActive"
            />
            <button form="search"
                    type="submit"
                    class="px-5 h-full text-love border border-love hover:bg-love hover:text-white rounded-e-md"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
                    <path d='M0 0h24v24H0V0z' fill='none'/>
                    <path d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/>
                </svg>
            </button>
        </div>

        <button id="mega-menu-full-dropdown-button"
                data-collapse-toggle="mega-menu-full-dropdown"
                class="flex items-center justify-between w-[200] py-2 px-3 font-medium text-white bg-blackSimple border-b border-love hover:bg-blackActive"
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
         class="bg-blackSimple border-blackActive shadow-sm border-y hidden pt-3 mt-2"
    >
        <form id="search" method="GET" class="flex flex-row justify-center">

            <div class="bg-blackSimple text-white w-60 overflow-hidden select-none mx-5">
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
                </ul>
            </div>

            <div class="bg-blackSimple text-white w-60 overflow-hidden select-none mx-5">
                <div class="font-bold flex flex-row justify-center items-center pb-2">
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

            <div class="bg-blackSimple text-white w-60 overflow-hidden select-none mx-5">
                <div class="font-bold flex flex-row justify-center items-center">
                    {{ __('Студия') }}
                    <label class="inline-flex items-center cursor-pointer ms-3 pb-2">
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

            <div class="bg-blackSimple text-white w-60 overflow-hidden select-none mx-5">
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


            <div class="bg-blackSimple text-white w-60 overflow-hidden select-none mx-3">
                <div class="text-center font-bold">
                    {{ __('Год') }}
                </div>

                <div class="px-2 py-2">
                    <div class="flex mb-4">
                        <div class="py-1.5 px-5 text-white rounded-s-md bg-gray-500">
                            ОТ
                        </div>
                        <input id="year_fromInput"
                               name="year_from"
                               value="{{ request('year_from') }}"
                               type="number"
                               min="1970"
                               max="2030"
                               placeholder="Введите год"
                               class="py-1.5 w-full text-center text-white bg-blackActive rounded-e-md border-none focus:ring-love"
                        >
                    </div>
                    <div class="relative">
                        <label for="year_fromRange" class="sr-only"></label>
                        <input id="year_fromRange"
                               type="range"
                               value="{{ request('year_from') }}"
                               min="1970"
                               max="2030"
                               oninput="updateYearFrom()"
                               class="w-full h-2.5 bg-white rounded-lg appearance-none cursor-ew-resize range-sm in-range:bg-gray-500"
                        >
                        <span class="text-sm text-gray-300 absolute start-0 -bottom-6">1970</span>
                        <span class="text-sm text-gray-300 absolute end-0 -bottom-6">2030</span>
                    </div>
                </div>

                <div class="px-2 py-2 mt-10">
                    <div class="flex mb-4">
                        <div class="py-1.5 px-5 text-white rounded-s-md bg-gray-500">
                            ДО
                        </div>
                        <input id="year_toInput"
                               name="year_to"
                               value="{{ request('year_to') }}"
                               type="number"
                               min="1970"
                               max="2030"
                               placeholder="Введите год"
                               class="py-1.5 w-full text-center text-white bg-blackActive rounded-e-md border-none focus:ring-love"
                        >
                    </div>
                    <div class="relative">
                        <label for="year_toRange" class="sr-only"></label>
                        <input id="year_toRange"
                               type="range"
                               value="{{ request('year_to') }}"
                               min="1970"
                               max="2030"
                               oninput="updateYearTo()"
                               class="w-full h-2.5 bg-gray-500 rounded-lg appearance-none cursor-ew-resize range-sm"
                        >
                        <span class="text-sm text-gray-300 absolute start-0 -bottom-6">1970</span>
                        <span class="text-sm text-gray-300 absolute end-0 -bottom-6">2030</span>
                    </div>
                </div>
            </div>

        </form>
    </div>

</div>


<script>
    function updateYearFrom() {
        document.getElementById('year_fromInput').value = document.getElementById('year_fromRange').value;
    }

    function updateYearTo() {
        document.getElementById('year_toInput').value = document.getElementById('year_toRange').value;
    }
</script>
