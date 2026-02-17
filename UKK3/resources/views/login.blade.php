<form action="/login-proses" method="POST">
    @csrf
    <h2>Login Admin</h2>
    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>