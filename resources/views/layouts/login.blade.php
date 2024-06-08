<div class="flex flex-row">
    <a href="{{ route('search') }}" class="mr-5 flex items-center justify-center hover:text-red-500 duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8
        drop-shadow-[0_0_8px_rgba(0,0,0,1)]
        hover:drop-shadow-[0_0_8px_rgba(255,0,0,1)]
        " viewBox="0 0 24 24" fill="currentColor">
            <path d='M0 0h24v24H0V0z' fill='none'/>
            <path d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/>
        </svg>
    </a>

    @guest
        <a href="{{ route('login') }}"
            id="MenuDropdownButton"
            class="flex select-none flex-row transition-all duration-200 h-[40px] rounded-full bg-black/60 hover:bg-white/25">
            <div class="flex flex-col justify-center text-nowrap text-center">
                <div class="font-bold !text-lg px-6">
                    {{ __('Вход | Регистрация') }}
                </div>
            </div>
            <div class="h-10 w-10 rounded-full bg-cover bg-center"
                 style="background-image: url('{{ asset('assets/no_avatar.png') }}')">
            </div>
        </a>
    @endguest

    @auth
        <div id="MenuDropdownButton"
             data-dropdown-toggle="menu_dropdown"
             class="group flex cursor-pointer select-none flex-row transition-all duration-200 h-[40px] rounded-full bg-black/60"
        >
            <div class="relative flex flex-col justify-center text-nowrap text-center">
                <div class="truncate max-w-80 px-6 text-lg">
                    <span id="welcome" class="text-blue-500"></span>
                    <span class="text-red-500 font-bold">{{ Auth::user()->name }}</span>
                </div>
            </div>
            <div class="h-10 w-10 rounded-full bg-cover bg-center group-hover:drop-shadow-[0_0_10px_rgb(255,0,0)]"
    {{--             style="background-image: url('{{ Auth::user()->avatarUrl }}')">--}}
                 style="background-image: url('{{ asset('images/avatars/babayka.jpg') }}')">
            </div>
        </div>

        <div id="menu_dropdown"
             class="hidden absolute right-14 top-[60] w-72 select-none rounded bg-gray-900 shadow-[0_5px_10px_0_rgba(0,0,0,0.7)]">
            <div class="flex items-center border-b-2 border-b-blue-600">
                <div class="m-3 h-16 w-16 rounded-full bg-cover bg-center"
    {{--                 style="background-image: url('{{ Auth::user()->avatarUrl }}')">--}}
                    style="background-image: url('{{ asset('images/avatars/babayka.jpg') }}')">
                </div>
                <div class="flex-row w-[200]">
                    <div class="truncate text-xl font-bold">{{ Auth::user()->name }}</div>
                    <div class="truncate text-lg text-red-500">
    {{--                    {{ Auth::user()->rolesRus->first() }}--}}
                        Администратор
                    </div>
                </div>
            </div>

            <div class="flex flex-col text-lg">
    {{--            @if (Auth::user()->can('Admin_Panel'))--}}
                    <a href="{{ route('admin.index') }}"
                       class="group flex flex-row items-center px-4 hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="m-1.5 h-8 w-8 group-hover:stroke-fuchsia-700">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z" />
                        </svg>
                        <span class="ml-2 group-hover:text-black">
                            Admin_Panel
                        </span>
                    </a>
    {{--            @endif--}}
                <a href="#"
                   class="group flex flex-row items-center px-4 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         fill="currentColor"
                         class="m-1.5 h-8 w-8 fill-none stroke-lime-500 group-hover:fill-lime-500 group-hover:stroke-lime-500">
                        <path fill-rule="evenodd"
                              d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                              clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2 group-hover:text-black">
                        {{ __('Аккаунт') }}
                    </span>
                </a>
                <a href="{{ route('folders.index') }}"
                   class="group flex flex-row items-center px-4 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         class="m-1.5 h-8 w-8 fill-none stroke-red-500 group-hover:fill-red-500 group-hover:stroke-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                    </svg>
                    <span class="ml-2 group-hover:text-black">
                        {{ __('Избранное') }}
                    </span>
                </a>
                <a href="{{ route('profile.show') }}"
                   class="group flex flex-row items-center px-4 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         fill="currentColor"
                         class="m-1.5 h-8 w-8 fill-none stroke-blue-600 group-hover:fill-blue-600 group-hover:stroke-blue-600">
                        <path fill-rule="evenodd"
                              d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                              clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2 group-hover:text-black">
                        {{ __('Настройки') }}
                    </span>
                </a>
                <button type="submit"
                        form="logout"
                        class="group flex flex-row items-center px-4 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="m-1.5 h-8 w-8 group-hover:stroke-black">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    <span class="ml-2 group-hover:text-black">
                        {{ __('Выход') }}
                    </span>
                </button>
            </div>

            <form id="logout"
                  class="profile-menu-button"
                  action="{{ route('logout') }}"
                  method="POST">
                @csrf
            </form>
        </div>

        <script>
            let MyDate = new Date,
                MyHours = MyDate.getHours(),
                elements = document.getElementById('welcome'),
                name = elements.innerText;
            switch (true){
                case (MyHours >= 6) && (MyHours < 12):elements.innerText = 'Доброе утро,';
                    break;
                case (MyHours >= 12) && (MyHours < 18):elements.innerText = 'Добрый день,';
                    break;
                case (MyHours >= 18) && (MyHours <= 23):elements.innerText = 'Добрый вечер,';
                    break;
                case (MyHours >= 0) && (MyHours < 6):elements.innerText = 'Доброй ночи, ';
                    break;
                default:elements.innerText = 'Здравствуйте';
                    break;
            }
        </script>
    @endauth
</div>
