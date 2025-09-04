@extends('layouts.back_layout')

@section('title', 'Liste des utilisateurs')

@section('content')
<section class="mb-6 ms-6 mt-20 p-6 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 w-fit">
    <h1 class="text-xl font-bold mb-4 text-gray-700 dark:text-gray-200">Liste des utilisateurs</h1>

    @if($users->isEmpty() && $coach->isEmpty() && $admin->isEmpty())
        <p class="text-gray-500">Aucun utilisateur enregistré.</p>
    @else
        <gap-4>

            <!-- Admin -->
            <div class="table mb-5">
                <h2 class="text-white">Admin</h2>
                <table class="w-full border-collapse text-gray-700 dark:text-gray-200">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                            <th class="p-2 border">Nom</th>
                            <th class="p-2 border">Prénom</th>
                            <th class="p-2 border">Rôle actuel</th>
                            <th class="p-2 border">Email</th>
                            <th class="p-2 border">Changer le rôle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admin as $user)
                        <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-2 border">{{ $user->nom }}</td>
                            <td class="p-2 border">{{ $user->prenom }}</td>
                            <td class="p-2 border">{{ $user->role->nom }}</td>
                            <td class="p-2 border">{{ $user->email }}</td>
                            <td class="p-2 border">{{ $user->role->nom }}</td> <!-- juste affiché -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Coach -->
            <div class="table mb-5">
                <h2 class="text-white">Coach</h2>
                <table class="w-full border-collapse text-gray-700 dark:text-gray-200">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                            <th class="p-2 border">Nom</th>
                            <th class="p-2 border">Prénom</th>
                            <th class="p-2 border">Rôle actuel</th>
                            <th class="p-2 border">Email</th>
                            <th class="p-2 border">Changer le rôle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coach as $user)
                        <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-2 border">{{ $user->nom }}</td>
                            <td class="p-2 border">{{ $user->prenom }}</td>
                            <td class="p-2 border">{{ $user->role->nom }}</td>
                            <td class="p-2 border">{{ $user->email }}</td>
                            <td class="p-2 border">
                                <form action="{{ route('back.role.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="role_id" class="border rounded px-10 py-1 text-black">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                {{ $role->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">Modifier</button>
                                </form>
                                <form action="{{ route('back.user.destroy',$user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Users -->
            <div class="table mb-5">
                <h2 class="text-white">User</h2>
                <table class="w-full border-collapse text-gray-700 dark:text-gray-200">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                            <th class="p-2 border">Nom</th>
                            <th class="p-2 border">Prénom</th>
                            <th class="p-2 border">Rôle actuel</th>
                            <th class="p-2 border">Email</th>
                            <th class="p-2 border">Changer le rôle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-2 border">{{ $user->nom }}</td>
                            <td class="p-2 border">{{ $user->prenom }}</td>
                            <td class="p-2 border">{{ $user->role->nom }}</td>
                            <td class="p-2 border">{{ $user->email }}</td>
                            <td class="p-2 border">
                                <form action="{{ route('back.role.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="role_id" class="border rounded px-10 py-1 text-black">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                {{ $role->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">Modifier</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </gap-4>
    @endif
</section>
@endsection
