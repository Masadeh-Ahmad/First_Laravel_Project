<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white bg-indigo-600 p-4">
            {{ ('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg ">


                @if ($students->count() > 0)
                    <div class="container mx-auto mb-8 pb-3 pt-4">
                        <table class="table table-auto mx-auto">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">
                                    <a href="{{ route('register') }}" class="bg-indigo-500 text-white px-4 py-3 rounded">Add New User</a>
                                </th>

                                <th class="px-4 py-2">
                                    <button onclick="openSubjectModal()" class="bg-indigo-500 text-white px-4 py-2 rounded">Add New Subject</button>
                                </th>
                                <th>
                                    <button onclick="openEnrollmentModal()" class="bg-indigo-500 text-white px-4 py-2 rounded">Assign User To Subject</button>
                                </th>
                                <th class="px-4 py-2">
                                    <a href="{{ route('enrollments') }}" class="bg-indigo-500 text-white px-4 py-2 rounded">Set Marks</a>
                                </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="text-center mb-8">
                        <p class="mt-3 text-xl font-semibold text-indigo-800">Students List:</p>
                    </div>
                    <div class="container mx-auto mb-8 pb-3">
                        <table class="table table-auto border-collapse border border-gray-400 mx-auto">
                            <thead>
                            <tr class="bg-indigo-200">
                                <th class="border border-gray-400 px-4 py-2 text-center">Name</th>
                                <th class="border border-gray-400 px-4 py-2 text-center">E-Mail</th>
                                <th class="border border-gray-400 px-4 py-2 text-center">Status</th>
                                <th class="border border-gray-400 px-4 py-2 text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td class="border border-gray-400 px-4 py-2 text-center">{{ $student->name }}</td>
                                    <td class="border border-gray-400 px-4 py-2 text-center">{{ $student->email }}</td>
                                    <td class="border border-gray-400 px-4 py-2 text-center">{{ ($student->active) ? "Active" : "Inactive"}}</td>
                                    <td class="border border-gray-400 px-4 py-2 text-center">
                                        <a href="/user/edit/{{$student->id}}" class="text-indigo-600 hover:underline mr-1">Edit</a>
                                        <a href="/user/delete/{{$student->id}}" onclick="return confirm('Are you sure you want to delete this user?');" class="text-indigo-600 hover:underline ml-4">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center mt-5">
                        <p class="text-red-500">There are no students yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>




    <div id="enrollmentModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center">
        <div class="bg-white p-6 rounded-md shadow-md">
            <form id="enrollmentForm" method="POST" action="{{ route('enroll') }}" class="needs-validation" novalidate onsubmit="event.preventDefault(); saveEnrollData();">
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
                                @foreach($students as $user)
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
            <button onclick="closeEnrollmentModal()" class="absolute top-0 right-0 mt-2 mr-2 text-gray-600 cursor-pointer">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>





    <div id="addSubjectModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center">
        <div class="bg-white p-6 rounded-md shadow-md">
            <form id="subjectForm" method="POST" action="{{ route('addSubject') }}" class="max-w-md mx-auto mt-8" novalidate onsubmit="event.preventDefault(); saveSubjectData();">
                @csrf
                <!-- Your existing form content goes here -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="pass_mark" :value="__('Pass Mark')" />
                    <x-text-input id="pass_mark" class="block mt-1 w-full" type="text" name="pass_mark" :value="old('pass_mark')" required autocomplete="pass_mark" />
                    <x-input-error :messages="$errors->get('pass_mark')" class="mt-2" />
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded">Add Subject</button>
                </div>
            </form>
            <button onclick="closeSubjectModal()" class="absolute top-0 right-0 mt-2 mr-2 text-gray-600 cursor-pointer">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <script>
        function openEnrollmentModal() {
            document.getElementById('enrollmentModal').classList.remove('hidden');
        }

        function closeEnrollmentModal() {
            document.getElementById('enrollmentModal').classList.add('hidden');
        }

        function saveEnrollData() {
            var formData = $('#enrollmentForm').serialize();

            $.ajax({
                type: 'POST',
                url: '{{ route('enroll') }}',
                data: formData,
                success: function (data) {
                    console.log(data);
                    closeEnrollmentModal();
                    if (data.success) {
                        alert('Enrollment successful!');
                    } else {
                        alert('An error occurred: ' + data.message);
                    }
                },
                error: function (error) {

                    console.error(error);
                    alert('An error occurred. Please try again.');
                }
            });
        }


        function openSubjectModal() {
            document.getElementById('addSubjectModal').classList.remove('hidden');
        }

        function closeSubjectModal() {
            document.getElementById('addSubjectModal').classList.add('hidden');
        }

        function saveSubjectData() {
            var formData = $('#subjectForm').serialize();

            $.ajax({
                type: 'POST',
                url: '{{ route('addSubject') }}',
                data: formData,
                success: function (data) {
                    console.log(data);
                    closeSubjectModal();
                    if (data.success) {
                        alert('Subject has been added successfully!');
                    } else {
                        alert('An error occurred: ' + data.message);
                    }
                },
                error: function (error) {

                    console.error(error);
                    alert('An error occurred. Please try again.');
                }
            });
        }

    </script>
</x-app-layout>
