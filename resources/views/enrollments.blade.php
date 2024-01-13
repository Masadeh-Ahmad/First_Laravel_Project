<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white bg-indigo-600 p-4">
            {{ __('Enrollments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg p-10">

                @if ($students->count() > 0)
                    <div class="text-center mb-8">
                        <p class="mt-3 text-xl font-semibold text-indigo-800">Enrollments List:</p>
                    </div>
                    <div class="container mx-auto mb-8 pb-3">
                        <form method="post" action="{{ route('setMark') }}">
                            @csrf
                            @method('PATCH')
                            <table class="table table-auto border-collapse border border-gray-400 mx-auto">
                                <thead>
                                <tr class="bg-indigo-200">
                                    <th class="border border-gray-400 px-4 py-2 text-center">Student</th>
                                    <th class="border border-gray-400 px-4 py-2 text-center">E-Mail</th>
                                    <th class="border border-gray-400 px-4 py-2 text-center">Subject</th>
                                    <th class="border border-gray-400 px-4 py-2 text-center">Pass Mark</th>
                                    <th class="border border-gray-400 px-4 py-2 text-center">Mark</th>
                                    <th class="border border-gray-400 px-4 py-2 text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($students as $student)
                                    @foreach ($student->subjects as $subject)
                                        <tr>
                                            <td class="border border-gray-400 px-4 py-2 text-center">{{ $student->name }}</td>
                                            <td class="border border-gray-400 px-4 py-2 text-center">{{ $student->email }}</td>
                                            <td class="border border-gray-400 px-4 py-2 text-center">{{ $subject->name }}</td>
                                            <td class="border border-gray-400 px-4 py-2 text-center">{{ $subject->pass_mark }}</td>
                                            <td class="border border-gray-400 px-4 py-2 text-center">
                                                <input type="text" name="new_mark_{{$subject->pivot->id}}" placeholder="{{ $subject->pivot->mark_obtained }}" class="text-center">
                                            </td>
                                            <td class="border border-gray-400 px-4 py-2 text-center">
                                                <button type="submit" name="submit_button" value="{{$subject->pivot->id}}" class="bg-indigo-500 text-white px-4 py-2 rounded">Set New Mark</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                @else
                    <div class="text-center m-5 p-3 text-red-500">
                        <p>There are no students yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
