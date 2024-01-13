{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-white bg-indigo-600 p-4">--}}
{{--            {{ __('Assign Subject To Student') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg p-10">--}}
{{--                <div class="text-center mb-8">--}}
{{--                    <p class="mt-3 text-xl font-semibold text-indigo-800">Enrollments List:</p>--}}
{{--                </div>--}}
                <div class="container mx-auto mb-8 pb-3">
                    <form method="POST" action="{{ route('enroll') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="flex justify-center">
                            <div class="w-full max-w-md">
                                <div class="mb-4">
                                    <label for="subject" class="block text-sm font-semibold text-gray-600">Subjects:</label>
                                    <select class="custom-select w-full px-4 py-2 border rounded-md" id="subject" name="subject" required>
                                        <option value="" disabled selected>Select a subject</option>
                                        @foreach($subjects as $subject)
                                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please select a subject.</div>
                                </div>
                                <div class="mb-4">
                                    <label for="user" class="block text-sm font-semibold text-gray-600">Students:</label>
                                    <select class="custom-select w-full px-4 py-2 border rounded-md" id="user" name="user" required>
                                        <option value="" disabled selected>Select a student</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}} -- {{$user->email}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please select a student.</div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded">Enroll</button>
                                </div>
                                <x-input-error :messages="$errors->get('submit')" class="mt-2" />
                            </div>
                        </div>
                    </form>
                </div>
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}
