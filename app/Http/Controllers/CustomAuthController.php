<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bouteille;
use App\Models\Cellier;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomAuthController extends Controller
{
	/**
	 * Display the login page .
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('auth.login');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function listeUsager()
	{
		$users = User::all();
		return view('user.listeUsager', ['users' => $users]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('auth.registration');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'nom' => 'required|max:25|min:2|unique:users',
			'courriel' => 'required|email:rfc,filter|unique:users',
			'password' => 'required|min:6|max:20',
			'date_naissance' => 'required|date_format:Y-m-d|before:' . Carbon::now()->subYears(18)->format('Y-m-d') . '|after:' . Carbon::now()->subYears(100)->format('Y-m-d')

		]);

		$user = new User;
		$user->fill($request->all());
		$user->password = Hash::make($request->password);
		$user->save();

		return redirect('login');
	}

	/**
	 * Function se connecter.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function customLogin(Request $request)
	{

		$request->validate([
			'courriel' => 'required|email:rfc,filter|exists:users,courriel',
			'password' => 'required'
		]);

		$credentials = $request->only('courriel', 'password');
		if (Auth::attempt($credentials)) {
			session(['user' => Auth::user()]);
			if (Auth::user()->admin === 1) {
				return redirect()->intended('importerBouteille');
			} else {
				return redirect()->intended('cellier');
			}
		}

		return redirect('login')->withSuccess('Les informations de connexion ne sont pas valides!');
	}

	/**
	 * Le view pour dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function dashboard()
	{

		if (Auth::check()) {
			$id = Auth::user()->id;
			$nom = Auth::user()->nom;
			$courriel = Auth::user()->courriel;
			$date_naissance = Auth::user()->date_naissance;
		}

		return view('user.dashboard', [
			'nom' => $nom,
			'courriel' => $courriel,
			'date_naissance' => $date_naissance,
			'id' => $id
		]);
	}

	/**
	 * Function se déconnecter.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function logout()
	{
		Session::flush();
		Auth::logout();

		return redirect('login');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(user $user)
	{
		$id = $user->id;
		$nom = $user->nom;
		$courriel = $user->courriel;
		$date_naissance = $user->date_naissance;

		return view('user.usermodifie', [
			'nom' => $nom,
			'courriel' => $courriel,
			'date_naissance' => $date_naissance,
			'id' => $id
		]);
	}

	/**
	 * Mettre à jour les informations de l'usager dans la base après validation
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, user $user)
	{
		$request->validate([
			'nom' => 'required|max:25|min:2',
			'courriel' => 'required|email:rfc,filter',
			'password' => 'required|min:6|max:20',
			'date_naissance' => 'required|date_format:Y-m-d|before:' . Carbon::now()->subYears(18)->format('Y-m-d') . '|after:' . Carbon::now()->subYears(100)->format('Y-m-d')
		]);

		$oldPassword = $user->password;
		$password = $request->password;
		$id = $user->id;
		$bool = Hash::check($password, $oldPassword);
		if ($bool) {
			$user->fill($request->all());
			$user->update([
				'nom' => $request->nom,
				'courriel' => $request->courriel,
				'date_naissance' => $request->date_naissance,
				'password' => $oldPassword
			]);
			return redirect('dashboard')->withInput()->with("modifieInfo", "infomation modifiée");
		}

		return redirect('/user/' . $id . '/edit')->withSuccess('Le mot de passe n\'est pas valides!');
	}

	/**
	 * Afficher le formulaire de modification de mot de passe
	 *
	 * @param  \App\Models\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function modifiePassword(user $user)
	{
		$id = $user->id;
		return view('user.passwordmodifie', ['id' => $id, 'user' => $user]);
	}


	/**
	 * Mettre à jour le mot de passe d'usager dans la base après la validation
	 *
	 * @param  \App\Models\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function passwordupdate(Request $request, user $user)
	{
		$request->validate([
			'old_password' => 'required|min:6|max:20',
			'nouveau_mot_de_passe' => 'required|min:6|max:20|same:mot_de_passe_confirme',
			'mot_de_passe_confirme' => 'required|min:6|max:20'

		]);
		$id = $user->id;
		$oldPassword = $user->password;
		$password = $request->old_password;
		$bool = Hash::check($password, $oldPassword);

		if ($bool) {
			$nouveau_mot_de_passe = Hash::make($request->nouveau_mot_de_passe);
			$user->update([
				'password' => $nouveau_mot_de_passe
			]);
			return redirect('dashboard')->withInput()->with("modifiePassword", "password modifiée");
		}

		return redirect('/user/' . $id . '/password')->withSuccess('Le mot de passe n\'est pas valides!');
	}

	/**
	 * Afficher le formulaire de la modification d'informations de l'utilisateur
	 *
	 * @param  \App\Models\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function adminedit(user $user)
	{
		$id = $user->id;
		$nom = $user->nom;
		$courriel = $user->courriel;
		$date_naissance = $user->date_naissance;

		return view('user.adminmodifieuser', [
			'nom' => $nom,
			'courriel' => $courriel,
			'date_naissance' => $date_naissance,
			'id' => $id,
			'user' => $user
		]);
	}

	/**
	 * Mettez à jour la ressource spécifiée dans le stockage. 
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\user  $user
	 * @return \Illuminate\Http\Response
	 */

	public function adminupdate(Request $request, user $user)
	{
		$request->validate([
			'nom' => 'required|max:25|min:2',
			'courriel' => 'required|email:rfc,filter',
			'password' => 'required|min:6|max:20',
			'date_naissance' => 'required|date_format:Y-m-d|before:' . Carbon::now()->subYears(18)->format('Y-m-d') . '|after:' . Carbon::now()->subYears(100)->format('Y-m-d')
		]);
		$adminPassword = Auth::user()->password;
		$password = $request->password;
		$id = $user->id;
		$userPassword = $user->password;

		if (isset($request->admin)) {
			$admin = 1;
		} else {
			$admin = null;
		}

		$bool = Hash::check($password, $adminPassword);
		if ($bool) {
			$user->fill($request->all());
			$user->update([
				'nom' => $request->nom,
				'courriel' => $request->courriel,
				'date_naissance' => $request->date_naissance,
				'admin' => $admin,
				'password' => $userPassword
			]);
			
			return redirect('liste-usager')->withInput()->with("modifie", "infomation modifiée");
		}

		return redirect('/user/' . $id . '/adminedit')->withSuccess('Le mot de passe n\'est pas valides!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(user $user)
	{
		$id_user = $user->id;
		Cellier::where('user_id', $id_user)->delete();
		Bouteille::where('user_id', $id_user)->delete();
		$user->delete();
		return redirect('liste-usager');
	}

	/**
	 * Rechercher dans la table users les noms qui contiennent le motCle
	 *
	 * @param motCle
	 * @return response une listes des usagers qui contiennent le motCle dans leur nom
	 */
	public function rechercheUsersParMotCle($motCle)
	{
		if (isset($motCle)) {
			$users = User::rechercheUsersParMotCle($motCle);
		} else {
			$users = User::all();
		}

		return response()->json(['table' => view('user.table', compact('users'))->render()]);
	}


	/**
	 * Afficher une vue blade en JSON 
	 *
	 * @return response une listes des usagers qui contiennent le motCle dans leur nom
	 */
	public function affichelisteUsager()
	{

		$users = User::all();

		return response()->json(['table' => view('user.table', compact('users'))->render()]);
	}
}
