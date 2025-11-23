<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }

        .wrapper {
            max-width: 650px;
            margin: 0 auto;
        }

        .container {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        /* Header dengan gradient */
        .header {
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
            border-bottom: 4px solid #fbbf24;
        }

        .header-icon {
            font-size: 48px;
            margin-bottom: 15px;
            display: inline-block;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
            margin: 0;
        }

        /* Content area */
        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 18px;
            color: #1a1a1a;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .greeting strong {
            color: #000;
            font-weight: 700;
        }

        .intro-text {
            font-size: 14px;
            color: #555;
            margin-bottom: 30px;
            line-height: 1.8;
        }

        /* Subject Box */
        .subject-box {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            border-left: 5px solid #000;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .subject-icon {
            font-size: 24px;
            flex-shrink: 0;
        }

        .subject-text {
            flex: 1;
        }

        .subject-label {
            font-size: 11px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .subject-text strong {
            font-size: 16px;
            color: #1a1a1a;
            display: block;
        }

        /* Message Box */
        .message-box {
            background-color: #fafafa;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .message-label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .message {
            font-size: 15px;
            line-height: 1.8;
            color: #333;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        /* Contact Info */
        .contact-info {
            background-color: #f9fafb;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 30px;
            border: 1px solid #e5e7eb;
        }

        .contact-info h4 {
            font-size: 14px;
            color: #1a1a1a;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .contact-list {
            list-style: none;
        }

        .contact-list li {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
            padding-left: 25px;
            position: relative;
        }

        .contact-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #000;
            font-weight: bold;
        }

        .contact-list strong {
            color: #1a1a1a;
            font-weight: 600;
        }

        /* CTA Button */
        .cta-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            color: white;
            padding: 14px 32px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        /* Footer */
        .footer {
            background-color: #f3f4f6;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }

        .footer-brand {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
        }

        .footer-description {
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            color: white;
            text-decoration: none;
            border-radius: 50%;
            font-size: 16px;
            transition: transform 0.3s;
        }

        .social-links a:hover {
            transform: scale(1.15);
        }

        .footer-bottom {
            font-size: 12px;
            color: #999;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .content {
                padding: 25px 20px;
            }

            .header {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .greeting {
                font-size: 16px;
            }

            .message-box {
                padding: 20px;
            }

            .footer {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <!-- Header -->
            <div class="header">
                <div class="header-icon">📧</div>
                <h1>Balasan dari Klandest</h1>
                <p>Kami telah merespon pertanyaan Anda</p>
            </div>

            <!-- Main Content -->
            <div class="content">
                <!-- Greeting -->
                <div class="greeting">
                    Halo <strong>{{ $nama }}</strong>, 👋
                </div>

                <p class="intro-text">
                    Terima kasih telah menghubungi kami! Tim Klandest telah menerima pertanyaan Anda dan dengan senang hati memberikan respons berikut:
                </p>

                <!-- Subject Box -->
                <div class="subject-box">
                    <div class="subject-icon">📋</div>
                    <div class="subject-text">
                        <div class="subject-label">Topik</div>
                        <strong>{{ $subjek }}</strong>
                    </div>
                </div>

                <!-- Message Box -->
                <div class="message-box">
                    <div class="message-label">💬 Respons Kami</div>
                    <div class="message">{{ $reply }}</div>
                </div>

                <!-- Contact Info -->
                <div class="contact-info">
                    <h4>📞 Hubungi Kami Lagi</h4>
                    <ul class="contact-list">
                        <li><strong>Email:</strong> info@klandest.com</li>
                        <li><strong>WhatsApp:</strong> +62 812-3456-7890</li>
                        <li><strong>Website:</strong> www.klandest.com</li>
                    </ul>
                </div>

                <!-- CTA Button -->
                <div class="cta-section">
                    <a href="https://www.klandest.com" class="cta-button">Kunjungi Toko Kami</a>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <div class="footer-brand">🏪 Klandest</div>
                <p class="footer-description">Toko Online Terpercaya • Produk Berkualitas • Pengiriman Cepat</p>

                <div class="social-links">
                    <a href="https://www.instagram.com/klandest" title="Instagram">📷</a>
                    <a href="https://www.tiktok.com/@klandest" title="TikTok">🎵</a>
                    <a href="https://www.facebook.com/klandest" title="Facebook">f</a>
                </div>

                <div class="footer-bottom">
                    <p>© 2025 Klandest. Semua hak dilindungi.</p>
                    <p style="margin-top: 8px;">Email ini dikirim khusus untuk Anda. Jangan bagikan dengan orang lain.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>