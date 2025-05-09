<div class="card mb-3 shadow post-transition overflow-hidden relative">
    <a href="{{ route('gallery-post', ['id' => $post->id]) }}">
        <img class="bd-placeholder-img card-img-top"
             height="225" width="100%"
             alt="{{ $post->title }}"
             src="{{ $url = asset('storage/' . $post->image_url) }}">
        @push('head-links')
            <link rel="preload" as="image" href="{{ $url }}" />
        @endpush
    </a>
    <div class="card-body post-hidden-card-body">
        <h3 class="text-truncate pb-1 text-light">{{ $post->title }}</h3>
        <div class="overflow-hidden">
            <p class="card-text text-truncate text-light">{{ $post->content }}</p>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex flex-column">
                <div class="text-light">
                    <flux:icon.hand-thumb-up class="d-inline me-2"/>{{ $post->likeCount() }}
                </div>
                <div class="text-light">
                    <flux:icon.chat-bubble-bottom-center-text class="d-inline me-2"/>{{ $post->comments()->count() }}
                </div>
            </div>
            <div class="d-flex flex-column">
                <small class="text-light">
                    <a href="{{ route('profile', $post->author()->id) }}">{{ $post->author()->name }}</a>
                </small>
                <small class="text-light">
                    {{ $post->created_at }}
                </small>
            </div>
        </div>
    </div>
</div>
