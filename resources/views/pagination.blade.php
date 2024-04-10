@if ($paginator->hasPages())
    <div class="grid h-[100px] w-full place-items-center overflow-x-scroll rounded-lg p-6 lg:overflow-visible select-none">
        <nav>
            <ul class="flex">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li>
                        <a class="mx-1 flex h-10 w-10 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
                           href="javascript:void(0);"
                           aria-label="Previous">
                            ❮
                        </a>
                    </li>
                @else
                    <li>
                        <a class="mx-1 flex h-10 w-10 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
                           href="{{ $paginator->previousPageUrl() }}"
                           aria-label="Previous">
                            ❮
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li>
                            <a class="mx-1 flex h-10 w-10 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
                               href="javascript:void(0);">{{ $element }}</a>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li>
                                    <a class="mx-1 flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-tr from-pink-600 to-pink-400 p-0 text-sm text-white shadow-md shadow-pink-500/20 transition duration-150 ease-in-out"
                                       href="javascript:void(0);">{{ $page }}</a>
                                </li>
                            @else

                                <li>
                                    <a class="mx-1 flex h-10 w-10 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
                                       href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a class="mx-1 flex h-10 w-10 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
                           href="{{ $paginator->nextPageUrl() }}"
                           aria-label="Next">
                            ❯
                        </a>
                    </li>
                @else
                    <li>
                        <a class="mx-1 flex h-10 w-10 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
                           href="javascript:void(0);"
                           aria-label="Next">
                            ❯
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
