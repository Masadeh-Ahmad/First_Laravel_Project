{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-white bg-indigo-600 p-4">--}}
{{--            {{ __('Add New Subject') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}
    <form method="POST" action="{{ route('addSubject') }}" class="max-w-md mx-auto mt-8">
        @csrf
        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Pass Mark -->
        <div class="mb-4">
            <x-input-label for="pass_mark" :value="__('Pass Mark')" />
            <x-text-input id="pass_mark" class="block mt-1 w-full" type="text" name="pass_mark" :value="old('pass_mark')" required autocomplete="pass_mark" />
            <x-input-error :messages="$errors->get('pass_mark')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button>
                {{ __('Add Subject') }}
            </x-primary-button>
        </div>
    </form>
{{--</x-app-layout>--}}
