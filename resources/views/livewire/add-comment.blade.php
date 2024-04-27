<div class="mt-6">
    @foreach($post->comments as $comment)
        <div class="comment">
            <p>{{ $comment->user->name }} - {{ $comment->content }}</p>
        </div>
    @endforeach
    <form wire:submit.prevent="addComment">
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

