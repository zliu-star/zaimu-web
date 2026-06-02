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
            background-color: #FFFFFF; /* メイン背景は純白 */
            font-family: 'Segoe UI', 'Noto Sans JP', sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        /* =========================================
           2. 左側：ダークサイドバー（先輩のデザイン）
           ========================================= */
        .sidebar {
            width: 240px;
            background-color: #000000; /* 真っ黒な背景 */
            color: #FFFFFF;
            height: 100vh;
            padding: 20px 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        .logo-area {
            font-size: 18px;
            font-weight: bold;
            padding: 0 24px;
            margin-bottom: 40px;
            color: #FFFFFF;
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
            background-color: #1A202C; /* 少し明るい黒 */
            border-left: 4px solid #FFFFFF; /* 左側に白いアクセントライン */
            padding-left: 20px;
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

        /* パンくずリスト */
        .breadcrumb {
            font-size: 12px;
            color: #718096;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ページタイトル */
        .page-title {
            font-size: 20px;
            font-weight: bold;
            color: #1A202C;
            margin: 0 0 30px 0;
            padding-left: 12px;
            border-left: 5px solid #1A202C;
        }

        /* 検索エリアとボタン */
        .search-area {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 20px;
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

        /* 共通ボタンスタイル */
        .btn {
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            font-weight: bold;
            border: none;
            transition: 0.2s;
        }

        /* プライマリボタン（新規登録、登録） */
        .btn-primary {
            background-color: #1A202C; /* ダークなボタン */
            color: #FFFFFF;
        }

        .btn-primary:hover {
            background-color: #2D3748;
        }

        /* セカンダリボタン（戻る） */
        .btn-secondary {
            background-color: #EDF2F7;
            color: #4A5568;
        }

        .btn-secondary:hover {
            background-color: #E2E8F0;
        }

        /* データテーブル */
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

        /* =========================================
           4. 【新規】モーダル（Modal）のスタイル（image_13.pngを再現）
           ========================================= */
        /* モーダル全体のオーバーレイ（黒い半透明背景） */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: none; /* 初期状態は非表示 */
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* モーダルのカード部分 */
        .modal-card {
            background-color: #FFFFFF;
            width: 800px; /* image_13.pngに合わせた広めの幅 */
            border-radius: 8px;
            padding: 0; /* ヘッダーとフッターでパディングを調整 */
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            position: relative;
            display: flex;
            flex-direction: column;
        }

        /* モーダルヘッダー */
        .modal-header {
            padding: 20px 30px;
            font-size: 16px;
            font-weight: bold;
            border-bottom: 1px solid #EEE;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* 閉じるボタン（Xアイコン） */
        .modal-close-icon {
            cursor: pointer;
            color: #A0AEC0;
            font-size: 20px;
            background: none;
            border: none;
            padding: 0;
        }

        /* モーダルボディ（入力フォームエリア） */
        .modal-body {
            padding: 30px;
            display: grid;
            grid-template-columns: 1fr 1fr; /* 2列レイアウト */
            gap: 20px 30px;
        }

        /* 入力項目のグループ */
        .form-group {
            display: flex;
            flex-direction: column;
        }

        /* ラベルと必須マーク */
        .form-label-row {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 8px;
        }

        .form-label {
            font-size: 12px;
            font-weight: bold;
            color: #1A202C;
        }

        .label-required {
            color: #E53E3E; /* 赤色の「必須」マーク */
            font-size: 10px;
        }

        /* 入力フィールド */
        .form-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #CBD5E0;
            border-radius: 4px;
            font-size: 14px;
            color: #2D3748;
            box-sizing: border-box;
        }

        /* フィールド内のXアイコン（クリアボタン） */
        .field-clear-icon {
            position: absolute;
            right: 12px;
            color: #A0AEC0;
            cursor: pointer;
            font-size: 16px;
        }

        /* ラジオボタン（有効/無効） */
        .radio-group {
            display: flex;
            gap: 20px;
            align-items: center;
            margin-top: 10px;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        /* モーダルフッター（ボタンエリア） */
        .modal-footer {
            padding: 20px 30px;
            border-top: 1px solid #EEE;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            background-color: #F8FAFC;
            border-radius: 0 0 8px 8px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="logo-area">Zaimu System</div>
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
            <div class="search-input-wrapper">
                🔍 <input type="text" placeholder="ラネックス">
            </div>
            <button class="btn btn-primary" id="openModalBtn">新規登録</button>
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

    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-card">
            
            <div class="modal-header">
                <span>新規登録</span>
                <button class="modal-close-icon" id="headerCloseBtn">×</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="form-label-row">
                        <span class="form-label">顧客名</span>
                        <span class="label-required">必須</span>
                    </div>
                    <div class="form-input-wrapper">
                        <input type="text" class="form-input" placeholder="例）ラネックス">
                        <span class="field-clear-icon">⊗</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-row">
                        <span class="form-label">顧客名（英語）</span>
                        <span class="label-required">必須</span>
                    </div>
                    <div class="form-input-wrapper">
                        <input type="text" class="form-input" placeholder="例）Lanex">
                        <span class="field-clear-icon">⊗</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-row">
                        <span class="form-label">請求先会社名</span>
                        <span class="label-required">必須</span>
                    </div>
                    <div class="form-input-wrapper">
                        <input type="text" class="form-input" placeholder="例）株式会社ラネックス">
                        <span class="field-clear-icon">⊗</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-row">
                        <span class="form-label">請求先会社名（英語）</span>
                        <span class="label-required">必須</span>
                    </div>
                    <div class="form-input-wrapper">
                        <input type="text" class="form-input" placeholder="例）Lanex Corporation">
                        <span class="field-clear-icon">⊗</span>
                    </div>
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <div class="form-label-row">
                        <span class="form-label">有効/無効</span>
                        <span class="label-required">必須</span>
                    </div>
                    <div class="radio-group">
                        <label class="radio-item"><input type="radio" name="status" checked> 有効</label>
                        <label class="radio-item"><input type="radio" name="status"> 無効</label>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" id="footerBackBtn">戻る</button>
                <button class="btn btn-primary">登録</button>
            </div>
        </div>
    </div>

    <script>
        // 要素の取得
        const openModalBtn = document.getElementById('openModalBtn');
        const modalOverlay = document.getElementById('modalOverlay');
        const headerCloseBtn = document.getElementById('headerCloseBtn');
        const footerBackBtn = document.getElementById('footerBackBtn');

        // モーダルを開く関数
        const openModal = () => {
            modalOverlay.style.display = 'flex';
        };

        // モーダルを閉じる関数
        const closeModal = () => {
            modalOverlay.style.display = 'none';
        };

        // イベントリスナーの登録
        openModalBtn.addEventListener('click', openModal);     // 新規登録ボタン
        headerCloseBtn.addEventListener('click', closeModal);  // ヘッダーの×ボタン
        footerBackBtn.addEventListener('click', closeModal);   // フッターの戻るボタン

        // オーバーレイ（黒い背景部分）をクリックした時も閉じる
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                closeModal();
            }
        });
    </script>
</body>
</html>