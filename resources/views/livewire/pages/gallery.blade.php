<main>
    <section class="py-5 text-center gallery-banner">
        <div class="container">
            <div class="row py-lg-5">
                <div class="card col-lg-7 col-md-8 mx-auto">
                    <div class="card-body">
                        <h1 class="fw-light">{{ __('Nuotraukų Galerija') }}</h1>
                        <p class="lead text-body-secondary mb-5">{{ __('Dalinkis savo nuotraukomis su kitais!') }}</p>
                        <div class="text-center mt-5">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <flux:icon.magnifying-glass variant="mini" class="d-inline me-2"/>{{ __('Paieška') }}
                                </span>
                                <input type="text" wire:model.live="search" class="form-control">
                                <button type="submit" class="btn btn-primary">
                                    <flux:icon.funnel variant="mini" class="d-inline me-2"/>{{ __('Filtrai') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h3>{{ __('Galerija') }}</h3>
                </div>
                <div>
                    @auth
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPostModal">
                            {{ __('Įkelti nuotrauką') }}
                        </button>
                    @else
                        <span>
                            {{ __('Turite prisijungti norint įkelti nuotrauką!') }}
                        </span>
                    @endauth
                </div>
            </div>
            @if(count($posts) == 0)
                <div class="col text-center">
                    <div class="card shadow-sm" style="height: 200px;">
                        <h2 class="my-auto">{{ __('Nieko neįkelta!') }}</h2>
                    </div>
                </div>
            @else
                <div class="mb-3">
                    {{ $posts->links(data: ['scrollTo' => false]) }}
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach ($posts as $post)
                        @php($position = 'start') {{-- pirma --}}
                        @if($loop->iteration % 3 == 0) {{-- paskutine --}}
                            @php($position = 'end')
                        @elseif($loop->iteration % 2 == 0) {{-- vidurine --}}
                            @php($position = 'middle')
                        @endif
                        @push("gallery-posts-$position")
                            <x-layouts.app.gallery.post :post="$post"/>
                        @endpush
                    @endforeach
                    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                        @stack('gallery-posts-start')
                    </div>
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        @stack('gallery-posts-middle')
                    </div>
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        @stack('gallery-posts-end')
                    </div>
                </div>
                <div class="mt-3">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit="addPost">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addPostModalLabel">{{ __('Įkelti nuotrauką') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">{{ __('Pavadinimas') }}</label>
                            <input min="5" maxlength="100" type="text" class="form-control" wire:model="addPostForm.title" id="postTitle">
                            @error('addPostForm.title')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="postContent" class="form-label">{{ __('Aprašas') }} <em>{{ __('(nebūtina)') }}</em></label>
                            <textarea maxlength="500"
                                      style="min-height: 200px; max-height: 500px"
                                      class="form-control" wire:model="addPostForm.content"
                                      id="postContent"></textarea>
                            @error('addPostForm.content')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="postPhoto" class="form-label">{{ __('Įkelkite nuotrauką') }}</label>
                            <input type="file" class="form-control" wire:model="addPostForm.photo" id="postPhoto">
                            @error('addPostForm.photo')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" wire:model="addPostForm.acceptedRules" id="postAcceptRules">
                            <label class="form-check-label" for="postAcceptRules">
                                <span>
                                    {{ __('Patvirtinkite, jog perskaitėte nuotraukų įkėlimų') }}
                                </span> <a target="_blank" href="{{ route('upload-rules') }}">
                                    {{ __('taisykles') }}
                                </a>
                            </label>
                            @error('addPostForm.acceptedRules')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="clearErrors">{{ __('Uždaryti') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Įkelti') }}</button>
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
</main>
