<x-guest-layout>
    <form method="POST" action="{{ route('editUser', ['id' => $user->id]) }}">
        @csrf
        @method('PATCH')
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input placeholder="{{$user->name}}" id="name" class="block mt-1 w-full" type="text" name="name" value="{{$user->name}}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input placeholder="{{$user->email}}" id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="activation" :value="__('Activation')" />
            <select name="activation">
                <option value="true">
                    Activate
                </option>
                <option value="false">
                    Deactivate
                </option>

            </select>

        </div>



        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Edit') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
