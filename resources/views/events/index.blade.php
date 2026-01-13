<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Events</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container py-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-2">
                <h1 class="h3 mb-0">Upcoming Events</h1>
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

            <form class="card card-body shadow-sm mb-4" action="{{ route('events.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="name">Event name</label>
                        <input class="form-control" id="name" type="text" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="event_date">Event date</label>
                        <input class="form-control" id="event_date" type="datetime-local" name="event_date" value="{{ old('event_date') }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit">Add Event</button>
                </div>
            </form>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5">Events</h2>
                    @if ($events->isEmpty())
                        <div class="text-muted">No upcoming events.</div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach ($events as $event)
                                <div class="list-group-item">
                                    <div class="fw-semibold">{{ $event->name }}</div>
                                    <div class="text-muted small">{{ \Illuminate\Support\Carbon::parse($event->event_date)->format('Y-m-d H:i') }}</div>
                                    @if ($event->description)
                                        <div class="mt-2">{{ $event->description }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
