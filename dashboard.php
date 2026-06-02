<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>顧客情報 - 検索・一覧</title>
    <style>
        /* =========================================
           1. 全体のリセットとベースレイアウト
           ========================================= */
        body {
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #FFFFFF; /* 先輩のデザインはメイン背景が純白 */
            font-family: 'Segoe UI', 'Noto Sans JP', sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        /* =========================================
           2. 左側：ダークサイドバー（先輩のデザイン）
           ========================================= */
        .sidebar {
            width: 240px;
            background-color: #000000; /* 先輩の真っ黒な背景 */
            color: #FFFFFF;
            height: 100vh;
            padding: 20px 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        .menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
        }

        .menu-item {
            width: 100%;
        }

        .menu-link {
            text-decoration: none;
            color: #A0AEC0; /* グレーの文字 */
            font-size: 14px;
            display: block;
            padding: 16px 24px;
            transition: 0.2s;
        }

        .menu-link:hover {
            color: #FFFFFF;
        }

        /* 選択されているメニュー */
        .menu-link.active {
            color: #FFFFFF;
            font-weight: bold;
            background-color: #1A202C; /* 少し明るい黒で選択状態を表現 */
            border-left: 4px solid #FFFFFF; /* 左側に白いアクセントライン */
            padding-left: 20px; /* ボーダー分パディングを調整 */
        }

        /* =========================================
           3. 右側：メインコンテンツ領域
           ========================================= */
        .main-content {
            flex: 1;
            padding: 30px 40px;
            box-sizing: border-box;
            overflow-y: auto;
        }

        /* パンくずリスト（Breadcrumb） */
        .breadcrumb {
            font-size: 12px;
            color: #718096;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ページタイトル（左に黒い縦線があるデザイン） */
        .page-title {
            font-size: 20px;
            font-weight: bold;
            color: #1A202C;
            margin: 0 0 30px 0;
            padding-left: 12px;
            border-left: 5px solid #1A202C; /* 先輩のデザインのアクセント */
        }

        /* =========================================
           4. 検索エリアとボタン
           ========================================= */
        .search-area {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 20px;
        }

        .search-box {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .search-label {
            font-size: 12px;
            font-weight: bold;
            color: #1A202C;
        }

        .search-input-wrapper {
            display: flex;
            align-items: center;
            border: 1px solid #CBD5E0;
            border-radius: 4px;
            padding: 8px 12px;
            width: 300px;
        }

        .search-input-wrapper input {
            border: none;
            outline: none;
            font-size: 14px;
            width: 100%;
            margin-left: 8px;
        }

        .btn-primary {
            background-color: #1A202C; /* ダークブルー/ブラックのボタン */
            color: #FFFFFF;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            font-weight: bold;
        }

        /* =========================================
           5. データテーブル（先輩の高コントラスト版）
           ========================================= */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .data-table th {
            background-color: #1A202C; /* ダークなヘッダー */
            color: #FFFFFF;
            padding: 12px 16px;
            text-align: left;
            font-weight: normal;
        }

        .data-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #E2E8F0;
            color: #2D3748;
        }

    </style>
</head>
<body>

    <div class="sidebar">
        <ul class="menu-list">
            <li class="menu-item"><a href="#" class="menu-link">請求書発行・一覧</a></li>
            <li class="menu-item"><a href="#" class="menu-link">見積書発行・一覧</a></li>
            <li class="menu-item"><a href="#" class="menu-link active">顧客情報検索・一覧</a></li>
        </ul>
    </div>

    <div class="main-content">
        
        <div class="breadcrumb">
            <span>🏠 顧客情報</span> <span>></span> <span>顧客情報 - 検索・一覧</span>
        </div>

        <h2 class="page-title">顧客情報 - 検索・一覧</h2>

        <div class="search-area">
            <div class="search-box">
                <span class="search-label">顧客名</span>
                <div class="search-input-wrapper">
                    <span style="color: #A0AEC0;">🔍</span>
                    <input type="text" placeholder="ラネックス">
                    <span style="color: #A0AEC0; cursor: pointer;">ⓧ</span>
                </div>
            </div>
            
            <button class="btn-primary">新規登録</button>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>顧客名</th>
                    <th>顧客名（正式名称）</th>
                    <th>有効/無効</th>
                    <th>処理</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ラネックス</td>
                    <td>株式会社ラネックス</td>
                    <td>有効</td>
                    <td>...</td>
                </tr>
            </tbody>
        </table>

    </div>

</body>
</html>