<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use App\Models\Post;

class PostModal extends ModalComponent
{
    use WithFileUploads;

    public Forms\PostForm $form;

    public ?Post $post = null;

    public function mount(Post $post = null): void
    {
        if ($post && $post->exists) {
            $this->form->setPost($post);
        }
    }


    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render()
    {
        return view('livewire.post-modal');
    }
}
