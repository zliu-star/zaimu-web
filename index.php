<?php
// -------------------------------------------------------------------------
// 1. バックエンド処理（JavaのServletやControllerに相当する部分）
// -------------------------------------------------------------------------

// フォームからPOSTリクエスト（ボタンクリック）が届いたか判定
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 【重要】本来はここでGoogle OAuthの認証APIを呼び出しますが、
    // まずは第一段階として、ダミーでログイン成功とし、メイン画面へ遷移させます。
    
    // Javaの response.sendRedirect("dashboard.php") と同じリダイレクト処理
    header("Location: dashboard.php");
    exit; // リダイレクト後は以降のコードを実行させないために必須
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Zaimu - ログイン</title>
    <style>
        /* 全体の背景設定 */
        body {
            margin: 0;
            padding: 0;
            background-color: #F5F7FA; /* Figmaで設定した高級感のあるグレー */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', 'Noto Sans JP', sans-serif;
        }

        /* 中央の白いログインカード */
        .login-card {
            background-color: #FFFFFF;
            width: 360px;
            padding: 60px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05); /* 柔らかなドロップシャドウ */
            text-align: center;
        }

        /* システムのタイトル */
        .system-title {
            color: #2D3748; /* チャコールグレー */
            font-size: 28px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 40px;
        }

        /* Googleログインボタン */
        .btn-google {
            background-color: #2D3748;
            color: #FFFFFF;
            border: none;
            border-radius: 6px;
            padding: 14px 24px;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        /* ホバー時の視覚効果 */
        .btn-google:hover {
            background-color: #1A202C;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h1 class="system-title">Zaimu</h1>
        
        <form method="POST" action="">
            <button type="submit" class="btn-google">Googleでログイン</button>
        </form>
    </div>

</body>
</html>