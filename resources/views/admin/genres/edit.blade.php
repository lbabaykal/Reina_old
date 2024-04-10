@extends('admin.admin')
@section('title', config('app.name') . ' - Редактирование Жанра')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="relative overflow-x-auto shadow-md">
                <div class="p-5 text-xl font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Редактирование жанра
                </div>
                <form action="{{ route('admin.genres.update', $genre->slug) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="title_ru"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Русское название @error('title_ru') {{ $message }} @enderror
                            </label>
                            <input id="title_ru"
                                   type="text"
                                   name="title_ru"
                                   value="{{ old('title_ru') ?? $genre->title_ru }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required
                            />
                        </div>
                        <div>
                            <label for="title_en"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Английское название @error('title_en') {{ $message }} @enderror
                            </label>
                            <input id="title_en"
                                   type="text"
                                   name="title_en"
                                   value="{{ old('title_en') ?? $genre->title_en }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required
                            />
                        </div>
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Добавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection


