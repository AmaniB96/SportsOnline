<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Equipe;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; 
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(){
        $admin = User::where('role_id',3)->get();
        $users = User::where('role_id',1)->get();
        $coach = User::where('role_id',2)->get();
        $roles = Role::all();
        $this->authorize('view', User::class);
        return view('back.user',compact('admin','users','coach','roles'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // 2. === AJOUT DE LA LOGIQUE POUR LA PHOTO ===
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            // Stocker la nouvelle photo et sauvegarder le chemin
            $user->profile_photo_path = $request->file('photo')->store('profile-photos', 'public');
        }
        // ==========================================

        $user->save(); // Sauvegarder toutes les modifications (infos + photo)

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        // Cas 1 : l'utilisateur supprime son propre compte
        if ($request->user()->id === $user->id) {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $user->delete();

            return Redirect::to('/');
        } 
        
        // Cas 2 : un admin supprime un autre utilisateur
        if ($this->authorize('delete', $user)) {
            $user->delete();

            return Redirect::route('back.user.index')
                ->with('success', 'Utilisateur supprimé avec succès.');
        }

        // Cas 3 : ni admin ni propriétaire du compte → refus
        abort(403, 'Action non autorisée.');
    }

}
