<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-white d-flex align-items-center justify-content-center vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8">
                <div class="card p-5 bg-white text-dark">

                    <div class="text-center p-3">
                        <img src={{ asset('assets/images/logo.png')}} alt="Logo do AtendManager">
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-10 col-12">
                            <div class="text-center p-3">
                                <h2 class="text-primary">Login</h2>
                            </div>
                            <form action="/login" method='post'>
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Usuário</label>
                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                                    @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Senha</label>
                                    <input type="password" class="form-control text-info" name="password">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">LOGIN</button>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="text-center text-secondary mt-3">
                        <small>&copy; {{ date('Y')}} AtendManager</small><br>
                        <small>Desenvolvido por Ulisses Cavalcante</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
