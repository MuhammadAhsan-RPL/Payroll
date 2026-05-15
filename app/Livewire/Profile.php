<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $address;

    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public $profile_photo;
    public $existing_photo;

    public $showPasswordForm = false;

    public function mount()
    {
        $user = Auth::user();

        $this->name = $user->name ?? '';
        $this->email = $user->email ?? '';
        $this->phone = $user->phone ?? '';
        $this->address = $user->address ?? '';

        // FOTO PROFILE
        $this->existing_photo = $user->profile_photo
            ? asset('storage/profile/' . $user->profile_photo)
            : 'https://ui-avatars.com/api/?name=' .
                urlencode($user->name) .
                '&background=E0E7FF&color=7F9CF5';
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();

        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->address = $this->address;

        // UPLOAD FOTO
        if ($this->profile_photo) {

            // hapus foto lama
            if (
                $user->profile_photo &&
                Storage::disk('public')->exists('profile/' . $user->profile_photo)
            ) {
                Storage::disk('public')->delete('profile/' . $user->profile_photo);
            }

            // nama file baru
            $filename = time() . '_' . $this->profile_photo->getClientOriginalName();

            // simpan file
            $this->profile_photo->storeAs(
                'profile',
                $filename,
                'public'
            );

            // simpan ke database
            $user->profile_photo = $filename;

            // refresh preview
            $this->existing_photo = asset('storage/profile/' . $filename);
        }

        $user->save();

        // reset input file
        $this->profile_photo = null;

        session()->flash('message', 'Profile berhasil diupdate!');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {

            $this->addError(
                'current_password',
                'Password saat ini salah!'
            );

            return;
        }

        $user->password = Hash::make($this->new_password);

        $user->save();

        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';

        $this->showPasswordForm = false;

        session()->flash('message', 'Password berhasil diubah!');
    }

    public function deletePhoto()
    {
        $user = Auth::user();

        if ($user->profile_photo) {

            Storage::disk('public')->delete(
                'profile/' . $user->profile_photo
            );

            $user->profile_photo = null;

            $user->save();
        }

        $this->existing_photo =
            'https://ui-avatars.com/api/?name=' .
            urlencode($user->name) .
            '&background=E0E7FF&color=7F9CF5';

        session()->flash(
            'message',
            'Foto profile berhasil dihapus!'
        );
    }

    public function render()
    {
        return view('livewire.profile')
            ->layout('layouts.app');
    }
}