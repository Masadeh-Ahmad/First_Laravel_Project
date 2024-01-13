<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white bg-indigo-600 p-4">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg p-10">

                <div class="container mx-auto mb-8 pt-6">
                    <table class="table-auto w-full bg-white border-collapse border border-gray-300">
                        <thead>
                        <tr class="bg-indigo-200">
                            <th class="border border-gray-300 px-4 py-2 text-center">Name</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $user->email }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                @if ($user->subjects->count() > 0)
                    <div class="text-center mb-8">
                        <p class="mt-6 text-xl font-semibold text-indigo-800">Your Subjects:</p>
                    </div>

                    <div class="container mx-auto mb-8 pb-3">
                        <table class="table-auto w-full bg-white border-collapse border border-gray-300">
                            <thead>
                            <tr class="bg-indigo-200">
                                <th class="border border-gray-300 px-4 py-2 text-center">Subject</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Pass Mark</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Your Mark</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($user->subjects as $subject)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $subject->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $subject->pass_mark }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $subject->pivot->mark_obtained }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center mt-5">
                        <p class="text-red-500">You are not enrolled in any subjects yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
