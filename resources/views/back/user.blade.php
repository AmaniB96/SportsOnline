@extends('layouts.back_layout')

@section('title', 'Liste des utilisateurs')

@section('content')
<section class="m-6 p-6 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
    <h1 class="text-xl font-bold mb-4 text-gray-700 dark:text-gray-200">Liste des utilisateurs</h1>

    @if($users->isEmpty())
        <p class="text-gray-500">Aucun utilisateur enregistré.</p>
    @else
        <div class="table">
            <h2>Admin</h2>
            <table class="w-full border-collapse text-gray-700 dark:text-gray-200">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                        <th class="p-2 border">Nom</th>
                        <th class="p-2 border">Prénom</th>
                        <th class="p-2 border">Rôle</th>
                        <th class="p-2 border">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-2 border">{{ $user->nom }}</td>
                            <td class="p-2 border">{{ $user->prenom }}</td>
                            <td class="p-2 border">{{ $user->role->nom }}</td>
                            <td class="p-2 border">{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="table">
            <h2>Coach</h2>
            <table class="w-full border-collapse text-gray-700 dark:text-gray-200">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                        <th class="p-2 border">Nom</th>
                        <th class="p-2 border">Prénom</th>
                        <th class="p-2 border">Rôle</th>
                        <th class="p-2 border">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-2 border">{{ $user->nom }}</td>
                            <td class="p-2 border">{{ $user->prenom }}</td>
                            <td class="p-2 border">{{ $user->role->nom }}</td>
                            <td class="p-2 border">{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="table">
            <h2>User</h2>
            <table class="w-full border-collapse text-gray-700 dark:text-gray-200">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                        <th class="p-2 border">Nom</th>
                        <th class="p-2 border">Prénom</th>
                        <th class="p-2 border">Rôle</th>
                        <th class="p-2 border">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-2 border">{{ $user->nom }}</td>
                            <td class="p-2 border">{{ $user->prenom }}</td>
                            <td class="p-2 border">{{ $user->role->nom }}</td>
                            <td class="p-2 border">{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>
@endsection
