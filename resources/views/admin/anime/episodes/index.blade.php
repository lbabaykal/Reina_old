@extends('admin.admin')
@section('title', config('app.name') . ' - Эпизоды ' . $anime->title_ru)
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="relative overflow-x-auto shadow-md">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <caption class="p-5 text-xl font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Список эпизодов - {{ $anime->title_ru }} {{ $anime->episodes_released }}/{{ $anime->episodes_total }}
                        @if ($message = session('message'))
                            - <span class="text-lime-500">{{ $message }}</span>
                        @endif
                        <p class="mt-1 text-base">
                            <a href="{{ route('admin.anime.edit', $anime) }}" class="text-red-500 hover:text-blue-500 mr-2">
                                Назад к редактированию
                            </a>
                            <a href="{{ route('admin.anime.episodes.create', $anime) }}" class="text-red-500 hover:text-blue-500 mr-2">
                                Добавить эпизод
                            </a>
                        </p>
                    </caption>
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Номер
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Название
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Статус
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Дата премьеры
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Редактировать
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Удаление
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($episodes as $episode)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ $episode->number }}
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $episode->title_ru }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $episode->status }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $episode->release_date }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.anime.episodes.edit', [$anime, $episode]) }}"
                                   class="hover:text-love"
                                >
                                    Реадактировать
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.anime.episodes.destroy', [$anime, $episode])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $episodes->links() }}
        </div>
    </div>
@endsection


