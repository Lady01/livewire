<?php

namespace App\Http\Livewire;
//use Auth;
use App\Models\Tweet;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;
use Livewire\WithPagination;


class ShowTweets extends Component
{
    use WithPagination;

    public $content = "Apenas um teste";
    protected $rules = [
        'content' => 'required|min:3|max:255'
    ];
    public function render()
    {
        //$tweets = Tweet::with('user')->get();
        $tweets = Tweet::with('user')->latest()->paginate(10);

        return view('livewire.show-tweets',["tweets" => $tweets]);
    }
    public function create(){
        //dd(auth()->user()->tweets());

        $this->validate();
        return auth()->user()->tweet()->create([
            'content' => $this->content,]);
        /*Tweet::create([
            'content' => $this->content,
            'user_id' => 1,
        ]);*/
        $this->content = '';
    }
    public function like($idTweet){
        $tweet = Tweet::find($idTweet);
        $tweet->likes()->create([
            'user_id' => auth()->user()->id
        ]);
    }
    public function unlike(Tweet $tweet){
        $tweet->likes()->delete();
        
    }
}
