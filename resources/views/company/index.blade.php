<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.companies') }}
        </h2>
    </x-slot>

    <script>
        $(document).ready(function() {
            $('#companyTable').DataTable();
        });
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h2 class="font-bold text-xl">
                            <a href="{{ route('company.create') }}">{{ __('messages.add_new_company') }}</a>
                        </h2>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <table id="companyTable" class="display">
                        <thead>
                            <tr>
                                <th>{{ __('messages.company_name') }}</th>
                                <th>{{ __('messages.email') }}</th>
                                <th>{{ __('messages.logo') }}</th>
                                <th>{{ __('messages.website') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td><img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}"
                                            class="w-16 h-16 object-cover"></td>
                                    <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                                    </td>
                                    <td>
                                        <div class="inline-block mr-1">
                                            <a href="{{ route('company.show', ['company' => $company]) }}"
                                                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                {{ __('messages.view') }}
                                            </a>
                                        </div>
                                        <div class="inline-block mr-1">
                                            <a href="{{ route('company.edit', ['company' => $company]) }}"
                                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                {{ __('messages.edit') }}
                                            </a>
                                        </div>
                                        <div class="inline-block">
                                            <form action="{{ route('company.destroy', ['company' => $company]) }}"
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
