<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Employee;
use App\Models\User;
use App\Models\Position;
use App\Models\Payroll;
use App\Models\Attendance;
use Carbon\Carbon;

class Index extends Component
{
    public $selectedDate;
    public $selectedMonth;

    public function mount()
    {
        $this->selectedDate = Carbon::now()->toDateString();
        $this->selectedMonth = Carbon::now()->month;
    }

    public function render()
    {
        // ========== STATISTIK UTAMA ==========
        $totalEmployees = Employee::count();
        $totalUsers = User::count();
        $totalPositions = Position::count();

        // Payroll BULAN INI
        $totalPayrollThisMonth = Payroll::whereMonth('period', Carbon::now()->month)
            ->whereYear('period', Carbon::now()->year)
            ->sum('net_salary');

        // Payroll BULAN LALU
        $totalPayrollLastMonth = Payroll::whereMonth('period', Carbon::now()->subMonth()->month)
            ->whereYear('period', Carbon::now()->subMonth()->year)
            ->sum('net_salary');

        // Persentase perubahan
        $payrollChange = 0;
        if ($totalPayrollLastMonth > 0) {
            $payrollChange = (($totalPayrollThisMonth - $totalPayrollLastMonth) / $totalPayrollLastMonth) * 100;
        }

        // Gaji rata-rata
        $averageSalary = Employee::avg('salary') ?? 0;

        // ========== GRAFIK PAYROLL ==========
        $payrollMonths = [];
        $payrollData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $payrollMonths[] = $date->format('M Y');

            $total = Payroll::whereMonth('period', $date->month)
                ->whereYear('period', $date->year)
                ->sum('net_salary');
            $payrollData[] = $total;
        }

        // ========== DATA ATTENDANCE (HANYA HADIR & TIDAK HADIR) ==========
        $todayStats = [
            'present' => Attendance::whereDate('date', Carbon::today())->where('status', 'present')->count(),
            'absent' => Attendance::whereDate('date', Carbon::today())->where('status', 'absent')->count(),
        ];

        $totalEmployeesCount = Employee::count();

        // Attendance per bulan (hanya hadir & tidak hadir)
        $monthlyAttendance = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyAttendance[$i] = [
                'present' => Attendance::whereMonth('date', $i)->whereYear('date', Carbon::now()->year)->where('status', 'present')->count(),
                'absent' => Attendance::whereMonth('date', $i)->whereYear('date', Carbon::now()->year)->where('status', 'absent')->count(),
            ];
        }

        // Detail attendance per karyawan
        $allEmployees = Employee::with('user')->get();
        $todayAttendanceDetail = [];
        foreach ($allEmployees as $employee) {
            $attendance = Attendance::where('user_id', $employee->user_id)
                ->whereDate('date', $this->selectedDate)
                ->first();

            $todayAttendanceDetail[] = (object) [
                'id' => $employee->id,
                'name' => $employee->user->name ?? 'N/A',
                'status' => $attendance->status ?? 'absent',
            ];
        }

        // ========== DATA TERBARU ==========
        $recentEmployees = Employee::with(['user', 'position'])
            ->latest()
            ->take(5)
            ->get();

        $recentPayrolls = Payroll::with('employee.user')
            ->latest()
            ->take(5)
            ->get();

        // Position Stats
        $allPositions = Position::all();
        $positionStats = [];
        foreach ($allPositions as $position) {
            $positionStats[] = (object) [
                'name' => $position->name,
                'employees_count' => Employee::where('position_id', $position->id)->count()
            ];
        }

        // User Role Stats
        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'user')->count();

        return view('livewire.admin.index', compact(
            'totalEmployees',
            'totalUsers',
            'totalPositions',
            'totalPayrollThisMonth',
            'totalPayrollLastMonth',
            'payrollChange',
            'averageSalary',
            'payrollMonths',
            'payrollData',
            'recentEmployees',
            'recentPayrolls',
            'positionStats',
            'adminCount',
            'userCount',
            'todayStats',
            'totalEmployeesCount',
            'monthlyAttendance',
            'todayAttendanceDetail',
        ));
    }
}
