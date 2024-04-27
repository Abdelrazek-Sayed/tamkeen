<div>
    <div class="text-right mt-4 mb-4">
        <x-danger-button wire:click="$dispatch('openModal', { component: 'post-modal' })" class="mb-4">
            {{ __('create post') }}
        </x-danger-button>
    </div>
    <div class="container">
        <div class="timeline">
            @forelse ($posts as $post)
                <div class="timeline-row">
                    <div class="timeline-time">
                        {{ $post->created_at_hour }}
                        <small>{{ $post->formatted_created_date }}</small>
                    </div>
                    <div class="timeline-content">
                        <i class="icon-attachment"></i>
                        <h4>{{ $post->title }}</h4>
                        <p>{{ $post->body }}</p>
                        @if($post->image)
                            <div class="thumbs">
                                <img class="img-fluid rounded"
                                     src="{{ $post->image_url }}"
                                     alt="{{ $post->title }}">
                            </div>
                        @endif
                        <div class="">
                            <span class="badge badge-pill">{{ $post->user?->name }}</span>
                        </div>
                        @if(auth()->id() === $post->user_id)
                            <div class="flex justify-start space-x-2">
                                <x-primary-button
                                    wire:click="$dispatch('openModal', { component: 'post-modal' , arguments: { post: {{ $post }} }})"
                                    class="mb-2">
                                    {{ __('Edit') }}
                                </x-primary-button>

                                <x-danger-button wire:click="delete({{ $post->id }})" class="mb-2 mx-2">
                                    {{ __('Delete') }}
                                </x-danger-button>
                            </div>
                        @endif

                        <div class="comment-section">
                            <h5>Comments</h5>
                            <div class="mt-6">
                                @foreach($post->comments as $comment)
                                    <div class="comment">
                                        <p>{{ $comment->user->name }} - {{ $comment->content }}</p>
                                    </div>
                                @endforeach
                                <form wire:submit.prevent="addComment({{ $post->id }})">
                                    <x-input-label for="body" :value="__('Write Comment')"/>
                                    <div class="flex items-start space-x-2">
                                   <textarea wire:model="content" id="content" placeholder="Write a comment"
                                             class="mt-1 flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                   </textarea>
                                        @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
                                        <div>
                                            <x-input-error :messages="$errors->get('form.content')" class="mt-2"/>
                                            <x-secondary-button class="mb-2" type="submit">
                                                {{ __('Add Comment') }}
                                            </x-secondary-button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @empty

                <div class="timeline-row">
                    <div class="timeline-content">
                        <p class="m-0">Loading...</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

</div>

