<form action="{{ route('membres.update', $membre->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="nom" value="{{ $membre->nom }}">
    <input type="text" name="fonction" value="{{ $membre->fonction }}">
    <input type="text" name="language" value="{{ $membre->language }}">
    <button type="submit">Modifier</button>
</form>