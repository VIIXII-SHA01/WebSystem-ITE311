<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
        }

        .background-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            animation: drift 20s infinite ease-in-out;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            top: 60%;
            right: 15%;
            animation-delay: 5s;
        }

        .shape:nth-child(3) {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            bottom: 20%;
            left: 20%;
            animation-delay: 10s;
        }

        @keyframes drift {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }

        .container {
            text-align: center;
            color: white;
            max-width: 600px;
            position: relative;
            z-index: 1;
        }

        .illustration {
            width: 200px;
            height: 200px;
            margin: 0 auto 30px;
            position: relative;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(5deg); }
        }

        .illustration svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 10px 30px rgba(0,0,0,0.3));
        }

        h1 {
            font-size: 140px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 5px 20px rgba(0,0,0,0.3);
            letter-spacing: -3px;
            background: linear-gradient(45deg, #fff, rgba(255,255,255,0.8));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        h2 {
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 20px;
            opacity: 0.95;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 40px;
        }

        .buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        button {
            padding: 14px 32px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: white;
            color: #f5576c;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .btn-secondary {
            background: rgba(255,255,255,0.2);
            color: white;
            backdrop-filter: blur(10px);
        }

        .btn-secondary:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }

        @media (max-width: 600px) {
            h1 { font-size: 90px; }
            h2 { font-size: 26px; }
            p { font-size: 16px; }
            .illustration { width: 150px; height: 150px; }
        }
    </style>
</head>
<body>
    <div class="background-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="container">
        <div class="illustration">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10" stroke="white" stroke-width="2"/>
                <path d="M12 8V12" stroke="white" stroke-width="2" stroke-linecap="round"/>
                <circle cx="12" cy="16" r="1" fill="white"/>
                <path d="M8 8L16 16M16 8L8 16" stroke="white" stroke-width="2" stroke-linecap="round" opacity="0.3"/>
            </svg>
        </div>
        
        <h1>404</h1>
        <h2>Oops! Page Not Found</h2>
        <p>The page you're looking for seems to have wandered off into the digital void. It might have been moved, deleted, or never existed in the first place.</p>
        
        <div class="buttons">
            <button class="btn-primary" onclick="window.location.href='/'">Go Home</button>
            <button class="btn-secondary" onclick="window.history.back()">Go Back</button>
        </div>
    </div>
</body>
</html>