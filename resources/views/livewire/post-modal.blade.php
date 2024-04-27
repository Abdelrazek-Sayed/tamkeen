<div class="p-6">
    <form wire:submit="save">
        <!-- Name input -->
        <div>
            <x-input-label for="title" :value="__('Title')"/>
            <x-text-input wire:model="form.title" id="title" class="mt-1 block w-full" type="text"/>
            <x-input-error :messages="$errors->get('form.title')" class="mt-2"/>
        </div>
        <!-- Description input -->
        <div class="mt-4">
            <x-input-label for="body" :value="__('Body')"/>
            <textarea wire:model="form.body" id="body"
                      class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            <x-input-error :messages="$errors->get('form.body')" class="mt-2"/>
        </div>
        <div class="mt-4">
            <x-input-label for="image" :value="__('Image')"/>

            <x-text-input wire:model="form.image" id="image" class="mt-1 block w-full" type="file"/>

            <x-input-error :messages="$errors->get('form.image')" class="mt-2"/>

        </div>
        <div class="py-3 flex" wire:model="form.image">
            @if ($this->post && $this->post->image_url)
                <div class="ml-4 mr-4 flex  rounded-md">
                        <span>
                            <img src="{{ $this->post->image_url }}" width="200" style="height: 200px"
                                 class="mt-4 mb-4 border rounded">
                        </span>
                </div>
            @endif
            @if ($this->form->image)
                <div class="flex ml-4 mr-4 rounded-md ">
                        <span>
                            <img src="{{ $this->form->image->temporaryUrl() }}" width="200" style="height: 200px"
                                 class="mt-4 mb-4 border rounded ">
                        </span>
                </div>
            @endif

        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>
