@extends('admin.admin')
@section('title', config('app.name') . ' - Дорамы')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="relative overflow-x-auto shadow-md">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <caption class="p-5 text-xl font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Список дорам
                        @if ($message = session('message'))
                            - <span class="text-lime-500">{{ $message }}</span>
                        @endif
                        <p class="mt-1 text-base text-blue-500 dark:text-gray-400 w-full text-center">
                            <a href="{{ route('admin.dorama.index') }}"
                               class="mx-10"
                            >
                                Все
                            </a>
                            <a href="{{ route('admin.dorama.published') }}"
                               class="mx-10"
                            >
                                Опубликованные
                            </a>
                            <a href="{{ route('admin.dorama.draft') }}"
                               class="my-10"
                            >
                                Черновики
                            </a>
                            <a href="{{ route('admin.dorama.archive') }}"
                               class="mx-10"
                            >
                                В архиве
                            </a>
                            <a href="{{ route('admin.dorama.deleted') }}"
                               class="mx-10"
                            >
                                Удаленные
                            </a>
                        </p>
                        <p class="mt-1 text-base text-red-500 dark:text-gray-400">
                            <a href="{{ route('admin.dorama.create') }}">
                                Добавить дораму
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
                    @foreach($doramas as $dorama)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{ route('dorama.show', $dorama) }}">{{ $dorama->title_ru }}</a>
                            </th>
                            <td class="px-6 py-4">
                                {{ $dorama->type->title_ru }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $dorama->country->title_ru }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $dorama->rating }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $dorama->status }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.dorama.episodes.index', $dorama) }}"
                                   class="hover:text-love"
                                >
                                    {{ $dorama->episodes_released }}/{{ $dorama->episodes_total }} эпизодов
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.dorama.edit', $dorama) }}"
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
            {{ $doramas->links() }}
        </div>
    </div>
@endsection


