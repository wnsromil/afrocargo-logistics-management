<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Roles</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $user)
                <tr>
                    <td class="text-center text-muted">{{ ++$key }}</td>
                    <td class="text-center">{{ $user->name }}</td>
                    <td class="text-center">{{ $user->email }}</td>
                    <td class="text-center">
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                        <label class="badge bg-success">{{ $v }}</label>
                        @endforeach
                    @endif
                    </td>
                    <td class="text-center">
                        <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}"><i class="fa-solid fa-list"></i></a>
                        <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                            @csrf
                            @method('DELETE')
            
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
    {!! $data->links('pagination::bootstrap-5') !!}

    @section('script')
        
    @endsection
</x-app-layout>
