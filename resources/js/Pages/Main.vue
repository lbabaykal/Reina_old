<script>
export default {
    name: "Main"
}
</script>

<template>
    <div>
        <section class="margin-content">
            <div class="py-2 select-none flex flex-row items-center justify-center">
                <router-link :to="{ name: 'animes.index' }"
                             class="font-bold group flex flex-row items-center justify-center"
                >
                    <span class="text-red-500 text-3xl">❮</span>
                    <span class="group-hover:text-red-500 text-4xl px-3 duration-300">АНИМЕ</span>
                    <span class="text-red-500 text-3xl">❯</span>
                </router-link>
            </div>

            <div class="w-full px-2.5 grid gap-3 place-items-center grid-flow-row grid-cols-8">
                @each('layouts.anime.card', $animes, 'anime')
            </div>

            <div class="py-2 select-none flex flex-row items-center justify-center">
                <router-link :to="{ name: 'doramas.index' }"
                             class="font-bold group flex flex-row items-center justify-center"
                >
                    <span class="text-violet-500 text-3xl">❮</span>
                    <span class="group-hover:text-violet-500 text-4xl px-3 duration-300">ДОРАМЫ</span>
                    <span class="text-violet-500 text-3xl">❯</span>
                </router-link>
            </div>

            <div class="w-full px-2.5 grid gap-3 place-items-center grid-flow-row grid-cols-8">
                @each('layouts.dorama.card', $doramas, 'dorama')
            </div>
        </section>
    </div>
</template>

<style scoped>

</style>
