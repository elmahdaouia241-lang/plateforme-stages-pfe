<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Encadrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    // 🔹 afficher register
    public function showRegister()
    {
        return view('auth.register');
    }
    // 🔹 traiter register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|in:etudiant,encadrant,admin',
        ]);
        // 1️⃣ create user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'status'   => 'active',
        ]);

        // 2️⃣ etudiant
        if ($request->role === 'etudiant') {
            Etudiant::create([
                'user_id' => $user->id,
                'cycle'   => $request->cycle,
                'filiere' => $request->filiere,
                'niveau'  => $request->niveau,
                'cne'     => $request->cne,
            ]);
        }

        // 3️⃣ encadrant
        if ($request->role === 'encadrant') {
            Encadrant::create([
                'user_id'    => $user->id,
                'specialite' => $request->specialite,
            ]);
        }

        // ✅ AUTO LOGIN
        Auth::login($user);

        // ✅ DIRECT → application
        return redirect()->route('welcome');
    }

    // 🔹 afficher login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 🔹 traiter login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('welcome');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect']);
    }

    // 🔹 logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}