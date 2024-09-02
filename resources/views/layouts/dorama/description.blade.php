<div class="w-10/12 m-auto">
    <div class="">
        <ul id="default-tab"
            data-tabs-toggle="#default-tab-content"
            role="tablist"
            class="flex flex-wrap -mb-px font-bold text-xl text-center"
            data-tabs-active-classes="text-love hover:text-love border-love"
            data-tabs-inactive-classes="text-gray-400 hover:text-white border-gray-400 hover:border-white"
        >
            <li class="me-2" role="presentation">
                <button id="information-tab"
                        data-tabs-target="#information"
                        type="button"
                        role="tab"
                        aria-controls="description"
                        aria-selected="false"
                        class="inline-block p-4 border-b-2 tracking-wide"
                >
                    {{ __('Информация') }}
                </button>
            </li>
            <li class="me-2" role="presentation">
                <button id="actors-tab"
                        data-tabs-target="#actors"
                        type="button"
                        role="tab"
                        aria-controls="actors"
                        aria-selected="false"
                        class="inline-block p-4 border-b-2 tracking-wide"
                >
                    {{ __('Актеры и съемочная группа') }}
                </button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content">
        <div id="information"
             role="tabpanel"
             aria-labelledby="information-tab"
             class="hidden p-4"
        >
            <div class="flex flex-row">
                <dl class="w-6/12 text-white text-lg">
                    <div class="flex flex-col py-2">
                        <dt class="text-gray-400 text-xl">{{ __('Оригинальное название') }}</dt>
                        <dd>
                            {{ $dorama->title_org }}
                        </dd>
                    </div>
                    <div class="flex flex-col py-2">
                        <dt class="text-gray-400 text-xl">{{ __('Английское название') }}</dt>
                        <dd>
                            {{ $dorama->title_en }}
                        </dd>
                    </div>
                    <div class="flex flex-col py-2">
                        <dt class="text-gray-400 text-xl">{{ __('Страна') }}</dt>
                        <dd>
                            {{ $dorama->country->title_ru }}
                        </dd>
                    </div>
                    <div class="flex flex-col py-2">
                        <dt class="mb-1 text-gray-400 text-xl">{{ __('Премьера') }}</dt>
                        <dd>{{ \Illuminate\Support\Carbon::parse($dorama->release)->isoFormat('D MMMM, YYYY г.') }}</dd>
                    </div>
                </dl>

                <dl class="w-6/12 text-white text-lg">
                    <div class="flex flex-col py-2">
                        <dt class="text-gray-400 text-xl">{{ __('Тип') }}</dt>
                        <dd>
                            {{ $dorama->type->title_ru }}
                        </dd>
                    </div>
                    @if($dorama->genres->isNotEmpty())
                        <div class="flex flex-col py-2">
                            <dt class="text-gray-400 text-xl">{{ __('Жанр') }}</dt>
                            <dd>
                                @foreach($dorama->genres as $genre)
                                    <a href="{{ route('dorama.index', ['genre[]' => $genre->id]) }}"
                                       class="underline decoration-1 underline-offset-4 hover:decoration-red-500 hover:text-red-500 tracking-wide"
                                    >{{ $genre->title_ru }}</a>
                                    @if($loop->last === false)
                                        <span class="text-red-500 text-xl">•</span>
                                    @endif
                                @endforeach
                            </dd>
                        </div>
                    @endif
                    @if($dorama->studios->isNotEmpty())
                        <div class="flex flex-col py-2">
                            <dt class="text-gray-400 text-xl">{{ __('Студия') }}</dt>
                            <dd>
                                @foreach($dorama->studios as $studio)
                                    <a href="{{ route('search', ['studio[]' => $studio->id]) }}"
                                       class="underline decoration-1 underline-offset-4 hover:decoration-red-500 hover:text-red-500 tracking-wide"
                                    >{{ $studio->title }}</a>
                                    @if($loop->last === false)
                                        <span class="text-red-500 text-xs">&#9679;</span>
                                    @endif
                                @endforeach
                            </dd>
                        </div>
                    @endif
                    <div class="flex flex-col py-2">
                        <dt class="mb-1 text-gray-400 text-xl">{{ __('Продолжительность') }}</dt>
                        <dd>
                            @if($dorama->episodes_total > 1)
                                {{ $dorama->episodes_released }} / {{ $dorama->episodes_total }},
                            @endif
                             ~{{ \Carbon\CarbonInterval::minutes($dorama->duration)->cascade()->forHumans(['short' => true])  }}
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="text-justify text-lg my-1 border-t border-gray-500 indent-8 p-4">
                {{ $dorama->description }}
            </div>
        </div>

        <div id="actors"
             role="tabpanel"
             aria-labelledby="actors-tab"
             class="hidden p-4"
        >
            <div class="">
                Список актеров, режисеры, сценаристы
            </div>
        </div>
    </div>
</div>
