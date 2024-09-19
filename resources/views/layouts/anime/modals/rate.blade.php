<div id="anime-rate-modal"
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
                    {{ __('Оценить') }} - {{ $anime->title_ru }}
                </h3>
                <button type="button"
                        data-modal-hide="anime-rate-modal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-3 ms-1 inline-flex justify-center items-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 space-y-4">
                @if($ratingUser)
                    <div class="w-full text-center text-lg">
                        Ваша оценка: {{ $ratingUser }}
                    </div>
                @else
                    <div class="w-full text-center text-lg">
                        Вы ещё не оценивали данное аниме
                    </div>
                @endif

                <form action="{{ route('anime.rating.add', $anime) }}"
                      method="POST"
                      id="rating"
                      class="flex flex-row justify-center items-center text-white text-xl"
                >
                    @csrf
                    @method('PATCH')

                    @for ($i = 1; $i < 11; $i++)
                        <div class="group flex text-white hover:text-yellow-300">
                            <input id="{{ $i }}"
                                   type="radio"
                                   name="assessment"
                                   class="hidden peer"
                                   value="{{ $i }}"
                                   @checked($i == $ratingUser)
                            />
                            <label for="{{ $i }}"
                                   class="peer-checked:text-love"
                            >
                                <svg class="w-12 h-12 mx-1 cursor-pointer p-2"
                                     aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="currentColor"
                                     viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                            </label>
                        </div>
                    @endfor
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex justify-center p-4 border-t border-gray-200 rounded-b">
                <button data-modal-hide="anime-rate-modal"
                        type="submit"
                        form="rating"
                        class="bg-black text-white font-bold rounded border-b-2 border-lime-500 hover:border-lime-600 hover:bg-lime-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center mx-3">
                    <span class="mr-2">
                        {{ __('Оценить') }}
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentcolor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                    </svg>
                </button>

                <button data-modal-hide="anime-rate-modal"
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
