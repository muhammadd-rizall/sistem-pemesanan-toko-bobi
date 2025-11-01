<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Reset Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            max-width: 500px;
            width: 100%;
            overflow: hidden;
        }

        .header {
            background: #ffffff;
            border-bottom: 1px solid #e0e0e0;
            padding: 30px 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 14px;
            color: #666;
        }

        .content {
            padding: 40px;
        }

        .otp-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .otp-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #999;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .otp-code {
            font-size: 48px;
            font-weight: 700;
            color: #7eb17e;
            letter-spacing: 0.3em;
            font-family: 'Courier New', monospace;
            margin-bottom: 15px;
        }

        .otp-note {
            font-size: 13px;
            color: #999;
        }

        .info-box {
            background: #fafafa;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .info-box p {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin: 0;
        }

        .info-box strong {
            color: #1a1a1a;
            font-weight: 600;
        }

        .divider {
            height: 1px;
            background: #e0e0e0;
            margin: 30px 0;
        }

        .footer {
            text-align: center;
        }

        .footer p {
            font-size: 12px;
            color: #999;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Reset Password</h1>
            <p>Verifikasi Kode OTP</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- OTP Section -->
            <div class="otp-section">
                <div class="otp-label">Kode Verifikasi</div>
                <div class="otp-code">{{ $otp }}</div>
                <p class="otp-note">Gunakan kode ini untuk melanjutkan reset password</p>
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <p><strong>Masa Berlaku:</strong> Kode ini berlaku selama 10 menit.</p>
            </div>

            <div class="info-box">
                <p><strong>Catatan Keamanan:</strong> Jika Anda tidak meminta reset password, abaikan email ini.</p>
            </div>

            <!-- Divider -->
            <div class="divider"></div>

            <!-- Footer -->
            <div class="footer">
                <p>Email ini dikirim secara otomatis, mohon tidak membalas.</p>
                <p>&copy; {{ date('Y') }} Website Anda. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
