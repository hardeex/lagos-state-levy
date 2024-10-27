<div class="container">
    <h2>View Business Branches</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('auth.viewBranches-submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="batch">Batch Number</label>
            <input type="number" name="batch" id="batch" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">View Branches</button>
    </form>
</div>
