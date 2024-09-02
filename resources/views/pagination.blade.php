@if ($paginator->hasPages())
    <div class="flex flex-col items-center my-8">
        <div class="flex text-white">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a href="javascript:void(0);"
                   aria-label="Previous"
                   class="h-11 w-11 mr-1 flex justify-center items-center rounded-full bg-blackSimple cursor-pointer hover:bg-gradient-to-tr from-lime-600 to-lime-400 hover:text-white">
                    ❮
                </a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   aria-label="Previous"
                   class="h-11 w-11 mr-1 flex justify-center items-center rounded-full bg-blackSimple cursor-pointer hover:bg-gradient-to-tr from-lime-600 to-lime-400 hover:text-white">
                    ❮
                </a>
            @endif

            <div class="flex h-11 font-medium rounded-full bg-blackSimple">
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <a href="javascript:void(0);"
                           class="w-11 flex justify-center items-center cursor-pointer leading-5 rounded-full hover:bg-gradient-to-tr from-lime-600 to-lime-400 hover:text-white">
                            {{ $element }}
                        </a>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <a href="javascript:void(0);"
                                   class="w-11 flex justify-center items-center cursor-pointer leading-5 rounded-full bg-gradient-to-tr from-pink-600 to-pink-400 text-white">
                                    {{ $page }}
                                </a>
                            @else
                                <a href="{{ $url }}"
                                   class="w-11 flex justify-center items-center cursor-pointer leading-5 rounded-full hover:bg-gradient-to-tr from-lime-600 to-lime-400 hover:text-white">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   aria-label="Next"
                   class="h-11 w-11 ml-1 flex justify-center items-center rounded-full bg-blackSimple cursor-pointer hover:bg-gradient-to-tr from-lime-600 to-lime-400 hover:text-white">
                    ❯
                </a>
            @else
                <a href="javascript:void(0);"
                   aria-label="Next"
                   class="h-11 w-11 ml-1 flex justify-center items-center rounded-full bg-blackSimple cursor-pointer hover:bg-gradient-to-tr from-lime-600 to-lime-400 hover:text-white">
                    ❯
                </a>
            @endif
        </div>
    </div>
@endif
