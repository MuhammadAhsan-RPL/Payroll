<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1
                class="text-3xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Dashboard Overview
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Welcome back,
                <span class="font-semibold text-slate-700">
                    {{ Auth::user()->name }}
                </span>
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 px-4 py-3 shadow-sm">
            <p class="text-xs text-slate-400">Today</p>
            <p class="font-bold text-slate-700">
                {{ now()->format('d F Y') }}
            </p>
        </div>
    </div>

    {{-- STATISTICS CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        {{-- Total Employees --}}
        <div class="bg-white border border-slate-100 rounded-3xl p-5 shadow-sm hover:shadow-lg transition duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-400 font-medium">Total Employees</p>
                    <h2 class="text-4xl font-black text-slate-800 mt-2">{{ number_format($totalEmployees) }}</h2>
                    <p class="text-xs text-emerald-600 mt-2">Active employees</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center text-2xl">
                    👨‍💼
                </div>
            </div>
        </div>

        {{-- System Users --}}
        <div class="bg-white border border-slate-100 rounded-3xl p-5 shadow-sm hover:shadow-lg transition duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-400 font-medium">System Users</p>
                    <h2 class="text-4xl font-black text-slate-800 mt-2">{{ number_format($totalUsers) }}</h2>
                    <div class="flex gap-2 mt-2 text-xs">
                        <span class="text-indigo-600">Admin: {{ $adminCount }}</span>
                        <span class="text-slate-500">User: {{ $userCount }}</span>
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center text-2xl">
                    👥
                </div>
            </div>
        </div>

        {{-- Total Positions --}}
        <div class="bg-white border border-slate-100 rounded-3xl p-5 shadow-sm hover:shadow-lg transition duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-400 font-medium">Total Positions</p>
                    <h2 class="text-4xl font-black text-slate-800 mt-2">{{ number_format($totalPositions) }}</h2>
                    <p class="text-xs text-slate-500 mt-2">Available positions</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-amber-100 flex items-center justify-center text-2xl">
                    📋
                </div>
            </div>
        </div>

        {{-- Payroll This Month --}}
        <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition duration-300">
            <div class="flex items-center justify-between gap-2">
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-slate-400 font-medium">Payroll This Month</p>
                    <h2 class="text-lg sm:text-xl md:text-2xl font-black text-emerald-600 mt-1 break-words">
                        ${{ number_format($totalPayrollThisMonth, 0) }}
                    </h2>
                    <p class="text-xs text-slate-400 mt-1">
                        {{ $payrollChange >= 0 ? '↑' : '↓' }} {{ number_format(abs($payrollChange), 1) }}% from last month
                    </p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-base sm:text-lg shrink-0">
                    💰
                </div>
            </div>
        </div>
    </div>

    {{-- EXTRA STATS --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
            <p class="text-sm text-slate-400">Average Salary</p>
            <h2 class="text-4xl font-black text-indigo-600 mt-2">${{ number_format($averageSalary, 0) }}</h2>
            <p class="text-xs text-slate-500 mt-2">Average employee salary per month</p>
        </div>
        <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
            <p class="text-sm text-slate-400">Estimated Yearly Payroll</p>
            <h2 class="text-4xl font-black text-purple-600 mt-2">${{ number_format($totalPayrollThisMonth * 12, 0) }}</h2>
            <p class="text-xs text-slate-500 mt-2">Estimated annual payroll cost</p>
        </div>
    </div>

    {{-- CHART SECTION --}}
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
        <div class="mb-5">
            <h2 class="text-lg font-bold text-slate-800">Payroll Analytics</h2>
            <p class="text-sm text-slate-400">Payroll trends over the last 12 months</p>
        </div>
        <canvas id="payrollChart" height="100"></canvas>
    </div>

    {{-- ==================== ATTENDANCE SECTION (TAMBAHAN) ==================== --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-lg font-bold text-slate-800">📊 Attendance Overview</h2>
                    <p class="text-sm text-slate-400">Today's attendance report - {{ now()->format('d F Y') }}</p>
                </div>
                <div>
                    <input type="date" wire:model.live="selectedDate" 
                        class="rounded-xl border-slate-200 bg-slate-50 px-4 py-2 text-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20">
                </div>
            </div>
        </div>
        
        {{-- Attendance Stats Cards (Hanya 2: Hadir & Tidak Hadir) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-5">
            <div class="text-center p-4 rounded-xl bg-emerald-50">
                <div class="text-3xl font-black text-emerald-600">{{ $todayStats['present'] }}</div>
                <div class="text-sm font-semibold text-emerald-700 mt-1">✅ Hadir</div>
                <div class="text-xs text-emerald-500 mt-1">{{ $totalEmployeesCount > 0 ? round(($todayStats['present'] / $totalEmployeesCount) * 100) : 0 }}% dari total karyawan</div>
            </div>
            <div class="text-center p-4 rounded-xl bg-rose-50">
                <div class="text-3xl font-black text-rose-600">{{ $todayStats['absent'] }}</div>
                <div class="text-sm font-semibold text-rose-700 mt-1">❌ Tidak Hadir</div>
                <div class="text-xs text-rose-500 mt-1">{{ $totalEmployeesCount > 0 ? round(($todayStats['absent'] / $totalEmployeesCount) * 100) : 0 }}% dari total karyawan</div>
            </div>
        </div>
        
        {{-- Attendance Chart (Bar Chart: Hadir vs Tidak Hadir per Bulan) --}}
        <div class="p-5 border-t border-slate-100">
            <h3 class="font-semibold text-slate-700 mb-3">Monthly Attendance Trend ({{ now()->year }})</h3>
            <canvas id="attendanceChart" height="80"></canvas>
        </div>
        
        {{-- Attendance Detail Table --}}
        <div class="p-5 border-t border-slate-100">
            <h3 class="font-semibold text-slate-700 mb-3">Employee Attendance Detail - {{ \Carbon\Carbon::parse($selectedDate)->format('d F Y') }}</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500">#</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500">Employee/User Name</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($todayAttendanceDetail as $index => $detail)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 text-slate-500">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 font-medium text-slate-800">{{ $detail->name }}</td>
                                <td class="px-4 py-3">
                                    @if($detail->status == 'present')
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold bg-emerald-100 text-emerald-700">
                                            ✅ Hadir
                                        </span>
                                    @else
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold bg-rose-100 text-rose-700">
                                            ❌ Tidak Hadir
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-8 text-center text-slate-400">No attendance data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- RECENT TABLES --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        {{-- Recent Employees --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex justify-between items-center">
                <h2 class="font-bold text-slate-800">Recent Employees</h2>
                <a href="/employee" class="text-xs text-indigo-600 hover:text-indigo-700">View all →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left px-5 py-3 text-xs text-slate-500">Employee</th>
                            <th class="text-left px-5 py-3 text-xs text-slate-500">Position</th>
                            <th class="text-left px-5 py-3 text-xs text-slate-500">Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentEmployees as $employee)
                            <tr class="border-t border-slate-100 hover:bg-slate-50">
                                <td class="px-5 py-4">{{ $employee->user->name ?? '-' }}</td>
                                <td class="px-5 py-4">{{ $employee->position->name ?? '-' }}</td>
                                <td class="px-5 py-4 font-semibold text-emerald-600">${{ number_format($employee->salary, 0) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-8 text-slate-400">No employee data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Recent Payroll --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex justify-between items-center">
                <h2 class="font-bold text-slate-800">Recent Payroll</h2>
                <a href="/payroll" class="text-xs text-indigo-600 hover:text-indigo-700">View all →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left px-5 py-3 text-xs text-slate-500">Employee</th>
                            <th class="text-left px-5 py-3 text-xs text-slate-500">Period</th>
                            <th class="text-left px-5 py-3 text-xs text-slate-500">Net Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPayrolls as $payroll)
                            <tr class="border-t border-slate-100 hover:bg-slate-50">
                                <td class="px-5 py-4">{{ $payroll->employee->user->name ?? '-' }}</td>
                                <td class="px-5 py-4">{{ $payroll->period }}</td>
                                <td class="px-5 py-4 font-semibold text-emerald-600">${{ number_format($payroll->net_salary, 0) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-8 text-slate-400">No payroll data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- POSITION DISTRIBUTION --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100">
            <h2 class="font-bold text-slate-800">Employees by Position</h2>
            <p class="text-xs text-slate-400 mt-1">Distribution across departments</p>
        </div>
        <div class="p-5">
            <div class="flex flex-wrap gap-3">
                @forelse($positionStats as $position)
                    <div class="inline-flex items-center gap-2 px-3 py-2 rounded-full bg-slate-100">
                        <span class="text-sm font-medium text-slate-700">{{ $position->name }}</span>
                        <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full">{{ $position->employees_count }}</span>
                    </div>
                @empty
                    <p class="text-sm text-slate-400">No position data available</p>
                @endforelse
            </div>
        </div>
    </div>

</div>

{{-- CHART JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:init', function() {
        // Payroll Chart
        var payrollCanvas = document.getElementById('payrollChart');
        if (payrollCanvas) {
            new Chart(payrollCanvas, {
                type: 'line',
                data: {
                    labels: @json($payrollMonths),
                    datasets: [{
                        label: 'Payroll (USD)',
                        data: @json($payrollData),
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99,102,241,0.1)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#6366f1',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: { position: 'top' },
                        tooltip: { callbacks: { label: function(ctx) { return '$' + ctx.raw.toLocaleString(); } } }
                    },
                    scales: { y: { beginAtZero: true, ticks: { callback: function(val) { return '$' + val.toLocaleString(); } } } }
                }
            });
        }

        // Attendance Chart (Bar Chart: Hadir vs Tidak Hadir)
        var attendanceCanvas = document.getElementById('attendanceChart');
        if (attendanceCanvas) {
            new Chart(attendanceCanvas, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [
                        {
                            label: 'Hadir',
                            data: [@foreach(range(1,12) as $m) {{ $monthlyAttendance[$m]['present'] }}, @endforeach],
                            backgroundColor: '#10b981',
                            borderRadius: 8
                        },
                        {
                            label: 'Tidak Hadir',
                            data: [@foreach(range(1,12) as $m) {{ $monthlyAttendance[$m]['absent'] }}, @endforeach],
                            backgroundColor: '#ef4444',
                            borderRadius: 8
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: { legend: { position: 'bottom' } },
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                }
            });
        }
    });
</script>