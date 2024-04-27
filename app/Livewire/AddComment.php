<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class AddComment extends Component
{
    public $postId;
    public $content;

    public function mount($postId)
    {
        $this->postId = $postId;
    }


    public function addComment()
    {
        $this->validate([
            'content' => 'required',
        ]);

        Comment::create([
            'post_id' => $this->postId,
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        $this->content = '';

    }

    public function render()
    {
        return view('livewire.add-comment', ['post' => \App\Models\Post::find($this->postId)]);
    }
}
