<header id="header" class="w-full bg-transparent fixed top-0 transition-all duration-500 ease-linear z-50">
    <nav class="mx-auto flex items-center justify-between h-[60px] px-[60]">
        <a href="/"
           class="logo-shadow text-3xl font-bold text-white flex flex-row content-center items-center select-none">
            Reina<img src="{{ asset('assets/lotus.png') }}" class="w-[40] inline-block ml-2">
        </a>

{{--        <form action="{{ route('article.filter_article') }}"--}}
{{--              method="GET"--}}
{{--              class="form my-auto flex h-10 w-[500] flex-row">--}}
{{--            <input types="search"--}}
{{--                   name="title"--}}
{{--                   placeholder="Поиск..."--}}
{{--                   class="w-[440] rounded-l border border-pink-800 bg-gray-800 px-3 transition-all duration-300 hover:bg-gray-200 hover:text-black focus:bg-gray-200 focus:text-black focus:outline-none" />--}}
{{--            <button types="submit"--}}
{{--                    class="group/btn w-[60] rounded-r border border-l-0 border-pink-800 transition-all duration-300 hover:bg-pink-600">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                     fill="none"--}}
{{--                     viewBox="0 0 24 24"--}}
{{--                     stroke-width="1.5"--}}
{{--                     stroke="currentColor"--}}
{{--                     class="mx-auto h-6 w-6 stroke-gray-400 group-hover/btn:stroke-white">--}}
{{--                    <path stroke-linecap="round"--}}
{{--                          stroke-linejoin="round"--}}
{{--                          d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />--}}
{{--                </svg>--}}
{{--            </button>--}}
{{--        </form>--}}

        @include('layouts.login')
    </nav>
</header>
