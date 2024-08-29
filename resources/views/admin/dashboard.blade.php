<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 grid grid-cols-1 md:grid-cols-2 space-x-5">
                    <div>
                        <!-- Chart for Number of Companies -->
                        <h3 class="text-lg font-semibold">Number of Companies</h3>
                        <canvas id="companyChart"></canvas>
                    </div>
                    <div>
                        <!-- Chart for Number of Employees -->
                        <h3 class="text-lg font-semibold">Number of Employees</h3>
                        <canvas id="employeeChart"></canvas>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script>
        // Chart for Number of Companies
        var ctxCompany = document.getElementById('companyChart').getContext('2d');
        new Chart(ctxCompany, {
            type: 'bar',
            data: {
                labels: ['Companies'],
                datasets: [{
                    label: "Company's Count",
                    data: [@json($companyCount)],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Chart for Number of Employees
        var ctxEmployee = document.getElementById('employeeChart').getContext('2d');
        new Chart(ctxEmployee, {
            type: 'bar',
            data: {
                labels: ['Employees'],
                datasets: [{
                    label: "Employee's Count",
                    data: [@json($employeeCount)],
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
