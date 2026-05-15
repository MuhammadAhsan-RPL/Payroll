<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use App\Models\Attendance as ModelsAttendance;
use Livewire\Component;

class Attendance extends Component
{
    public $status;

    public function save(){
        $this->validate([
            'status' => 'required',
        ]);

    ModelsAttendance::create([
        'user_id' => Auth::user()->id,
        'date' => now()->toDateString(),
        'status' => $this->status,
    ]);
    session()->flash('message', 'Attendance saved successfully.');

    $this->reset('status');
    }

    public function render()
    {
        return view('livewire.user.attendance', [
            'attendances' => ModelsAttendance::with('user')->latest()->get()
        ]);
    }

}
