<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use App\Models\Post as PostModel;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Livewire\Form;

class PostForm extends Form
{
    public $image;
    public $old_image;
    public string $title = '';
    public string $body = '';
    public string $image_name = '';


    public ?Post $post = null;

    public function setPost(?Post $post = null): void
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->old_image = $post->image;
    }


    public function save(): void
    {
        $this->validate();

        if (!$this->post) {
            if ($this->image != '') {
                $this->image_name = md5($this->image . microtime()) . '.' . $this->image->extension();
                $this->image->storeAs('/posts', $this->image_name, 'uploads');
            }

            auth()->user()->posts()->create($this->modalData());

        } else {


            if ($this->image != '') {
                if ($this->post->image) {
                    if (File::exists('images/posts/' . $this->post->image)) {
                        unlink('images/posts/' . $this->post->image);
                    }
                }
                $this->image_name = md5($this->image . microtime()) . '.' . $this->image->extension();
                $this->image->storeAs('/posts', $this->image_name, 'uploads');
            } else {
                $this->image_name = $this->post->image;
            }
            $this->post->update($this->modalData());
        }


        $this->reset();

    }

    public function modalData()
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'image' => $this->image_name,
        ];
    }

    public function rules(): array
    {
        return [
            'title' => ['required'],
            'body' => ['required'],
//            'image' => [Rule::requiredIf(!$this->post)],

        ];
    }





}
