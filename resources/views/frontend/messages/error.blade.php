@if(session('error'))
    <p class="user-error-message">{{ session('error') }}</p>
@endif