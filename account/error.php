<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Insufficient Data - Safe Days</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #fef5f8 0%, #fff0f5 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .error-container {
        max-width: 600px;
        width: 100%;
    }

    .error-card {
        background: white;
        border-radius: 20px;
        padding: 50px 40px;
        box-shadow: 0 10px 40px rgba(236, 64, 122, 0.15);
        text-align: center;
    }

    .icon-wrapper {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #fff0f5 0%, #ffe0eb 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    .icon {
        font-size: 50px;
    }

    h1 {
        color: #EC407A;
        font-size: 2em;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .message {
        color: #666;
        font-size: 1.1em;
        line-height: 1.8;
        margin-bottom: 30px;
    }

    .requirements {
        background: linear-gradient(135deg, #fff9e6 0%, #fffef5 100%);
        border-left: 4px solid #ffc107;
        padding: 20px 25px;
        border-radius: 12px;
        text-align: left;
        margin-bottom: 30px;
    }

    .requirements h3 {
        color: #d68600;
        font-size: 1.1em;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .requirements ul {
        list-style: none;
        padding: 0;
    }

    .requirements li {
        color: #666;
        font-size: 0.95em;
        padding: 8px 0;
        padding-left: 30px;
        position: relative;
    }

    .requirements li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #4caf50;
        font-weight: bold;
        font-size: 1.2em;
    }

    .button-group {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn {
        padding: 14px 35px;
        font-size: 1em;
        font-weight: 600;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        font-family: 'Poppins', sans-serif;
    }

    .btn-primary {
        background: linear-gradient(135deg, #EC407A 0%, #ff6b9d 100%);
        color: white;
        box-shadow: 0 6px 20px rgba(236, 64, 122, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(236, 64, 122, 0.4);
    }

    .btn-secondary {
        background: white;
        color: #EC407A;
        border: 2px solid #EC407A;
    }

    .btn-secondary:hover {
        background: #fef5f8;
        transform: translateY(-2px);
    }

    .tip {
        margin-top: 25px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
        font-size: 0.9em;
        color: #666;
    }

    .tip strong {
        color: #EC407A;
    }

    @media (max-width: 600px) {
        .error-card {
            padding: 40px 25px;
        }

        h1 {
            font-size: 1.6em;
        }

        .message {
            font-size: 1em;
        }

        .button-group {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>
</head>
<body>

<div class="error-container">
    <div class="error-card">
        <div class="icon-wrapper">
            <div class="icon">📊</div>
        </div>

        <h1>Insufficient Cycle Data</h1>
        
        <p class="message">
            We need at least <strong>3 consecutive cycles</strong> to provide you with reliable fertility predictions.
        </p>

        <div class="requirements">
            <h3>💡 What You Need:</h3>
            <ul>
                <li>Record at least 3 complete menstrual cycles</li>
                <li>Each cycle should be between 21-35 days</li>
                <li>Provide both start date and next period start date</li>
                <li>Cycles should be consecutive (one after another)</li>
            </ul>
        </div>

        <div class="button-group">
            <a href="cycles.php" class="btn btn-primary">
                🌸 Try Again
            </a>
            
        </div>

        <div class="tip">
            <strong>Tip:</strong> The more cycles you record (up to 6), the more accurate your fertility predictions will be!
        </div>
    </div>
</div>

</body>
</html>