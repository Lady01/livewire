<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;


class UploadPhoto extends Component
{
    use WithFileUploads;

    public $photo;

    public function render()
    {
        return view('livewire.user.upload-photo');
    }
    public function storagePhoto(){
        $this->validate([
            'photo'=> 'required|image|max:1024'
        ]);

        $user = auth()->user();
        //Monta o nome do arquivo
        $nameFile = Str::Slug($user->name). '.' .$this->photo->getClientOriginalExtension();
        
        //Se retornar o path, o upload foi feito
        if($path = $this->photo->storeAs('users', $nameFile)){
            $user->update([
                'profile_photo_path'=>$path
            ]);
            return redirect()->route('tweets.index');
        }
    } 
}
