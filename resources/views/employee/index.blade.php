<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.employees') }}
        </h2>
    </x-slot>

    <script>
        $(document).ready(function() {
            $('#employeesTable').DataTable();
        });
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h2 class="font-bold text-xl">
                            <a href="{{ route('employee.create') }}">{{ __('messages.add_new_employee') }}</a>
                        </h2>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <table id="employeesTable" class="display">
                        <thead>
                            <tr>
                                <th>{{ __('messages.firstname') }}</th>
                                <th>{{ __('messages.lastname') }}</th>
                                <th>{{ __('messages.company') }}</th>
                                <th>{{ __('messages.email') }}</th>
                                <th>{{ __('messages.phone') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->firstname }}</td>
                                    <td>{{ $employee->lastname }}</td>
                                    <td>
                                        <a href="{{ route('company.show', ['company' => $employee->company_id, 'lang' => app()->getLocale()]) }}"
                                            class="text-blue-500 hover:underline">
                                            {{ $employee->company->name }}
                                        </a>
                                    </td>
                                    <td><a href="mailto:{{ $employee->email }}"
                                            class="text-blue-500 hover:underline">{{ $employee->email }}</a></td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>
                                        <div class="inline-block mr-1">
                                            <a href="{{ route('employee.edit', ['employee' => $employee, 'lang' => app()->getLocale()]) }}"
                                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                {{ __('messages.edit') }}
                                            </a>
                                        </div>
                                        <div class="inline-block">
                                            <form
                                                action="{{ route('employee.destroy', ['employee' => $employee, 'lang' => app()->getLocale()]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button>{{ __('messages.delete') }}</x-danger-button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
