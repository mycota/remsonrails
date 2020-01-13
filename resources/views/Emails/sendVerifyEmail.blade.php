


<h2>To activate your account, </h2><a href="{{ route('admin.users.emailSent', ['email' => $user->email, 'verifyToken' => $user->verifyToken] ) }}">Verify your email here {{ $user->email }}</a>