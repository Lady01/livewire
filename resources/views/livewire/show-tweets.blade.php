<div>
    <form wire:submit.prevent="create">
        <input type="text" name="content" id="content" wire:model="content"/>

        @error('content') {{$message}} @enderror

        <button type="submit">Criar tweet</button>
    </form>

    <hr>
    @foreach($tweets as $tweet)
        {{$tweet->user->name}} - {{$tweet->content}}<br>
        @if($tweet->likes->count())
            @if ($tweet->user->photo)
                <img src='{{ url("storage/app/{$tweet->user->photo}") }}' alt="{{ $tweet->user->name }}" />
            @else
                <img src="{{ url("img/imagem.png") }}" alt="{{ $tweet->user->name }}"/>
            @endif


            <a href="#"  wire:click.prevent="unlike({{ $tweet->id }})">Descurtir</a>
        @else
            <a href="#" wire:click.prevent="like({{ $tweet->id }})">Curtir</a>
        @endif
    @endforeach
        <hr>
    <div>
        {{$tweets->links()}}
    </div>
    
</div>
