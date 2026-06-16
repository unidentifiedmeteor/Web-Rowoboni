<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Rowoboni</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;

            background:
            linear-gradient(rgba(0,0,0,.25),rgba(0,0,0,.25)),
            url('https://images.unsplash.com/photo-1506744038136-46273834b3fb');

            background-size:cover;
            background-position:center;
        }

        .login-card{
            width:500px;
            padding:40px;

            background:rgba(255,255,255,.18);
            backdrop-filter:blur(15px);

            border:1px solid rgba(255,255,255,.3);

            border-radius:25px;
            box-shadow:0 15px 35px rgba(0,0,0,.25);
        }

        .logo{
            text-align:center;
            margin-bottom:25px;
        }

        .logo h1{
            font-size:42px;
            color:white;
            font-weight:700;
        }

        .logo p{
            color:white;
            font-size:20px;
            margin-top:10px;
        }

        .input-group{
            margin-bottom:20px;
        }

        .input-group label{
            display:block;
            color:white;
            margin-bottom:8px;
            font-weight:600;
        }

        .input-group input{
            width:100%;
            padding:15px;
            border:none;
            border-radius:12px;
            outline:none;
            font-size:16px;
        }

        .login-btn{
            width:100%;
            padding:15px;
            border:none;
            border-radius:12px;
            background:#28a745;
            color:white;
            font-size:18px;
            cursor:pointer;
            transition:.3s;
        }

        .login-btn:hover{
            background:#218838;
        }

        .copyright{
            text-align:center;
            color:white;
            margin-top:20px;
            font-size:14px;
        }
    </style>
</head>
<body>

<div class="login-card">

    <div class="logo">
        <h1>Desa Wisata Rowoboni</h1>
        <p>Login Admin</p>
    </div>

    @if(session('error'))
    <div style="
        background:red;
        color:white;
        padding:10px;
        margin-bottom:15px;
        border-radius:8px;
    ">
        {{ session('error') }}
    </div>
@endif

    <form method="POST" action="/admin/login">
    @csrf

        <div class="input-group">
            <label>Username</label>
            <input
                type="text"
                name="username"
                placeholder="Masukkan username"
                required
            >

        <div class="input-group">
            <label>Password</label>
           <input
                type="password"
                name="password"
                placeholder="Masukkan password"
                required
            >
        </div>

        <button class="login-btn">
            Login
        </button>

    </form>

    <div class="copyright">
        © 2026 Desa Wisata Rowoboni
    </div>

</div>

</body>
</html>