<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Zaimu - ログイン</title>
    <style>
        /* 1. 整体背景设置 */
        body {
            margin: 0;
            padding: 0;
            background-color: #F5F7FA; /* 你在 Figma 选定的高级灰背景色 */
            height: 100vh; /* 让背景撑满整个屏幕的高度 */
            display: flex; /* 使用现代网页最常用的 Flex 布局 */
            justify-content: center; /* 水平居中 */
            align-items: center; /* 垂直居中 */
            font-family: 'Segoe UI', 'Noto Sans JP', sans-serif; /* 无衬线字体，显得现代 */
        }

        /* 2. 中间的白色卡片 */
        .login-card {
            background-color: #FFFFFF;
            width: 360px; /* 卡片宽度 */
            padding: 60px 40px; /* 上下左右留出呼吸空间 */
            border-radius: 12px; /* 圆角大小 */
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05); /* Figma 里的轻微阴影（ドロップシャドウ） */
            text-align: center;
        }

        /* 3. 系统标题文字 */
        .system-title {
            color: #2D3748; /* 炭灰色标题 */
            font-size: 28px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 40px;
        }

        /* 4. 登录按钮 */
        .btn-google {
            background-color: #2D3748; /* 按钮底色 */
            color: #FFFFFF; /* 文字颜色纯白 */
            border: none; /* 去掉默认边框 */
            border-radius: 6px;
            padding: 14px 24px;
            font-size: 16px;
            font-weight: bold;
            width: 100%; /* 按钮宽度占满整个卡片 */
            cursor: pointer; /* 鼠标放上去变成小手 */
            transition: background-color 0.2s; /* 颜色渐变动画 */
        }

        /* 鼠标悬浮在按钮上时的效果 */
        .btn-google:hover {
            background-color: #1A202C; /* 颜色变深一点点 */
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h1 class="system-title">Zaimu</h1>
        <button class="btn-google">Googleでログイン</button>
    </div>

</body>
</html>