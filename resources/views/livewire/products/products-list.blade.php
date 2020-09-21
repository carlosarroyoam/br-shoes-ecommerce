<section>
    <a href="{{ route($seeAllRoute) }}">
        <h1 class="text-2xl uppercase text-header">{{ $title }}</h1>
    </a>

    {{-- if products > 0 --}}
    <div class="grid grid-cols-1 gap-5 mt-4 md:grid-cols-3 lg:grid-cols-5">
        @foreach ($products as $product)
        <a href="{{ route('home') }}"
            class="relative flex flex-col w-full overflow-hidden rounded-sm shadow md-w-1/2 bg-background">
            <img class="w-full bg-cover" src="https://via.placeholder.com/720" alt="">
            <div class="p-4 ">
                <p class="text-xs uppercase text-header-secondary">BR SHOES</p>
                <h3 class="text-header">Sneaker Snake</h3>
                <p class="mt-2 text-sm text-body-secondary">$ 349.00</p>

                @auth
                <x-products.icon-button class="mr-12" onClickAction="addToWishList"
                    ariaLabel="Add product to wish list">
                    <x-slot name="svgPath">
                        <path fill-rule="evenodd"
                            d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                    </x-slot>
                </x-products.icon-button>
                @endauth

                <x-products.icon-button class="mr-4" onClickAction="addToWishList"
                    ariaLabel="Add product to shopping bag">
                    <x-slot name="svgPath">
                        <path fill-rule="evenodd"
                            d="M14 5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5zM1 4v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4H1z" />
                        <path d="M8 1.5A2.5 2.5 0 0 0 5.5 4h-1a3.5 3.5 0 1 1 7 0h-1A2.5 2.5 0 0 0 8 1.5z" />
                    </x-slot>
                </x-products.icon-button>
            </div>
        </a>
        @endforeach
    </div>

    <div class="flex flex-row justify-end mt-4">
        <a href="{{ route($seeAllRoute) }}" class="text-base uppercase text-body-secondary">
            {{ $seeAllMessage }}
        </a>
    </div>


    {{-- if products == 0 render and empty state --}}

</section>
