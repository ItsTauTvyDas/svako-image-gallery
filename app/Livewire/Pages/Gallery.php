<?php

namespace App\Livewire\Pages;

use App\Livewire\Forms\AddPostForm;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Gallery extends Component
{
    use WithPagination, WithFileUploads;

    public AddPostForm $addPostForm;

    public $search = '';

    protected $listeners = [
        'UpdateGallery' => '$refresh'
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function addPost(): void
    {
        $this->addPostForm->store();
        $this->dispatch('UpdateGallery');
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('livewire.pages.gallery', [
            'posts' => Post::where('title', 'like', '%'.$this->search.'%')
                ->where('content', 'like', '%'.$this->search.'%')
                ->paginate(18),
        ])->layout('components.layouts.app.page');
    }
}
