<div id="anime-folder-create-modal"
     data-modal-backdrop="static"
     tabindex="-1"
     aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full select-none">
        <!-- Modal content -->
        <div class="relative bg-black/70 rounded-lg shadow backdrop-blur">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold text-white truncate">
                    {{ __('Добавить папку') }}
                </h3>
                <button type="button"
                        data-modal-hide="anime-folder-create-modal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-3 ms-1 inline-flex justify-center items-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 space-y-4">
                <form action="{{ route('user.folders.animes.store') }}"
                      method="POST"
                      id="folder_create"
                      class="flex flex-row justify-center items-center text-white text-xl"
                >
                    @csrf
                    <div class="w-full">
                        <label for="title"
                               class="block mb-2 text-lg font-medium text-white">
                            Название папки
                        </label>
                        <input type="text"
                               id="title"
                               name="title"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex justify-center p-4 border-t border-gray-200 rounded-b">
                <button data-modal-hide="anime-folder-create-modal"
                        type="submit"
                        form="folder_create"
                        class="bg-black text-white font-bold rounded border-b-2 border-lime-500 hover:border-lime-600 hover:bg-lime-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center mx-3">
                    <span class="mr-2">
                        {{ __('Добавить') }}
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentcolor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                    </svg>
                </button>

                <button data-modal-hide="anime-folder-create-modal"
                        type="button"
                        class="bg-black text-white font-bold rounded border-b-2 border-red-500 hover:border-red-600 hover:bg-red-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center mx-3">
                    <span class="mr-2">
                        {{ __('Отмена') }}
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentcolor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
