<x-app-layout>
    <article>
        <livewire:products.products-list title="Todos los productos" seeAllRoute="products.index"
            seeAllMessage="Ver todos los productos" />

        <livewire:products.products-list title="Lo más nuevo" seeAllRoute="products.newest"
            seeAllMessage="Ver todos los nuevos productos" />
    </article>
</x-app-layout>
