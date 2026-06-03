<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Zaimu System</title>
    <style>
        /* =========================================
           1. 全体のリセットとベースレイアウト
           ========================================= */
        body {
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #FFFFFF;
            font-family: 'Segoe UI', 'Noto Sans JP', sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        /* =========================================
           2. 左側：ダークサイドバー
           ========================================= */
        .sidebar {
            width: 240px;
            background-color: #000000;
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
            color: #A0AEC0;
            font-size: 14px;
            display: block;
            padding: 16px 24px;
            transition: 0.2s;
            cursor: pointer;
        }

        .menu-link:hover {
            color: #FFFFFF;
        }

        .menu-link.active {
            color: #FFFFFF;
            font-weight: bold;
            background-color: #1A202C;
            border-left: 4px solid #FFFFFF;
            padding-left: 20px;
        }

        /* =========================================
           3. 右側：メインコンテンツ領域（ビュー切り替え）
           ========================================= */
        .main-content {
            flex: 1;
            padding: 30px 40px;
            box-sizing: border-box;
            overflow-y: auto;
            background-color: #F5F7FA; /* コンテンツエリア背景 */
        }

        /* 初期状態では請求書と見積書のエリアを非表示にする */
        .view-section {
            display: none;
        }
        
        /* activeクラスがついたセクションのみ表示 */
        .view-section.active {
            display: block;
        }

        .breadcrumb {
            font-size: 12px;
            color: #718096;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-title {
            font-size: 20px;
            font-weight: bold;
            color: #1A202C;
            margin: 0 0 30px 0;
            padding-left: 12px;
            border-left: 5px solid #1A202C;
        }

        /* -----------------------------------------
           共通カード・ボタンスタイル
           ----------------------------------------- */
        .content-card {
            background-color: #FFFFFF;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            min-height: 600px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            font-weight: bold;
            border: none;
            transition: 0.2s;
        }

        .btn-primary {
            background-color: #1A202C;
            color: #FFFFFF;
        }

        .btn-primary:hover {
            background-color: #2D3748;
        }

        .btn-secondary {
            background-color: #EDF2F7;
            color: #4A5568;
        }

        .btn-secondary:hover {
            background-color: #E2E8F0;
        }

        .btn-danger {
            background-color: #E53E3E;
            color: #FFFFFF;
        }

        /* -----------------------------------------
           検索エリアとデータテーブル（顧客一覧用）
           ----------------------------------------- */
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
            background-color: #FFFFFF;
        }

        .search-input-wrapper input {
            border: none;
            outline: none;
            font-size: 14px;
            width: 100%;
            margin-left: 8px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            background-color: #FFFFFF;
        }

        .data-table th {
            background-color: #1A202C;
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

        /* -----------------------------------------
           請求书・見積書画面用の独自スタイル
           ----------------------------------------- */
        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-row label {
            width: 120px;
            color: #4A5568;
            font-size: 14px;
            font-weight: bold;
        }

        .form-row input, .form-row select {
            flex: 1;
            padding: 10px 12px;
            border: 1px solid #CBD5E0;
            border-radius: 4px;
            font-size: 14px;
            color: #2D3748;
            outline: none;
        }

        .form-columns {
            display: flex;
            gap: 60px;
            margin-top: 30px;
        }

        .form-col {
            flex: 1;
        }

        .form-section-title {
            font-size: 16px;
            font-weight: bold;
            color: #1A202C;
            margin-bottom: 20px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
        }

        .invoice-table th {
            background-color: #F8FAFC;
            padding: 14px;
            text-align: left;
            color: #2D3748;
            font-size: 14px;
            border-bottom: 1px solid #E2E8F0;
        }

        .invoice-table td {
            padding: 14px;
            border-bottom: 1px solid #F1F5F9;
            font-size: 14px;
            color: #4A5568;
        }

        .invoice-table tbody tr:nth-child(even) {
            background-color: #F8FAFC;
        }

        .text-right {
            text-align: right !important;
        }

        .action-area {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        /* =========================================
           4. モーダル（Modal）のスタイル
           ========================================= */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-card {
            background-color: #FFFFFF;
            width: 800px;
            border-radius: 8px;
            padding: 0;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .modal-header {
            padding: 20px 30px;
            font-size: 16px;
            font-weight: bold;
            border-bottom: 1px solid #EEE;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-close-icon {
            cursor: pointer;
            color: #A0AEC0;
            font-size: 20px;
            background: none;
            border: none;
            padding: 0;
        }

        .modal-body {
            padding: 30px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 30px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

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
            color: #E53E3E;
            font-size: 10px;
        }

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

        .field-clear-icon {
            position: absolute;
            right: 12px;
            color: #A0AEC0;
            cursor: pointer;
            font-size: 16px;
        }

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
            <li class="menu-item"><a class="menu-link" data-target="invoice-view">請求書発行・一覧</a></li>
            <li class="menu-item"><a class="menu-link" data-target="quote-view">見積書発行・一覧</a></li>
            <li class="menu-item"><a class="menu-link active" data-target="customer-view">顧客情報検索・一覧</a></li>
        </ul>
    </div>

    <div class="main-content">
        
        <div id="customer-view" class="view-section active">
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

            <table class="data-table" id="customerTable">
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

        <div id="invoice-view" class="view-section">
            <div class="breadcrumb">
                <span>🏠 請求業務</span> <span>></span> <span>請求書 新規作成</span>
            </div>
            <div class="content-card">
                <h2 class="page-title">請求書 新規作成</h2>
                
                <div style="width: 50%;">
                    <div class="form-row">
                        <label>発行先</label>
                        <select id="invoiceTargetSelect">
                            <option>株式会社ラネックス</option>
                        </select>
                    </div>
                </div>

                <div class="form-columns">
                    <div class="form-col">
                        <div class="form-section-title">請求書項目</div>
                        <div class="form-row"><label>請求No</label><input type="text" placeholder="LNX26-..."></div>
                        <div class="form-row"><label>請求書日付</label><input type="date"></div>
                        <div class="form-row"><label>支払い期限</label><input type="date"></div>
                    </div>
                    <div class="form-col">
                        <div class="form-section-title">注文書項目</div>
                        <div class="form-row"><label>見積No</label><input type="text"></div>
                        <div class="form-row"><label>納期</label><input type="date"></div>
                        <div class="form-row"><label>納入場所</label><input type="text"></div>
                        <div class="form-row"><label>お支払い条件</label><input type="text"></div>
                    </div>
                </div>

                <table class="invoice-table">
                    <thead>
                        <tr>
                            <th>品名</th>
                            <th class="text-right">数量</th>
                            <th class="text-right">単位</th>
                            <th class="text-right">単価</th>
                            <th class="text-right">金額</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>請求書システム開発</td>
                            <td class="text-right">1</td>
                            <td class="text-right">式</td>
                            <td class="text-right">500,000</td>
                            <td class="text-right">500,000</td>
                        </tr>
                        <tr>
                            <td>サーバー構築費用</td>
                            <td class="text-right">1</td>
                            <td class="text-right">式</td>
                            <td class="text-right">100,000</td>
                            <td class="text-right">100,000</td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td></tr>
                        <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td></tr>
                    </tbody>
                </table>

                <div class="action-area">
                    <button class="btn btn-danger">削 除</button>
                    <button class="btn btn-primary" style="background-color: #2C5282;">保 存</button>
                </div>
            </div>
        </div>

        <div id="quote-view" class="view-section">
            <div class="breadcrumb">
                <span>🏠 見積業務</span> <span>></span> <span>見積書 新規作成</span>
            </div>
            <div class="content-card">
                <h2 class="page-title">見積書 新規作成</h2>
                <p style="color: #718096;">見積書画面のコンテンツ（必要に応じて請求书画面と同様の項目を配置可能です）</p>
            </div>
        </div>

    </div>

    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-card">
            <div class="modal-header">
                <span>新規登録</span>
                <button class="modal-close-icon" id="headerCloseBtn">×</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="form-label-row"><span class="form-label">顧客名</span><span class="label-required">必須</span></div>
                    <div class="form-input-wrapper">
                        <input type="text" id="inputCustomerName" class="form-input" placeholder="例）ラネックス">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-row"><span class="form-label">顧客名（英語）</span><span class="label-required">必須</span></div>
                    <div class="form-input-wrapper">
                        <input type="text" class="form-input" placeholder="例）Lanex">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-row"><span class="form-label">請求先会社名</span><span class="label-required">必須</span></div>
                    <div class="form-input-wrapper">
                        <input type="text" id="inputCompanyName" class="form-input" placeholder="例）株式会社ラネックス">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-row"><span class="form-label">請求先会社名（英語）</span><span class="label-required">必須</span></div>
                    <div class="form-input-wrapper">
                        <input type="text" class="form-input" placeholder="例）Lanex Corporation">
                    </div>
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <div class="form-label-row"><span class="form-label">有効/無効</span><span class="label-required">必須</span></div>
                    <div class="radio-group">
                        <label class="radio-item"><input type="radio" name="status" value="有効" checked> 有効</label>
                        <label class="radio-item"><input type="radio" name="status" value="無効"> 無効</label>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" id="footerBackBtn">戻る</button>
                <button class="btn btn-primary" id="submitRegisterBtn">登録</button>
            </div>
        </div>
    </div>

    <script>
        // --- 1. サイドバーによる画面切り替え処理 ---
        const menuLinks = document.querySelectorAll('.menu-link');
        const viewSections = document.querySelectorAll('.view-section');

        menuLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                // サイドバーのアクティブ表示切り替え
                menuLinks.forEach(item => item.classList.remove('active'));
                link.classList.add('active');

                // コンテンツエリアの表示切り替え
                const targetId = link.getAttribute('data-target');
                viewSections.forEach(section => {
                    section.classList.remove('active');
                    if (section.id === targetId) {
                        section.classList.add('active');
                    }
                });
            });
        });

        // --- 2. モーダルの開閉処理 ---
        const openModalBtn = document.getElementById('openModalBtn');
        const modalOverlay = document.getElementById('modalOverlay');
        const headerCloseBtn = document.getElementById('headerCloseBtn');
        const footerBackBtn = document.getElementById('footerBackBtn');

        const openModal = () => { modalOverlay.style.display = 'flex'; };
        const closeModal = () => { modalOverlay.style.display = 'none'; };

        openModalBtn.addEventListener('click', openModal);
        headerCloseBtn.addEventListener('click', closeModal);
        footerBackBtn.addEventListener('click', closeModal);

        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) closeModal();
        });

        // --- 3. 新規登録のモックアップ動作（JavaScriptで動的に行を追加） ---
        const submitRegisterBtn = document.getElementById('submitRegisterBtn');
        const customerTableBody = document.querySelector('#customerTable tbody');
        const invoiceTargetSelect = document.getElementById('invoiceTargetSelect');

        submitRegisterBtn.addEventListener('click', () => {
            const customerName = document.getElementById('inputCustomerName').value;
            const companyName = document.getElementById('inputCompanyName').value;
            const statusValue = document.querySelector('input[name="status"]:checked').value;

            if (!customerName || !companyName) {
                alert('必須項目を入力してください。');
                return;
            }

            // 顧客情報テーブルに新しい行を挿入
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${customerName}</td>
                <td>${companyName}</td>
                <td>${statusValue}</td>
                <td>...</td>
            `;
            customerTableBody.appendChild(newRow);

            // 請求書画面の発行先セレクトボックスにも同期して選択肢を追加
            const newOption = document.createElement('option');
            newOption.textContent = companyName;
            invoiceTargetSelect.appendChild(newOption);

            // フォームの値をリセットしてモーダルを閉じる
            document.getElementById('inputCustomerName').value = '';
            document.getElementById('inputCompanyName').value = '';
            closeModal();
        });
    </script>
</body>
</html>