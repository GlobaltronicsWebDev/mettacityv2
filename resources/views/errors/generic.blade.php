<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - Mettacity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .error-container {
            background: white;
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 500px;
        }
        .error-icon {
            font-size: 80px;
            color: #667eea;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }
        p {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }
        .btn-home {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
            transition: transform 0.3s;
        }
        .btn-home:hover {
            transform: translateY(-3px);
            color: white;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">⚠️</div>
        <h1>Oops! Something went wrong</h1>
        <p>{{ $message ?? 'We encountered an unexpected error. Please try again later.' }}</p>
        <a href="{{ route('home') }}" class="btn-home">Go to Homepage</a>
    </div>
</body>
</html>
