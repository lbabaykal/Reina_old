@extends('admin.admin')
@section('title', config('app.name') . ' - Аниме')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="relative overflow-x-auto shadow-md">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <caption class="p-5 text-xl font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Список аниме
                        @if ($message = session('message'))
                            - <span class="text-lime-500">{{ $message }}</span>
                        @endif
                        <p class="mt-1 text-base text-blue-500 dark:text-gray-400 w-full text-center">
                            <a href="{{ route('admin.anime.index') }}"
                               class="mx-10"
                            >
                                Все
                            </a>
                            <a href="{{ route('admin.anime.published') }}"
                               class="mx-10"
                            >
                                Опубликованные
                            </a>
                            <a href="{{ route('admin.anime.draft') }}"
                               class="my-10"
                            >
                                Черновики
                            </a>
                            <a href="{{ route('admin.anime.archive') }}"
                               class="mx-10"
                            >
                                В архиве
                            </a>
                            <a href="{{ route('admin.anime.deleted') }}"
                               class="mx-10"
                            >
                                Удалённые
                            </a>
                        </p>
                        <p class="mt-1 text-base text-red-500 dark:text-gray-400">
                            <a href="{{ route('admin.anime.create') }}">
                                Добавить аниме
                            </a>
                        </p>
                    </caption>
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Название
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Тип
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Страна
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Рейтинг
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Статус
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Episodes
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Edit
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($animes as $anime)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{ route('anime.show', ['anime' => $anime->slug]) }}">{{ $anime->title_ru }}</a>
                            </th>
                            <td class="px-6 py-4">
                                {{ $anime->type->title_ru }} - {{ $anime->updated_at }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $anime->country->title_ru }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $anime->rating }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $anime->status }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.anime.episodes.index', $anime) }}"
                                   class="hover:text-love"
                                >
                                    {{ $anime->episodes_released }}/{{ $anime->episodes_total }} эпизодов
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.anime.edit', $anime) }}"
                                   class="hover:text-love"
                                >
                                    Реадактировать
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $animes->links() }}
        </div>
    </div>
@endsection


