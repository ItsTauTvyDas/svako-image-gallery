<section class="w-100 px-4 py-5">
    <div class="d-flex justify-content-center">
        <div class="d-flex flex-column col col-md-9 col-lg-7 col-xl-6 gap-3">
            <div class="card rounded-3">
                <div class="card-body p-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="{{ $profilePicture = $user->profileUrl() }}"
                                 alt="{{ __('Profilio nuotrauka') }}"
                                 class="img-fluid rounded-3"
                                 style="width: 180px;">
                            <h5 class="text-center my-3">{{ $user->name }}</h5>
                            <div class="d-flex flex-column gap-2">
                                <a class="btn btn-secondary" href="{{ route('profile', ['id' => $user->id]) }}">{{ __('Peržiūrėti profilį') }}</a>
                                <hr class="my-1">
                                @if(!auth()->check())
                                    <div title="{{ __('Turite būti prisijungęs prie sistemos norint palikti patiktuką!') }}">
                                        <button class="btn flex-grow-1" disabled>
                                            <flux:icon.hand-thumb-up class="d-inline"/> {{ $post->likeCount() }}
                                        </button>
                                    </div>
                                @elseif($liked)
                                    <button class="btn btn-success flex-grow-1" wire:click="unlike">
                                        <flux:icon.hand-thumb-up class="d-inline"/> {{ $post->likeCount() }}
                                    </button>
                                @else
                                    <button class="btn btn-outline-success flex-grow-1" wire:click="like">
                                        <flux:icon.hand-thumb-up class="d-inline"/> {{ $post->likeCount() }}
                                    </button>
                                @endif
                                <x-layouts.app.user.follow-button
                                    class="flex-grow-1"
                                    buttonClass="w-100"
                                    :isFollowing="$isFollowing"
                                    :user="$user"
                                    wire:click="{{ $isFollowing ? 'unfollow' : 'follow' }}"/>
                                @if(auth()->id() === $user->id)
                                    <hr class="my-1">
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editPostModal">
                                        {{ __('Redaguoti nuotrauką') }}
                                    </button>
                                    <button class="btn btn-outline-danger flex-grow-1" data-bs-toggle="modal" data-bs-target="#confirmDeleteActionModal"
                                            wire:click="markForDeletion(0)">
                                        {{ __('Ištrinti') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3 relative">
                            <a href="{{ $postImage = asset('storage/' . $post->image_url) }}" target="_blank" class="d-flex justify-content-between mb-3">
                                <img src="{{ $postImage }}"
                                     alt="{{ __('Nuotrauka') }}"
                                     class="w-100 h-100 rounded-3">
                            </a>
                            <div>
                                <h4>{{ $post->title }}</h4>
                                @if($post->content)
                                    <p class="whitespace-nowrap">{!! nl2br(htmlspecialchars($post->content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) !!}</p>
                                @else
                                    <small><em>{{ __('Aprašymo nėra.') }}</em></small>
                                @endif
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="m-0">{{ __('Nuotrauka atnaujinta') }}</p>
                                    <p class="m-0">{{ __('Nuotrauka įkelta') }}</p>
                                </div>
                                <div>
                                    <p class="m-0">{{ $post->updated_at }}</p>
                                    <p class="m-0">{{ $post->created_at }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card rounded-3">
                <div class="card-header">
                    <h3>{{ __('Komentuoti') }} ({{ $commentCount = $comments->count() }})</h3>
                </div>
                <div class="card-body p-4">
                    <form wire:submit="comment">
                        <div class="mb-3">
                            <label for="commentText" class="form-label">{{ __('Komentaras') }}</label>
                            <textarea minlength="4" maxlength="250"
                                      style="min-height: 100px; max-height: 250px;"
                                      wire:model="commentForm.content"
                                      class="form-control" id="commentText"></textarea>
                            @error('commentForm.content')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Komentuoti') }}</button>
                        <hr>
                        @if($commentCount == 0)
                            <smal><em>{{ __('Nieko nėra.') }}</em></smal>
                        @else
                            <div class="d-flex flex-column gap-2">
                                @foreach($comments as $comment)
                                    <div class="card card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between justify-items-center">
                                            <div class="d-inline-flex gap-1">
                                                <a target="_blank" href="{{ route('profile', ['id' => $comment->author->id]) }}">
                                                    <h5>{{ $comment->author->name }}</h5>
                                                </a>
                                                @if($comment->created_at == $comment->updated_at)
                                                    <span>({{ $comment->created_at }})</span>
                                                @else
                                                    <span>({{ $comment->created_at . __(', redaguota: ') . $comment->updated_at }})</span>
                                                @endif
                                            </div>
                                            <div class="d-inline-flex gap-2">
                                                @if($comment->author->id == auth()->id())
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#editCommentModal"
                                                    wire:click="loadCommentData(@js($comment->content), {{ $comment->id }})">
                                                        {{ __('Redaguoti') }}
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteActionModal"
                                                            wire:click="markForDeletion({{ $comment->id }})">
                                                        {{ __('Trinti') }}
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                        <span>{!! nl2br(htmlspecialchars($comment->content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) !!}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit="editComment">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editCommentModalLabel">{{ __('Redaguoti komentarą') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="commentContent" class="form-label">{{ __('Komentaras') }}</label>
                            <textarea minlength="4" maxlength="250" class="form-control"
                                      style="min-height: 200px; max-height: 500px"
                                      placeholder="{{ __('Komentaras') }}"
                                      wrap="soft"
                                      wire:model="editCommentForm.content" id="commentContent"></textarea>
                            @error('editCommentForm.content')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <div>
                            @error('editCommentForm.general')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="clearErrors">{{ __('Uždaryti') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Redaguoti') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="confirmDeleteActionModal" tabindex="-1" aria-labelledby="confirmDeleteActionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="confirmDeleteActionLabel">{{ __('Ar tikrai norite padaryti šį veiksmą?') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Ne') }}</button>
                    <button type="button" class="btn btn-danger" wire:click="confirmDeletion">{{ __('Taip') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit="editPost">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editPostModalLabel">{{ __('Redaguoti nuotrauką') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">{{ __('Pavadinimas') }}</label>
                            <input min="5" maxlength="100" type="text" class="form-control" wire:model="editPostForm.title" id="postTitle">
                            @error('editPostForm.title')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="postContent" class="form-label">{{ __('Aprašas') }} <em>{{ __('(nebūtina)') }}</em></label>
                            <textarea maxlength="500" class="form-control"
                                      style="min-height: 200px; max-height: 500px"
                                      placeholder="{{ __('Aprašymas') }}"
                                      wire:model="editPostForm.content" id="postContent"></textarea>
                            @error('editPostForm.content')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <div>
                            @error('editPostForm.general')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="clearErrors">{{ __('Uždaryti') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Redaguoti') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @once
        @push('footer-scripts')
            <script type="module">
                Livewire.on('postAdded', () => {
                    $('#addPostModal').modal('hide');
                });
            </script>
        @endpush
    @endonce
</section>
@push('head-links')
    <link rel="preload" as="image" href="{{ $postImage }}" />
    <link rel="preload" as="image" href="{{ $profilePicture }}" />
@endpush
