<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Livewire\Form;

class PostForm extends Form
{
    public $image;
    public $old_image;
    public string $title_en = '';
    public string $title_ar = '';
    public string $body_en = '';
    public string $body_ar = '';
    public string $image_name = '';


    public ?Post $post = null;

    public function setPost(?Post $post = null): void
    {
        $this->post = $post;

        $this->title_en = $this->post->getTranslation('title', 'en');
        $this->title_ar = $this->post->getTranslation('title', 'ar');

        $this->body_en = $this->post->getTranslation('body', 'en');
        $this->body_ar = $this->post->getTranslation('body', 'ar');

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
            'title' => [
                'en' => $this->title_en,
                'ar' => $this->title_ar,
            ],
            'body' => [
                'en' => $this->body_en,
                'ar' => $this->body_ar,
            ],
            'image' => $this->image_name,
        ];
    }

    public function rules(): array
    {
        return [
            'title_en' => ['required'],
            'title_ar' => ['required'],
            'body_en' => ['required'],
            'body_ar' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],

        ];
    }


}
