<div>
    <h1>Atualizar foto de perfil</h1>
    <form action="#" method="post" wire:submit.prevent="storagePhoto">
        <input type="file" wire:model="photo"/><br/>
        @error('photo') {{$message}} @enderror
        <button type="submit">Upload de foto</button>

    </form>
</div>
