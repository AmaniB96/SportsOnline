@extends('layouts.back_layout')

@section('title', 'Liste des utilisateurs')

@section('content')
<section class="mb-6 ms-6 mt-32 p-6 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 w-fit flex-column items-center">
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
                                <div class="flex justify-end">
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
                                    <div x-data="{ open: false }" class="inline">
                                        <button @click="open = true" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 ">
                                            Supprimer
                                        </button>
                                        <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
                                                <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-200">Confirmer la suppression</h2>
                                                <p class="mb-4 text-gray-700 dark:text-gray-300">Voulez-vous vraiment supprimer {{ $user->nom }} {{$user->prenom}}</p>
                                                <div class="flex justify-end gap-2">
                                                    <button @click="open = false" class="px-4 text-black py-2 bg-gray-300 rounded hover:bg-gray-400">Annuler</button>
                                                    <form :action="'{{ route('back.user.destroy', $user->id) }}'" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="flex justify-end">
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
                                    <div x-data="{ open: false }" class="inline">
                                        <button @click="open = true" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 ">
                                            Supprimer
                                        </button>
                                        <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
                                                <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-200">Confirmer la suppression</h2>
                                                <p class="mb-4 text-gray-700 dark:text-gray-300">Voulez-vous vraiment supprimer {{ $user->nom }} {{$user->prenom}}</p>
                                                <div class="flex justify-end gap-2">
                                                    <button @click="open = false" class="px-4 text-black py-2 bg-gray-300 rounded hover:bg-gray-400">Annuler</button>
                                                    <form :action="'{{ route('back.user.destroy', $user->id) }}'" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
