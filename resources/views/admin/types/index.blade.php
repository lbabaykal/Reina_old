@extends('admin.admin')
@section('title', config('app.name') . ' - Типы')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="relative overflow-x-auto shadow-md">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <caption class="p-5 text-xl font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Список типов
                        @if ($message = session('message'))
                            - <span class="text-lime-500">{{ $message }}</span>
                        @endif
                        <p class="mt-1 text-base text-red-500 dark:text-gray-400">
                            <a href="{{ route('admin.types.create') }}">
                                Добавить тип
                            </a>
                        </p>
                    </caption>
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Русское название
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Английское название
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($types as $type)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#">{{ $type->title_ru }}</a>
                            </th>
                            <td class="px-6 py-4">
                                {{ $type->title_en }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.types.edit', $type->slug) }}"
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
            {{ $types->links() }}
        </div>
    </div>
@endsection


