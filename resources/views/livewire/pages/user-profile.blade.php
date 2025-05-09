<section class="w-100 px-4 py-5">
    <div class="row d-flex justify-content-center">
        <div class="col col-md-9 col-lg-7 col-xl-6">
            <div class="card rounded-3">
                <div class="card-body p-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="{{ $url = $user->profileUrl() }}"
                                 alt="{{ __('Profilio nuotrauka') }}"
                                 class="img-fluid rounded-3"
                                 style="width: 180px;">
                            @push('head-links')
                                <link rel="preload" as="image" href="{{ $url }}" />
                            @endpush
                        </div>
                        <div class="flex-grow-1 ms-3 relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>{{ $user->name }}</h5>
                                <div class="d-flex justify-content-between gap-2">
                                    @if($user->isMe())
                                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">{{ __('Valdymo skydas') }}</a>
                                        <a href="{{ route('settings.profile') }}" class="btn btn-outline-primary">{{ __('Nustatymai') }}</a>
                                    @endif
                                    <x-layouts.app.user.follow-button
                                        :isFollowing="$isFollowing"
                                        :user="$user"
                                        wire:click="{{ $isFollowing ? 'unfollow' : 'follow' }}"/>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between rounded-3 p-2 mb-2 bg-body-tertiary px-5 text-center">
                                <div>
                                    <p class="small text-muted mb-1">{{ __('Nuotraukos') }}</p>
                                    <p class="mb-0">{{ $user->posts->count() }}</p>
                                </div>
                                <div>
                                    <p class="small text-muted mb-1">{{ __('Komentarai') }}</p>
                                    <p class="mb-0">{{ $user->comments->count() }}</p>
                                </div>
                                <div>
                                    <p class="small text-muted mb-1">{{ __('Sekėjai') }}</p>
                                    <p class="mb-0">{{ $user->followers->count() }}</p>
                                </div>
                                <div>
                                    <p class="small text-muted mb-1">{{ __('Seka') }}</p>
                                    <p class="mb-0">{{ $user->following->count() }}</p>
                                </div>
                                <div>
                                    <p class="small text-muted mb-1">{{ __('Miestas') }}</p>
                                    <p class="mb-0">{{ $user->city->name }}</p>
                                </div>
                            </div>
                            <div class="absolute bottom-0 left-0">
                                <p class="m-0">{{ __('Profilis atnaujintas') }}</p>
                                <p class="m-0">{{ __('Prisijunė prie sistemos') }}</p>
                            </div>
                            <div class="absolute bottom-0 right-0 text-right">
                                <p class="m-0">{{ $user->updated_at }}</p>
                                <p class="m-0">{{ $user->created_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
