<?php

namespace App\Livewire;

use App\Models\Post as PostModel;
use Illuminate\Support\Facades\File;
use Livewire\Component;


class PostsArchive extends Component
{

    public $postModel;

    public function mount()
    {
        $this->postModel = new PostModel();
    }

    public function destroy($id)
    {
        $post = PostModel::withTrashed()->find($id);

        if ($post->image != '') {
            if (File::exists('images/posts/' . $post->image)) {
                unlink('images/posts/' . $post->image);
            }
        }
        $post->forceDelete();
    }

    public function restorePost($id)
    {
        $post = PostModel::withTrashed()->find($id);

        if ($post) {
            $post->restore();
        }
    }

    public function render()
    {
        return view('livewire.posts-archive', [
            'posts' => \auth()->user()->posts()->onlyTrashed()->get(),
        ]);
    }
}
