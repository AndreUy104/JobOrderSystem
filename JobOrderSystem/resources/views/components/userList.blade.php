@props(['users'])
{{ $users->links('pagination::bootstrap-5') }}
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Admin</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>
                <div class="form-check form-switch">
                    <form class="d-inline" method="post" action="{{ route( 'update-admin' , ['userId' => $user->id] ) }}">
                        @csrf
                        @method('PUT')
                        <input class="form-check-input" type="checkbox" id="adminToggle" name="adminToggle"
                               @if($user->is_admin) checked @endif
                               onclick="submit()">
                        <label class="form-check-label" for="adminToggle">Admin Access</label>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $users->links('pagination::bootstrap-5') }}
