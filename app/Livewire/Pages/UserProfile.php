<?php /** @noinspection DuplicatedCode */

namespace App\Livewire\Pages;

use App\Models\User;
use App\Traits\AuthOnlyComponentAction;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class UserProfile extends Component
{
    use AuthOnlyComponentAction;

    public ?User $user;
    public bool $isFollowing = false;

    public function mount(int $id): void
    {
        $this->user = User::find($id);
        if ($this->user == null)
            abort(404);
        if (auth()->check())
            $this->isFollowing = auth()->user()->isFollowing($this->user);
    }

    public function follow(): void
    {
        $loggedInUser = auth()->user();
        if ($loggedInUser->id === $this->user->id)
            return;
        if (!$loggedInUser->isFollowing($this->user)) {
            $loggedInUser->following()->create([
                'followed_user_id' => $this->user->id,
                'created_at' => now()
            ]);
            $this->isFollowing = true;
        }
    }

    public function unfollow(): void
    {
        $loggedInUser = auth()->user();
        $loggedInUser->following()
                     ->where('followed_user_id', $this->user->id)
                     ->delete();
        $this->isFollowing = false;
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('livewire.pages.user-profile')->layout('components.layouts.app.page');
    }
}
