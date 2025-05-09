<?php /** @noinspection DuplicatedCode */

namespace App\Livewire\Pages;

use App\Livewire\Forms\CommentForm;
use App\Livewire\Forms\EditPostForm;
use App\Models\Comment;
use App\Models\Post;
use App\Traits\AuthOnlyComponentAction;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class GalleryPost extends UserProfile
{
    use AuthOnlyComponentAction;

    public ?Post $post;
    public bool $liked = false;

    public EditPostForm $editPostForm;
    public CommentForm $commentForm;
    public CommentForm $editCommentForm;

    // 0 - Post
    // >0 - Comment
    public int $markForDeletionId = -1;

    public function mount(int $id): void
    {
        $this->post = Post::find($id);
        if ($this->post == null)
            abort(404);
        $this->user = $this->post->author();
        $this->editPostForm->fill($this->post->only(['title', 'content']));
        if (auth()->check())
            $this->liked = auth()->user()->haveLikedPost($this->post);
    }

    public function like(): void
    {
        $loggedInUser = auth()->user();
        if (!$loggedInUser->haveLikedPost($this->post)) {
            $loggedInUser->postLikes()->create([
                'post_id' => $this->post->id
            ]);
            $this->liked = true;
        }
    }

    public function unlike(): void
    {
        $loggedInUser = auth()->user();
        $loggedInUser->postLikes()
                     ->where('post_id', $this->post->id)
                     ->delete();
        $this->liked = false;
    }

    public function editPost(): void
    {
        if (auth()->id() === $this->user->id && $this->editPostForm->update($this->post)) {
            $this->dispatch('bootstrapCloseModal', 'editPostModal');
            $this->commentForm->reset();
            $this->clearErrors();
        }
    }

    public function confirmDeletion(): void
    {
        if (auth()->id() === $this->user->id) {
            if ($this->markForDeletionId == 0) {
                $this->post->delete();
                $this->redirect(route('home'));
            } elseif ($this->markForDeletionId > 0) {
                $comment = Comment::find($this->markForDeletionId);
                $comment->delete();
                $this->markForDeletionId = -1;
                $this->dispatch('bootstrapCloseModal', 'confirmDeleteActionModal');
            }
        }
    }

    public function markForDeletion(int $id): void
    {
        if (auth()->id() === $this->user->id)
            $this->markForDeletionId = $id;
    }

    public function comment(): void
    {
        $this->commentForm->store($this->post);
        $this->commentForm->reset();
        $this->clearErrors();
    }

    public function editComment(): void
    {
        $comment = Comment::find($this->commentId);
        if (auth()->user()->id === $comment->user_id && $this->editCommentForm->update($comment)) {
            $this->dispatch('bootstrapCloseModal', 'editCommentModal');
            $this->commentForm->reset();
            $this->clearErrors();
        }
    }

    public function loadCommentData(string $content, int $id): void
    {
        if (auth()->user()->id === $this->user->id) {
            $this->clearErrors();
            $this->editCommentForm->fill([
                'content'   => $content,
                'commentId' => $id
            ]);
        }
    }

    public function clearErrors(): void
    {
        $this->resetValidation();
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('livewire.pages.gallery-post', [
            'comments' => $this->post->comments()->with('author')->get()->sortByDesc('created_at'),
        ])->layout('components.layouts.app.page');
    }
}
