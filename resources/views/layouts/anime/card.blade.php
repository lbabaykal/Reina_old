<div class="relative  select-none w-full aspect-[5/7] flex items-center justify-center">
    <a href="{{ route('anime.show', $anime->slug) }}"
       class="group relative overflow-hidden rounded-md w-95% aspect-[5/7] transition-all duration-500
            hover:w-full hover:drop-shadow-[0_0_6px_rgb(255,0,0)]">
        <div class="absolute w-full h-full top-0 left-0 bg-center bg-cover transition-all duration-500
                group-hover:scale-105 group-hover:brightness-110"
             style="background-image: url('{{ $anime->poster ? Storage::disk('anime_posters')->url($anime->poster) : asset('assets/no_image.png') }}')">
        </div>

        <div class="absolute px-2 top-1 right-1 bg-red-500/80 rounded">★ {{ $anime->rating }}</div>
        @if($anime->episodes_total !== 1)
            <div class="absolute bottom-2 left-2 px-1.5 py-0.5 bg-violet-600/70 transition-all duration-500
                    group-hover:opacity-0 group-hover:invisible">
                EPS: {{ $anime->episodes_released . '/' . $anime->episodes_total }}
            </div>
        @endif
        <div class="absolute w-full p-2 h-14 bottom-0 flex justify-center items-center
                transition-all duration-500 invisible opacity-0 bg-black/80
                group-hover:visible group-hover:opacity-100">
        <span class="text-center line-clamp-2">
            {{ $anime->title_ru }}
        </span>
        </div>
    </a>
</div>

