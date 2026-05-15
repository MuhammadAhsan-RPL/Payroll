<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;

class AttendanceManagement extends Component
{
    use WithPagination;

    public $selectedDate;
    public $selectedStatus = '';
    public $search = '';
    public $editId = null;
    public $editStatus = '';
    
    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->selectedDate = Carbon::now()->toDateString();
    }

    public function render()
    {
        $attendances = Attendance::with('user')
            ->when($this->selectedDate, function($query) {
                $query->whereDate('date', $this->selectedDate);
            })
            ->when($this->selectedStatus, function($query) {
                $query->where('status', $this->selectedStatus);
            })
            ->when($this->search, function($query) {
                $query->whereHas('user', function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('date', 'desc')
            ->paginate(15);

        $allEmployees = Employee::with('user')->get();
        
        $stats = [
            'present' => Attendance::whereDate('date', $this->selectedDate)->where('status', 'present')->count(),
            'absent' => Attendance::whereDate('date', $this->selectedDate)->where('status', 'absent')->count(),
            'sick' => Attendance::whereDate('date', $this->selectedDate)->where('status', 'sick')->count(),
            'permit' => Attendance::whereDate('date', $this->selectedDate)->where('status', 'permit')->count(),
        ];
        
        $totalEmployees = Employee::count();

        return view('livewire.admin.attendance-management', [
            'attendances' => $attendances,
            'stats' => $stats,
            'totalEmployees' => $totalEmployees,
            'allEmployees' => $allEmployees,
        ]);
    }

    // 🔥 METHOD EDIT (untuk memulai edit)
    public function edit($id)
    {
        $attendance = Attendance::find($id);
        if ($attendance) {
            $this->editId = $id;
            $this->editStatus = $attendance->status;
        }
    }

    // 🔥 METHOD UPDATE (untuk menyimpan edit)
    public function update()
    {
        $attendance = Attendance::find($this->editId);
        if ($attendance) {
            $attendance->update([
                'status' => $this->editStatus
            ]);
            session()->flash('message', 'Status attendance berhasil diupdate!');
        }
        
        // 🔥 JANGAN LUPA RESET editId
        $this->cancel();
    }

    // 🔥 METHOD CANCEL (untuk membatalkan edit)
    public function cancel()
    {
        $this->editId = null;
        $this->editStatus = '';
    }

    // 🔥 METHOD DELETE
    public function delete($id)
    {
        $attendance = Attendance::find($id);
        if ($attendance) {
            $attendance->delete();
            session()->flash('message', 'Data attendance berhasil dihapus!');
        }
    }

    public function createAttendance($userId)
    {
        $exists = Attendance::where('user_id', $userId)
            ->whereDate('date', $this->selectedDate)
            ->exists();
        
        if (!$exists) {
            Attendance::create([
                'user_id' => $userId,
                'date' => $this->selectedDate,
                'status' => 'present'
            ]);
            session()->flash('message', 'Attendance berhasil ditambahkan!');
        } else {
            session()->flash('error', 'Attendance untuk karyawan ini sudah ada!');
        }
    }

    public function resetFilters()
    {
        $this->selectedStatus = '';
        $this->search = '';
        $this->selectedDate = Carbon::now()->toDateString();
    }
}