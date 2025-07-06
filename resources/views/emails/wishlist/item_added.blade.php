<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Wishlist Item Added</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }
        
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .email-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 20%, transparent 20%);
            background-size: 30px 30px;
            animation: float 20s linear infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(-20px) rotate(360deg); }
        }
        
        .email-header h1 {
            color: white;
            font-size: 2.2em;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
            position: relative;
            z-index: 1;
        }
        
        .email-header .subtitle {
            color: rgba(255,255,255,0.9);
            font-size: 1.1em;
            font-weight: 300;
            position: relative;
            z-index: 1;
        }
        
        .email-content {
            padding: 40px 30px;
        }
        
        .wishlist-item {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 15px;
            padding: 30px;
            margin: 30px 0;
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }
        
        .wishlist-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }
        
        .item-title {
            color: #2d3748;
            font-size: 1.8em;
            font-weight: 700;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .item-title::before {
            content: '✨';
            font-size: 1.2em;
        }
        
        .item-description {
            color: #4a5568;
            font-size: 1.1em;
            margin-bottom: 20px;
            line-height: 1.7;
        }
        
        .item-price {
            display: inline-block;
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 1.2em;
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
        }
        
        .cta-section {
            text-align: center;
            margin: 40px 0;
        }
        
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            text-decoration: none;
            padding: 18px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1em;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .cta-button:hover::before {
            left: 100%;
        }
        
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.5);
        }
        
        .email-footer {
            background: #f8fafc;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            color: #718096;
        }
        
        .email-footer p {
            margin-bottom: 10px;
        }
        
        .app-name {
            font-weight: 700;
            color: #4a5568;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .intro-text {
            font-size: 1.1em;
            color: #4a5568;
            margin-bottom: 30px;
            text-align: center;
        }
        
        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 15px;
            }
            
            .email-header {
                padding: 30px 20px;
            }
            
            .email-header h1 {
                font-size: 1.8em;
            }
            
            .email-content {
                padding: 30px 20px;
            }
            
            .wishlist-item {
                padding: 25px 20px;
            }
            
            .item-title {
                font-size: 1.5em;
            }
            
            .cta-button {
                padding: 15px 30px;
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Hello {{ $name }}! 👋</h1>
            <p class="subtitle">I've got something exciting to share with you</p>
        </div>
        
        <div class="email-content">
            <p class="intro-text">I've just added a new item to my personal wishlist. Thought you might like to check it out!</p>
            
            <div class="wishlist-item">
                <h2 class="item-title">{{ $item->title }}</h2>
                
                @if($item->description)
                    <p class="item-description">{{ $item->description }}</p>
                @endif
                
                @if($item->price)
                    <div class="item-price">
                        💰 M{{ number_format($item->price, 2) }}
                    </div>
                @endif
            </div>
            
            <div class="cta-section">
                <a href="{{ route('wishlist.public') }}" class="cta-button">
                    🎁 View My Complete Wishlist
                </a>
            </div>
        </div>
        
        <div class="email-footer">
            <p>Thanks for your amazing support!</p>
            <p class="app-name">{{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>