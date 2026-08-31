@if (session('error'))
    <div class="notice notice--error" role="alert">{{ session('error') }}</div>
@elseif (session('success'))
    <div class="notice notice--success" role="status">{{ session('success') }}</div>
@endif
