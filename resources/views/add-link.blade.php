<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Link Shortener</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.add.link') }}">Add new link</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="col-md-5">
        <form action="{{ route('store.link') }}" method="post">
            @csrf
            <h4 style="padding-top: 20px; padding-bottom: 20px"> Add new link</h4>
            @if(Session::has('flash_message'))
                <div class="text-center">
                    <p class="alert alert-danger">{{ session('flash_message') }}</p>
                </div>
            @endif
            <div class="mb-3">
                <label for="url" class="form-label">Url Link</label>
                <input type="url" class="form-control @error('url') is-invalid @enderror" name="url" placeholder="Put your url here">
                @error('url')
                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
