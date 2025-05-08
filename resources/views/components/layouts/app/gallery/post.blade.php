<div class="card mb-3 shadow post-transition overflow-hidden relative">
    <img class="bd-placeholder-img card-img-top"
         height="225" width="100%"
         alt="{{ $post->title }}"
         src="{{ asset('storage/' . $post->image_url) }}">
    <div class="card-body post-hidden-card-body">
        <h2>{{ $post->title }}</h2>
        <div class="overflow-hidden">
            <p class="card-text text-truncate">{{ $post->content }}</p>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-light">View</button>
                <button type="button" class="btn btn-sm btn-outline-light">Edit</button>
            </div>
            <div>
                <small class="text-body-secondary d-block">
                    <a href="{{ route('profile', $post->author()->id) }}">{{ $post->author()->name }}</a>
                </small>
                <small class="text-body-secondary">{{ $post->created_at }}</small>
            </div>
        </div>
    </div>
</div>
