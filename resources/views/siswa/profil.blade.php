@extends('layouts.app')

@section('styles')
<style>
    .profile-card { max-width: 650px; margin: 40px auto; background: white; border: 1px solid #E0E0E0; border-radius: 12px; padding: 50px 30px; display: flex; align-items: center; gap: 30px; justify-content: center; }
    .avatar { width: 120px; height: 120px; background: #D9D9D9; border-radius: 50%; flex-shrink: 0; }
    .profile-info { flex: 1; }
    .profile-name { font-size: 24px; font-weight: bold; margin-bottom: 8px; color: #000; }
    .profile-role { color: #A0A0A0; font-size: 13px; margin-bottom: 4px; text-transform: capitalize; }
    .profile-school { color: #A0A0A0; font-size: 13px; margin-bottom: 20px; }
    .btn-logout { background: #8B1818; color: white; border: none; padding: 8px 30px; border-radius: 6px; font-weight: bold; font-size: 13px; cursor: pointer; text-decoration: none; display: inline-block; }
</style>
@endsection

@section('content')
<div class="profile-card">
    <div class="avatar"></div>
    <div class="profile-info">
        <div class="profile-name">{{ $user->username ?? session('username') }}</div>
        <div class="profile-role">{{ $user->role ?? 'Siswa' }}</div>
        <div class="profile-school">Smk Bina Informatika</div>
        <a href="/logout" class="btn-logout">Log Out</a>
    </div>
</div>
@endsection