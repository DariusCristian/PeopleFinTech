<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Members</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container py-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-2">
                <h1 class="h3 mb-0">Members</h1>
                <div class="d-flex gap-2">
                    <a class="btn btn-outline-secondary" href="{{ route('events.index') }}">Events</a>
                    <a class="btn btn-primary" href="{{ route('members.create') }}">Add Member</a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form class="card card-body shadow-sm mb-4" method="GET" action="{{ route('members.index') }}">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="profession">Profession</label>
                        <input class="form-control" id="profession" type="text" name="profession" value="{{ request('profession') }}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="company">Company</label>
                        <input class="form-control" id="company" type="text" name="company" value="{{ request('company') }}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">-- Select Status --</option>
                            <option value="active" @selected(request('status') === 'active')>Active</option>
                            <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3 d-flex gap-2">
                    <button class="btn btn-outline-primary" type="submit">Filter</button>
                    <a class="btn btn-outline-secondary" href="{{ route('members.index') }}">Reset</a>
                </div>
            </form>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Profession</th>
                                    <th>Company</th>
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $member)
                                <tr>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->profession }}</td>
                                    <td>{{ $member->company }}</td>
                                    <td>
                                        <span class="badge {{ $member->status === 'active' ? 'text-bg-success' : 'text-bg-secondary' }}">
                                            {{ ucfirst($member->status) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-2">
                                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('members.edit', $member->id) }}">Edit</a>
                                            <a class="btn btn-sm btn-outline-primary" href="{{ route('members.success-stories.index', $member->id) }}">Stories</a>
                                            <form action="{{ route('members.destroy', $member->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                {{ $members->links() }}
            </div>
        </div>
    </body>
</html>
