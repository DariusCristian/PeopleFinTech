<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Success Stories</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container py-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-2">
                <div>
                    <h1 class="h3 mb-0">Success Stories</h1>
                    <div class="text-muted">{{ $member->name }}</div>
                </div>
                <a class="btn btn-outline-secondary" href="{{ route('members.index') }}">Back to members</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="card card-body shadow-sm mb-4" action="{{ route('members.success-stories.store', $member->id) }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="title">Title</label>
                        <input class="form-control" id="title" type="text" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="story">Story</label>
                        <textarea class="form-control" id="story" name="story" rows="4" required>{{ old('story') }}</textarea>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit">Add Story</button>
                </div>
            </form>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5">Stories</h2>
                    @if ($stories->isEmpty())
                        <div class="text-muted">No stories yet.</div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach ($stories as $story)
                                <div class="list-group-item">
                                    <div class="fw-semibold">{{ $story->title }}</div>
                                    <div class="text-muted small">{{ $story->created_at->format('Y-m-d') }}</div>
                                    <div class="mt-2">{{ $story->story }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
