<div id="anime-folders-modal"
     data-modal-backdrop="static"
     tabindex="-1"
     aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full select-none">
        <!-- Modal content -->
        <div class="relative bg-black/70 rounded-lg shadow backdrop-blur">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold text-white truncate">
                    {{ __('Добавить в папку') }}
                </h3>
                <button type="button"
                        data-modal-hide="anime-folders-modal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-3 ms-1 inline-flex justify-center items-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 space-y-4">
                <div class="flex flex-col justify-center items-center text-white text-xl">

                    <div class="group flex w-80 my-1 bg-black/80 hover:bg-white/20 backdrop-blur">
                        <input id="1"
                               type="radio"
                               name="folder"
                               class="hidden peer"
                               value="1"
                        />
                        <label for="1"
                               class="inline-flex items-center justify-between w-full p-2 cursor-pointer peer-checked:bg-white peer-checked:text-black">
                            <div class="w-full flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                     class="w-7 h-7 stroke-blue-500 fill-blue-500 mx-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                                </svg>
                                {{ __('Смотрю') }}
                            </div>
                        </label>
                    </div>

                    <div class="group flex w-80 my-1 bg-black/80 hover:bg-white/20 backdrop-blur">
                        <input id="2"
                               type="radio"
                               name="folder"
                               class="hidden peer"
                               value="2"
                        />
                        <label for="2"
                               class="inline-flex items-center justify-between w-full p-2 cursor-pointer peer-checked:bg-white peer-checked:text-black">
                            <div class="w-full flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-7 h-7 stroke-violet-500 fill-violet-500 mx-3">
                                    <circle cx="12" cy="12" r="10" stroke-width="1.5"/>
                                    <path d="M12 8V12L14.5 14.5" stroke-width="1.5" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{ __('В планах') }}
                            </div>
                        </label>
                    </div>

                    <div class="group flex w-80 my-1 bg-black/80 hover:bg-white/20 backdrop-blur">
                        <input id="3"
                               type="radio"
                               name="folder"
                               class="hidden peer"
                               value="1"
                        />
                        <label for="3"
                               class="inline-flex items-center justify-between w-full p-2 cursor-pointer peer-checked:bg-white peer-checked:text-black">
                            <div class="w-full flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                     class="w-7 h-7 stroke-red-500 fill-red-500 mx-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                                {{ __('Любимое') }}
                            </div>
                        </label>
                    </div>

                    <div class="group flex w-80 my-1 bg-black/80 hover:bg-white/20 backdrop-blur">
                        <input id="4"
                               type="radio"
                               name="folder"
                               class="hidden peer"
                               value="4"
                        />
                        <label for="4"
                               class="inline-flex items-center justify-between w-full p-2 cursor-pointer peer-checked:bg-white peer-checked:text-black">
                            <div class="w-full flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                     class="w-7 h-7 stroke-lime-500 mx-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                {{ __('Просмотрено') }}
                            </div>
                        </label>
                    </div>

                    <div class="group flex w-80 my-1 bg-black/80 hover:bg-white/20 backdrop-blur">
                        <input id="5"
                               type="radio"
                               name="folder"
                               class="hidden peer"
                               value="5"
                        />
                        <label for="5"
                               class="inline-flex items-center justify-between w-full p-2 cursor-pointer peer-checked:bg-white peer-checked:text-black">
                            <div class="flex justify-start w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                     class="w-7 h-7 stroke-red-500 mx-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                                {{ __('Брошено') }}
                            </div>
                        </label>
                    </div>

                    <div class="group flex w-80 my-1 bg-black/80 hover:bg-white/20 backdrop-blur">
                        <input id="6"
                               type="radio"
                               name="folder"
                               class="hidden peer"
                               value="5"
                        />
                        <label for="6"
                               class="inline-flex items-center justify-between w-full p-2 cursor-pointer peer-checked:bg-white peer-checked:text-black">
                            <div class="group flex justify-start w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                     class="w-7 h-7 fill-orange-400 mx-3">
                                <path d="M1 1h6.5v6.5H1V1zM8.5 1H15v6.5H8.5V1zM1 8.5h6.5V15H1V8.5zM8.5 8.5H15V15H8.5V8.5z"/>
                                </svg>
                                Романтика
                            </div>
                        </label>
                    </div>
                </div>

            </div>
            <!-- Modal footer -->
            <div class="flex justify-center p-4 border-t border-gray-200 rounded-b">
                <button data-modal-hide="anime-folders-modal"
                        type="button"
                        class="bg-black text-white font-bold rounded border-b-2 border-lime-500 hover:border-lime-600 hover:bg-lime-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center mx-3">
                    <span class="mr-2">
                        {{ __('Добавить') }}
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentcolor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                    </svg>
                </button>

                <button data-modal-hide="anime-folders-modal"
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
