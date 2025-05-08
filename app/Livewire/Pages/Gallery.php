<?php

namespace App\Livewire\Pages;

use App\Livewire\Forms\AddPostForm;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Gallery extends Component
{
    use WithPagination, WithFileUploads;

    public AddPostForm $addPostForm;
    #[Url(as: 'q', except: '')]
    public $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function addPost(): void
    {
        if ($this->addPostForm->store())
            $this->redirect('/');
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        $search = preg_replace('/\s+/', '%', $this->search);

        return view('livewire.pages.gallery', [
            'posts' => Post::whereRaw("title || content LIKE ?", ["%$search%"])
                ->paginate(18),
        ])->layout('components.layouts.app.page');
    }
}
