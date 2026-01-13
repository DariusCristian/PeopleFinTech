<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add Member</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container py-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0">Add Member</h1>
                <a class="btn btn-outline-secondary" href="{{ route('members.index') }}">Back to list</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="card card-body shadow-sm" action="{{ route('members.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" id="name" type="text" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="profession">Profession</label>
                        <input class="form-control" id="profession" type="text" name="profession" value="{{ old('profession') }}" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="company">Company</label>
                        <input class="form-control" id="company" type="text" name="company" value="{{ old('company') }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="linkedin_url">LinkedIn</label>
                        <input class="form-control" id="linkedin_url" type="url" name="linkedin_url" value="{{ old('linkedin_url') }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="active" @selected(old('status', 'active') === 'active')>Active</option>
                            <option value="inactive" @selected(old('status') === 'inactive')>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary" type="submit">Add Member</button>
                    <button class="btn btn-outline-secondary" type="reset">Reset</button>
                </div>
            </form>
        </div>
    </body>
</html>
