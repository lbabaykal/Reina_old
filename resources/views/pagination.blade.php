{{--@if ($paginator->hasPages())
    <div class="grid h-[100px] w-full place-items-center overflow-x-scroll rounded-lg p-6 lg:overflow-visible select-none">
        <nav>
            <ul class="flex">
                --}}{{-- Previous Page Link --}}{{--
                @if ($paginator->onFirstPage())
                    <li>
                        <a class="mx-1 flex h-10 w-10 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-blue-gray-500 transition duration-150 ease-in-out hover:bg-gradient-to-tr from-lime-600 to-lime-400"
                           href="javascript:void(0);"
                           aria-label="Previous">
                            ❮
                        </a>
                    </li>
                @else
                    <li>
                        <a class="mx-1 flex h-10 w-10 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
                           href="{{ $paginator->previousPageUrl() }}"
                           aria-label="Previous">
                            ❮
                        </a>
                    </li>
                @endif

                --}}{{-- Pagination Elements --}}{{--
                @foreach ($elements as $element)
                    --}}{{-- "Three Dots" Separator --}}{{--
                    @if (is_string($element))
                        <li>
                            <a class="mx-1 flex h-10 w-10 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
                               href="javascript:void(0);">{{ $element }}</a>
                        </li>
                    @endif

                    --}}{{-- Array Of Links --}}{{--
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li>
                                    <a class="mx-1 flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-tr from-pink-600 to-pink-400 p-0 text-white shadow-md shadow-pink-500/20 transition duration-150 ease-in-out"
                                       href="javascript:void(0);">{{ $page }}</a>
                                </li>
                            @else

                                <li>
                                    <a class="mx-1 flex h-10 w-10 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
                                       href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                --}}{{-- Next Page Link --}}{{--
                @if ($paginator->hasMorePages())
                    <li>
                        <a class="mx-1 flex h-10 w-10 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
                           href="{{ $paginator->nextPageUrl() }}"
                           aria-label="Next">
                            ❯
                        </a>
                    </li>
                @else
                    <li>
                        <a class="mx-1 flex h-10 w-10 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
                           href="javascript:void(0);"
                           aria-label="Next">
                            ❯
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif--}}





@if ($paginator->hasPages())
    <div class="flex flex-col items-center my-12">
            <div class="flex text-white">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <a href="javascript:void(0);"
                       aria-label="Previous"
                       class="h-12 w-12 mr-1 flex justify-center items-center rounded-full bg-blackSimple cursor-pointer hover:bg-gradient-to-tr from-lime-600 to-lime-400 hover:text-white">
                        ❮
                    </a>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                       aria-label="Previous"
                       class="h-12 w-12 mr-1 flex justify-center items-center rounded-full bg-blackSimple cursor-pointer hover:bg-gradient-to-tr from-lime-600 to-lime-400 hover:text-white">
                        ❮
                    </a>
                @endif

                <div class="flex h-12 font-medium rounded-full bg-blackSimple">
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <a href="javascript:void(0);"
                               class="w-12 flex justify-center items-center cursor-pointer leading-5 rounded-full hover:bg-gradient-to-tr from-lime-600 to-lime-400 hover:text-white">
                                {{ $element }}
                            </a>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <a href="javascript:void(0);"
                                       class="w-12 flex justify-center items-center cursor-pointer leading-5 rounded-full bg-gradient-to-tr from-pink-600 to-pink-400 text-white">
                                        {{ $page }}
                                    </a>
                                @else
                                    <a href="{{ $url }}"
                                       class="w-12 flex justify-center items-center cursor-pointer leading-5 rounded-full hover:bg-gradient-to-tr from-lime-600 to-lime-400 hover:text-white">
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
                       class="h-12 w-12 ml-1 flex justify-center items-center rounded-full bg-blackSimple cursor-pointer hover:bg-gradient-to-tr from-lime-600 to-lime-400 hover:text-white">
                        ❯
                    </a>
                @else
                    <a href="javascript:void(0);"
                       aria-label="Next"
                       class="h-12 w-12 ml-1 flex justify-center items-center rounded-full bg-blackSimple cursor-pointer hover:bg-gradient-to-tr from-lime-600 to-lime-400 hover:text-white">
                        ❯
                    </a>
                @endif
            </div>
    </div>
@endif
