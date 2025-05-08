<?php

namespace App\Livewire\Pages;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class UploadRules extends Component
{
    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('livewire.pages.upload-rules')->layout('components.layouts.app.page');
    }
}
