<?php

namespace App\Livewire\Admin;

use App\Models\Payroll as ModelsPayroll;
use App\Models\Employee as ModelsEmployee;
use Livewire\Component;

class Payroll extends Component
{
    public $editCheck = false;
    public $idEdit;
    public $employee_id;
    public $period;
    public $allowance;
    public $deduction;
    public $keyword;

    public function render()
    {
        $employees = ModelsEmployee::with('user')->get();
        
        $payrolls = ModelsPayroll::with('employee.user')
            ->whereHas('employee.user', function($query) {
                $query->where('name', 'like', '%' . $this->keyword . '%');
            })
            ->get();

        return view('livewire.admin.payroll', compact('payrolls', 'employees'));
    }

    public function store(){
        $validate = $this->validate([
            'employee_id'=>'required',
            'period'=>'required',
            'allowance'=>'required',
            'deduction'=>'required',
        ]);
    
        $employee = ModelsEmployee::find($this->employee_id);
        ModelsPayroll::create([
            'employee_id'=>$this->employee_id,
            'period'=>$this->period,
            'allowance'=>$this->allowance,
            'deduction'=>$this->deduction,
            'net_salary'=> $employee->salary + $this->allowance - $this->deduction,
        ]);
        session()->flash('message','berhasil menambahkan data');
        $this->clear();
    }

    public function destroy($id){
        $payroll = ModelsPayroll::find($id);
        $payroll->delete();
        session()->flash('message','berhasil menghapus data');
    }

    public function edit($id){
        $payroll = ModelsPayroll::find($id);
        $this->idEdit = $id;
        $this->employee_id = $payroll->employee_id;
        $this->allowance = $payroll->allowance;
        $this->deduction = $payroll->deduction;
        $this->period = $payroll->period;
        $this->editCheck = true;
    }

    public function clear(){
        $this->idEdit = '';
        $this->employee_id = '';
        $this->allowance = '';
        $this->deduction ='';
        $this->period = '';
        $this->editCheck = false;
    }

    public function update($id){
        $payroll = ModelsPayroll::find($id);

        $this->validate([
        'employee_id'=>'required',
        'period'=>'required',
        'allowance'=>'required',
        'deduction'=>'required',
    ]);

    $employee = ModelsEmployee::find($this->employee_id);
    $payroll->update([
        'employee_id'=>$this->employee_id,
        'period'=>$this->period,
        'allowance'=>$this->allowance,
        'deduction'=>$this->deduction,
        'net_salary'=>$employee->salary + $this->allowance - $this->deduction,
    ]);
    session()->flash('message','berhasil mengubah data');
    $this->clear();
    
}
}
