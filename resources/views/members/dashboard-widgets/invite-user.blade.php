<h1 class="h2">
    <i class="fa-kit fa-sharp-solid-user-circle-check text-accent"></i>
    <span>Invite Someone to Neuly</span>
</h1>
<div class="card p-4 border-accent">
    <div class="fs-6">
        <livewire:members.invite-user :user="\Illuminate\Support\Facades\Auth::user()" />
    </div>
</div>
