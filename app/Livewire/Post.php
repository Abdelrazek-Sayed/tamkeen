<?php

namespace App\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Post as PostModel;


class Post extends Component
{


    public $content;

    public function addComment($postId)
    {
        $this->validate([
            'content' => 'required',
        ]);

        Comment::create([
            'post_id' => $postId,
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        $this->content = '';

    }

    public function delete($id)
    {
        $post = PostModel::findOrFail($id);
        $post->delete();
        $this->refresh();
    }


    public function all_posts()
    {
        return PostModel::orderByDesc('id')->get();
    }

    #[On('refresh-list')]
    public function refresh()
    {
    }

    public function render()
    {
        return view(
            'livewire.post',
            [
                'posts' => $this->all_posts(),
            ]
        );
    }
}
