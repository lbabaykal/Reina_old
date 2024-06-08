@extends('admin.admin')
@section('title', config('app.name') . ' - Редактирование эпизода')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="relative overflow-x-auto shadow-md">
                <div class="p-5 text-xl font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Редактирование эпизода
                    @if ($message = session('message'))
                        - <span class="text-lime-500">{{ $message }}</span>
                    @endif
                </div>
                <form action="{{ route('admin.dorama.episodes.update', [$dorama, $episode]) }}" method="POST">
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
                                   value="{{ old('title_ru') ?? $episode->title_ru }}"
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
                                   value="{{ old('title_org') ?? $episode->title_org }}"
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
                                   value="{{ old('title_en') ?? $episode->title_en }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            />
                        </div>
                        <div>
                            <label for="number"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Порядковый номер @error('number') {{ $message }} @enderror
                            </label>
                            <input id="number"
                                   type="text"
                                   name="number"
                                   value="{{ old('number') ?? $episode->number }}"
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
                                        @selected((old('status') ?? $episode->status) == $status->value)
                                    >
                                        {{ $status->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <label for="note" class="block mb-2 text-sm font-medium text-gray-900">Примечание</label>
                    <textarea id="note"
                              rows="4"
                              name="note"
                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Напишите примечание..."
                    >{{ old('note') ?? $episode->note }}</textarea>

                    <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Контент</label>
                    <textarea id="content"
                              rows="4"
                              name="content"
                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Напишите контент..."
                    >{{ old('content') ?? $episode->content }}</textarea>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Добавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection


