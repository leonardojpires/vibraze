@extends('layouts.app')

@section('title', 'Manage users — Vibraze')

@section('content')
    <section class="page-shell page-section">
        @include('partials.flash')
        <div class="page-heading"><div><span class="eyebrow">Administration</span><h1>User accounts.</h1><p>Review access, membership details, and account roles.</p></div><span class="count-badge">{{ $users->count() }} accounts</span></div>

        <div class="table-card">
            <div class="table-wrap">
                <table>
                    <thead><tr><th>User</th><th>Email</th><th>Joined</th><th>Role</th><th><span class="sr-only">Actions</span></th></tr></thead>
                    <tbody>
                        @foreach ($users as $account)
                            @php
                                $accountInitials = collect(preg_split('/\s+/', trim($account->name)))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
                            @endphp
                            <tr>
                                <td data-label="User"><div class="table-user"><span class="avatar">{{ $accountInitials ?: 'U' }}</span><div><strong>{{ $account->name }}</strong><span>#{{ $account->id }}</span></div></div></td>
                                <td data-label="Email">{{ $account->email }}</td>
                                <td data-label="Joined">{{ optional($account->created_at)->format('M j, Y') ?? '—' }}</td>
                                <td data-label="Role"><span class="role-badge role-badge--{{ $account->role }}">{{ ucfirst($account->role) }}</span></td>
                                <td class="table-actions"><a class="button button--quiet button--small" href="{{ route('users.show', $account->id) }}">Review</a><button class="icon-button icon-button--danger" type="button" data-dialog-open="delete-user-dialog" data-action="{{ route('users.delete', $account->id) }}" aria-label="Delete {{ $account->name }}"><svg aria-hidden="true" viewBox="0 0 24 24" width="18" height="18"><path d="M4 7h16M9 7V4h6v3M7 7l1 13h8l1-13" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <dialog class="dialog" id="delete-user-dialog">
        <div class="dialog__content"><span class="eyebrow">Confirm deletion</span><h2>Delete this account?</h2><p>The account and its saved favorites will be permanently removed.</p><div class="dialog__actions"><button class="button button--quiet" type="button" data-dialog-close>Cancel</button><form method="POST" data-dialog-form>@csrf @method('DELETE')<button class="button button--danger" type="submit">Delete account</button></form></div></div>
    </dialog>
@endsection
