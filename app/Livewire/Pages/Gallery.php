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
        if ($this->addPostForm->store()) {
            $this->dispatch('bootstrapCloseModal', 'addPostModal');
            $this->clearErrors();
        }
    }

    public function clearErrors(): void
    {
        $this->addPostForm->reset();
        $this->addPostForm->resetValidation();
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        $search = preg_replace('/\s+/', '%', $this->search);

        return view('livewire.pages.gallery', [
            'posts' => Post::withCount(['comments', 'likes'])
                         ->select('posts.*')
                         ->selectRaw("
                             posts.*,
                             (
                               (
                                 (SELECT COUNT(*) FROM post_comments  WHERE post_comments.post_id = posts.id)
                                 +
                                 (SELECT COUNT(*) FROM post_likes     WHERE post_likes.post_id    = posts.id)
                               )
                               /
                               (
                                 (julianday('now') - julianday(created_at)) + 1
                               )
                             ) AS popularity_score
                         ")
                         ->whereRaw("(title || ' ' || content) LIKE ?", ["%$search%"])
                         ->orderByDesc('popularity_score')
                         ->paginate(20),
        ])->layout('components.layouts.app.page');
    }
}
