@extends('base.app')

@section('title', __('Home'))

@section('content')
<section class="lg:py-12 lg:flex lg:justify-center">
    <div class="bg-white lg:mx-8 lg:flex lg:max-w-5xl lg:shadow-md lg:rounded-md">
        <div class="lg:w-1/2">
            <div class="h-64 bg-cover lg:rounded-l-md lg:h-full"
                style="background-image:url('https://images.unsplash.com/photo-1497493292307-31c376b6e479?ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80')">
            </div>
        </div>

        <div class="max-w-xl px-8 py-10 lg:max-w-5xl lg:w-1/2">
            <h2 class="text-2xl font-bold text-gray-800 md:text-3xl">Build Your New <span
                    class="text-indigo-600">Idea</span></h2>
            <p class="mt-4 text-gray-600">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quidem modi
                reprehenderit vitae exercitationem aliquid dolores ullam temporibus enim expedita aperiam mollitia iure
                consectetur dicta tenetur, porro consequuntur saepe accusantium consequatur.</p>

            <x-button class="mt-4">
                <x-slot name="title">
                    Start Now
                </x-slot>
            </x-button>
        </div>
    </div>
</section>
@endsection
