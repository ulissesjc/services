<form method="POST" action="/import-schools" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".xlsx, .xls">
    <button type="submit">Importar</button>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
</form>
