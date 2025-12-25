<?php

namespace App\Livewire;

use App\Models\Post as ModelsPost;
use Livewire\Component;

class Post extends Component
{

    public $posts, $name, $description, $postId, $showUpdatePost = false, $showAddPost  = false;
    /**
     * delete action listener
     */
    protected $listeners = [
        'deletePostListner' => 'deletePost'
    ];
    /**
     * List of add/edit form rules 
     */
    protected $rules = [
        'name' => 'required',
        'description' => 'required'
    ];

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields()
    {
        $this->name = '';
        $this->description = '';
    }

    /**
     * Open Add Post form
     * @return void
     */
    public function addPost()
    {
        $this->resetFields();
        $this->showAddPost = true;
        $this->showUpdatePost = false;
    }
    /**
     * store the user inputted post data in the posts table
     * @return void
     */
    public function storePost()
    {
        $this->validate();
        try {
            ModelsPost::create([
                'name' => $this->name,
                'description' => $this->description
            ]);
            session()->flash('success', 'Post Created Successfully!!');
            $this->resetFields();
            $this->showAddPost = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    /**
     * show existing post data in edit post form
     * @param mixed $id
     * @return void
     */
    public function editPost($id)
    {
        try {
            $post = ModelsPost::findOrFail($id);
            if (!$post) {
                session()->flash('error', 'Post not found');
            } else {
                $this->name = $post->name;
                $this->description = $post->description;
                $this->postId = $post->id;
                $this->showUpdatePost = true;
                $this->showAddPost = false;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    /**
     * update the post data
     * @return void
     */
    public function updatePost()
    {
        $this->validate();
        try {
            ModelsPost::whereId($this->postId)->update([
                'name' => $this->name,
                'description' => $this->description
            ]);
            session()->flash('success', 'Post Updated Successfully!!');
            $this->resetFields();
            $this->showUpdatePost = false;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
    }

    /**
     * Cancel Add/Edit form and redirect to post listing page
     * @return void
     */
    public function cancelPost()
    {
        $this->showAddPost = false;
        $this->showUpdatePost = false;
        $this->resetFields();
    }

    /**
     * delete specific post data from the posts table
     * @param mixed $id
     * @return void
     */
    public function deletePost($id)
    {
        try {
            ModelsPost::find($id)->delete();
            session()->flash('success', "Post Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    public function render()
    {
        $this->posts = ModelsPost::select('id', 'name', 'description')->get();
        return view('livewire.post');
    }
}
