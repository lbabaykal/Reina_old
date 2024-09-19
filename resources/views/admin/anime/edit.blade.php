@extends('admin.admin')
@section('title', config('app.name') . ' - Редактирование аниме')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="relative overflow-x-auto shadow-md">
                <div class="p-5 text-xl font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Редактирование аниме - {{ $anime->title_ru }}
                    @if ($message = session('message'))
                        - <span class="text-lime-500">{{ $message }}</span>
                    @endif

                    <a href="{{ route('admin.anime.episodes.index', $anime) }}">
                        <button type="button" class="px-4 py-2 bg-orange-400 hover:bg-orange-500 rounded">Эпизоды</button>
                    </a>
                </div>

                <a href="{{ route('admin.anime.regenerateSlug', $anime) }}">
                    <button type="button" class="px-4 py-2 bg-red-400 hover:bg-red-500 rounded">Перегенерировать слаг</button>
                </a>

                <form action="{{ route('admin.anime.update', $anime) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="title_ru"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Русское название  @error('title_ru') {{ $message }} @enderror
                            </label>
                            <input id="title_ru"
                                   type="text"
                                   name="title_ru"
                                   value="{{ old('title_ru') ?? $anime->title_ru }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            />
                        </div>
                        <div>
                            <label for="title_org"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Оригинальное название  @error('title_org') {{ $message }} @enderror
                            </label>
                            <input id="title_org"
                                   type="text"
                                   name="title_org"
                                   value="{{ old('title_org') ?? $anime->title_org }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            />
                        </div>
                        <div>
                            <label for="title_en"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Английское название  @error('title_en') {{ $message }} @enderror
                            </label>
                            <input id="title_en"
                                   type="text"
                                   name="title_en"
                                   value="{{ old('title_en') ?? $anime->title_en }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            />
                        </div>
                        <div>
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Выберите тип  @error('type') {{ $message }} @enderror
                            </label>
                            <select id="type"
                                    name="type"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                                <option>Пусто</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" @selected((old('type') ?? $anime->type_id) == $type->id)>{{ $type->title_ru }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Выберите жанр  @error('genres') {{ $message }} @enderror
                            </div>
                            <button id="dropdownCheckboxButton"
                                    data-dropdown-toggle="dropdownGenres"
                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button"
                            >
                                Жанры
                            </button>
                            <div id="dropdownGenres" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCheckboxButton">
                                    @foreach($genres as $genre)
                                        <li>
                                            <div class="flex items-center">
                                                <input id="checkbox-item-{{ $genre->id }}"
                                                       type="checkbox"
                                                       value="{{ $genre->id }}"
                                                       name="genres[]"
                                                            @if(old('genres') ? in_array($genre->id, old('genres')) : $anime->genres->contains($genre->id))
                                                                @checked(true)
                                                            @endif
                                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="checkbox-item-{{ $genre->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    {{ $genre->title_ru }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Выберите студию  @error('studios') {{ $message }} @enderror
                            </div>
                            <button id="dropdownCheckboxButton"
                                    data-dropdown-toggle="dropdownStudios"
                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button"
                            >
                                Студии
                            </button>
                            <div id="dropdownStudios" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCheckboxButton">
                                    @foreach($studios as $studio)
                                        <li>
                                            <div class="flex items-center">
                                                <input id="checkbox-item-{{ $studio->id }}"
                                                       type="checkbox"
                                                       value="{{ $studio->id }}"
                                                       name="studios[]"
                                                           @if(old('studios') ? in_array($studio->id, old('studios')) : $anime->studios->contains($studio->id))
                                                               @checked(true)
                                                           @endif
                                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="checkbox-item-{{ $studio->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    {{ $studio->title }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div>
                            <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Выберите страну  @error('country') {{ $message }} @enderror
                            </label>
                            <select id="country"
                                    name="country"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                                <option selected>Пусто</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}"
                                        @selected((old('country') ?? $anime->country_id) == $country->id)
                                    >
                                        {{ $country->title_ru }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="age_rating" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Выберите возрастной рейтинг @error('age_rating') {{ $message }} @enderror
                            </label>
                            <select id="age_rating"
                                    name="age_rating"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                                <option selected>Пусто</option>
                                @foreach($age_ratings as $age_rating)
                                    <option value="{{ $age_rating->value }}"
                                        @selected((old('age_rating') ?? $anime->age_rating) == $age_rating->value)
                                    >
                                        {{ $age_rating->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="release"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Премьера  @error('release') {{ $message }} @enderror
                            </label>
                            <input id="release"
                                   type="date"
                                   name="release"
                                   value="{{ old('release') ?? $anime->release }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            />
                        </div>
                        <div>
                            <label for="episodes_released"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Вышло эпизодов @error('episodes_released') {{ $message }} @enderror
                            </label>
                            <input id="episodes_released"
                                   type="text"
                                   name="episodes_released"
                                   value="{{ old('episodes_released') ?? $anime->episodes_released }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            />
                        </div>
                        <div>
                            <label for="episodes_total"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Всего эпизодов  @error('episodes_total') {{ $message }} @enderror
                            </label>
                            <input id="episodes_total"
                                   type="text"
                                   name="episodes_total"
                                   value="{{ old('episodes_total') ?? $anime->episodes_total }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            />
                        </div>
                        <div>
                            <label for="duration"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Продолжительность эпизода  @error('duration') {{ $message }} @enderror
                            </label>
                            <input id="duration"
                                   type="text"
                                   name="duration"
                                   value="{{ old('duration') ?? $anime->duration }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            />
                        </div>
                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Статус статьи  @error('status') {{ $message }} @enderror
                            </label>
                            <select id="status"
                                    name="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                                @foreach($statuses as $status)
                                    <option value="{{ $status->value }}"
                                        @selected((old('status') ?? $anime->status) == $status->value)
                                    >
                                        {{ $status->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Разрешить комментировать? @error('is_comment') {{ $message }} @enderror
                            </div>
                            <label class="inline-flex items-center cursor-pointer">
                                <input
                                        type="checkbox"
                                        class="sr-only peer"
                                        name="is_comment"
                                    @checked($anime->is_comment)
                                >
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Переключить
                                </span>
                            </label>
                        </div>
                        <div>
                            <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Разрешить оценивать? @error('is_rating') {{ $message }} @enderror
                            </div>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox"
                                       class="sr-only peer"
                                       name="is_rating"
                                    @checked($anime->is_rating)
                                >
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Переключить
                                </span>
                            </label>
                        </div>
                        <div>
                            <label for="poster"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >
                                Выберите плакат  @error('poster') {{ $message }} @enderror
                            </label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                   id="poster"
                                   type="file"
                                   name="poster"
                                   value="{{ $anime->poster }}"
                            >
                        </div>
                        <div>
                            <label for="cover"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >
                                Выберите обложку  @error('cover') {{ $message }} @enderror
                            </label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                   id="cover"
                                   type="file"
                                   name="cover"
                                   value="{{ $anime->cover }}"
                            >
                        </div>
                    </div>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Описание</label>
                    <textarea id="message"
                              rows="4"
                              name="description"
                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Напишите описание..."
                    >{{ old('description') ?? $anime->description }}</textarea>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Добавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection


