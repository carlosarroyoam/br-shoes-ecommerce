@props([
'type' => 'dark',
'colors' => [
'light' => 'bg-green-500 border-green-600 text-green-100',
'dark' => 'bg-green-500 border-green-600 text-green-100',
'success' => 'bg-green-500 border-green-600 text-green-100',
'error' => 'bg-red-500 border-red-600 text-red-100',
'warning' => 'bg-orange-500 border-orange-600 text-orange-100'
]
])

<section
    {{ $attributes->merge(['class' => "{$colors[$type]} m-4 fixed bottom-0 right-0 max-w-xl z-40 border-b p-4 rounded-md"]) }}>
    <div class="flex justify-between">
        <p>
            {{ $slot }}
        </p>

        <button title="Close" aria-label="Close alert"
            class="ml-3 rounded focus:outline-none focus:shadow-outline hover:shadow-outline">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z" />
                <path fill-rule="evenodd"
                    d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z" />
            </svg>
        </button>
    </div>
</section>
