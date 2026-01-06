<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ultimAItech - Professional Invoice</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f3f4f6;
            color: #333;
            line-height: 1.5;
            padding: 20px;
        }

        /* Login Screen */
        .login-screen {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a3e 50%, #2e1065 100%);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1000;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-box img {
            height: 60px;
            margin-bottom: 20px;
        }

        .login-box h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 8px;
        }

        .login-box p {
            color: #666;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .login-form .form-group {
            margin-bottom: 16px;
            text-align: left;
        }

        .login-form label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-bottom: 6px;
        }

        .login-form input {
            width: 100%;
            padding: 12px 16px;
            font-size: 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            transition: border-color 0.2s;
        }

        .login-form input:focus {
            outline: none;
            border-color: #6366f1;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }

        .login-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .login-error {
            color: #ef4444;
            font-size: 14px;
            margin-top: 12px;
            display: none;
        }

        /* App Container */
        .app-container {
            display: none;
        }

        .app-container.visible {
            display: block;
        }

        /* Top Navigation */
        .top-nav {
            max-width: 210mm;
            margin: 0 auto 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-tabs {
            display: flex;
            gap: 8px;
        }

        .nav-tab {
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            color: #666;
            background: none;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .nav-tab:hover {
            background: rgba(99, 102, 241, 0.1);
            color: #6366f1;
        }

        .nav-tab.active {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-email {
            font-size: 14px;
            color: #666;
        }

        .logout-btn {
            padding: 8px 16px;
            font-size: 14px;
            color: #ef4444;
            background: none;
            border: 1px solid #ef4444;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background: #ef4444;
            color: white;
        }

        /* Invoices List */
        .invoices-list {
            display: none;
            max-width: 210mm;
            margin: 0 auto;
        }

        .invoices-list.visible {
            display: block;
        }

        .invoices-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .invoices-header h2 {
            font-size: 24px;
            color: #333;
        }

        .new-invoice-btn {
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .new-invoice-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }

        .invoices-table {
            width: 100%;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .invoices-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoices-table th,
        .invoices-table td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        .invoices-table th {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .invoices-table tr:hover {
            background: rgba(99, 102, 241, 0.05);
        }

        .invoices-table .actions {
            display: flex;
            gap: 8px;
        }

        .invoices-table .action-btn {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 4px;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .action-btn.view {
            background: #6366f1;
            color: white;
        }

        .action-btn.delete {
            background: #fee2e2;
            color: #ef4444;
        }

        .action-btn:hover {
            transform: translateY(-1px);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-state p {
            margin-bottom: 20px;
        }

        /* Invoice Editor */
        .invoice-editor {
            display: none;
        }

        .invoice-editor.visible {
            display: block;
        }

        /* Main Invoice Container */
        .invoice-page {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            background: white;
            position: relative;
            padding: 15mm 20mm 25mm 20mm;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Header Section */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 15px;
            border-bottom: 3px solid #6366f1;
            margin-bottom: 20px;
        }

        .logo-section img {
            height: 90px;
            width: auto;
        }

        .invoice-title-section {
            text-align: right;
        }

        .invoice-title {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: #6366f1;
            margin-bottom: 8px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Language Selector */
        .lang-selector {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .lang-selector label {
            font-size: 14px;
            font-weight: 500;
            color: #666;
        }

        .lang-selector select {
            padding: 8px 12px;
            font-size: 14px;
            font-family: inherit;
            border: 2px solid #6366f1;
            border-radius: 8px;
            background: white;
            color: #333;
            cursor: pointer;
            min-width: 120px;
        }

        .lang-selector select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .invoice-number {
            font-size: 12px;
            color: #666;
        }

        /* Address Grid */
        .address-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 20px;
        }

        .address-block h4 {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6366f1;
            margin-bottom: 8px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 4px;
        }

        .address-block p {
            font-size: 11px;
            line-height: 1.6;
            color: #333;
        }

        /* Invoice Details */
        .invoice-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            padding: 12px;
            border-radius: 8px;
            border: 1px solid rgba(99, 102, 241, 0.15);
        }

        .detail-item label {
            display: block;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            color: #6366f1;
            margin-bottom: 4px;
        }

        .detail-item input {
            width: 100%;
            padding: 6px 8px;
            font-size: 11px;
            font-family: inherit;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            background: white;
            color: #333;
        }

        .detail-item input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1);
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 11px;
        }

        .items-table thead {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }

        .items-table th {
            padding: 10px 8px;
            text-align: left;
            font-weight: 600;
            color: white;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .items-table th:first-child {
            border-radius: 6px 0 0 0;
        }

        .items-table th:last-child {
            border-radius: 0 6px 0 0;
            text-align: right;
        }

        .items-table th.qty,
        .items-table th.rate,
        .items-table th.amount {
            text-align: right;
        }

        .items-table td {
            padding: 8px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .items-table tbody tr:hover {
            background: rgba(99, 102, 241, 0.02);
        }

        .items-table td.qty,
        .items-table td.rate,
        .items-table td.amount {
            text-align: right;
        }

        .items-table input[type="text"],
        .items-table input[type="number"] {
            width: 100%;
            padding: 5px 6px;
            font-size: 11px;
            font-family: inherit;
            border: 1px solid transparent;
            border-radius: 3px;
            background: transparent;
        }

        .items-table input[type="text"]:focus,
        .items-table input[type="number"]:focus {
            background: white;
            border-color: #6366f1;
            outline: none;
        }

        .items-table input[type="number"] {
            text-align: right;
        }

        .items-table td.description input {
            min-width: 200px;
        }

        /* Add Item Button */
        .add-item-btn {
            background: none;
            border: 1px dashed #6366f1;
            color: #6366f1;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 11px;
            font-weight: 500;
            margin-bottom: 15px;
            transition: all 0.2s ease;
        }

        .add-item-btn:hover {
            background: rgba(99, 102, 241, 0.05);
        }

        .remove-btn {
            background: none;
            border: none;
            color: #ef4444;
            cursor: pointer;
            font-size: 14px;
            padding: 2px 6px;
            opacity: 0.5;
            transition: opacity 0.2s;
        }

        .remove-btn:hover {
            opacity: 1;
        }

        /* Totals Section */
        .totals-section {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }

        .totals-box {
            width: 250px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            border-radius: 8px;
            padding: 12px;
            border: 1px solid rgba(99, 102, 241, 0.15);
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            font-size: 11px;
        }

        .total-row label {
            color: #666;
        }

        .total-row input {
            width: 100px;
            text-align: right;
            padding: 4px 6px;
            font-size: 11px;
            font-family: inherit;
            border: 1px solid transparent;
            border-radius: 3px;
            background: transparent;
        }

        .total-row input:focus {
            background: white;
            border-color: #6366f1;
            outline: none;
        }

        .total-row.grand-total {
            border-top: 2px solid #6366f1;
            margin-top: 8px;
            padding-top: 10px;
            font-weight: 700;
            font-size: 14px;
        }

        .total-row.grand-total label {
            color: #333;
        }

        .total-row.grand-total input {
            font-weight: 700;
            font-size: 14px;
            color: #6366f1;
        }

        /* Notes Section */
        .notes-section {
            margin-bottom: 15px;
        }

        .notes-section h4 {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6366f1;
            margin-bottom: 6px;
        }

        .notes-section textarea {
            width: 100%;
            min-height: 40px;
            padding: 8px;
            font-size: 10px;
            font-family: inherit;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            resize: vertical;
            line-height: 1.5;
        }

        .notes-section textarea:focus {
            outline: none;
            border-color: #6366f1;
        }

        /* Payment Info */
        .payment-section {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            padding: 12px;
            border-radius: 8px;
            border: 1px solid rgba(99, 102, 241, 0.15);
            margin-bottom: 15px;
        }

        .payment-section h4 {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6366f1;
            margin-bottom: 8px;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .payment-item label {
            display: block;
            font-size: 9px;
            font-weight: 500;
            color: #666;
            margin-bottom: 3px;
        }

        .payment-item input {
            width: 100%;
            padding: 5px 8px;
            font-size: 10px;
            font-family: inherit;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            background: white;
        }

        .payment-item input:focus {
            outline: none;
            border-color: #6366f1;
        }

        /* Footer */
        .invoice-footer {
            position: absolute;
            bottom: 10mm;
            left: 20mm;
            right: 20mm;
            padding-top: 10px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 8px;
            color: #999;
        }

        .footer-details {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        /* Controls Section */
        .controls {
            max-width: 210mm;
            margin: 0 auto 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .controls button {
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #6366f1;
            border: 2px solid #6366f1;
        }

        .btn-secondary:hover {
            background: rgba(99, 102, 241, 0.05);
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-success:hover {
            background: #059669;
        }

        /* Editable styling */
        [contenteditable="true"] {
            outline: none;
            border-radius: 2px;
            transition: background 0.2s;
        }

        [contenteditable="true"]:hover {
            background: rgba(99, 102, 241, 0.05);
        }

        [contenteditable="true"]:focus {
            background: rgba(99, 102, 241, 0.1);
        }

        /* Loading Overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .loading-overlay.visible {
            display: flex;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }

            .login-screen,
            .top-nav,
            .controls,
            .invoices-list {
                display: none !important;
            }

            .app-container,
            .invoice-editor {
                display: block !important;
            }

            .invoice-page {
                box-shadow: none;
                margin: 0;
                padding: 15mm 20mm 25mm 20mm;
            }

            .add-item-btn,
            .remove-btn {
                display: none !important;
            }

            .items-table input,
            .detail-item input,
            .total-row input,
            .payment-item input,
            .notes-section textarea {
                border: none !important;
                background: transparent !important;
            }

            .invoice-title {
                -webkit-text-fill-color: #6366f1 !important;
                background: none !important;
                color: #6366f1 !important;
            }
        }
    </style>
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <?php if (!$isLoggedIn): ?>
    <!-- Login Screen -->
    <div class="login-screen" id="loginScreen">
        <div class="login-box">
            <img src="logo-invoice.png" alt="ultimAItech">
            <h2>Invoice System</h2>
            <p>Sign in to access the invoice generator</p>
            
            <form class="login-form" id="loginForm">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="loginEmail" required placeholder="your@email.com">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="loginPassword" required placeholder="••••••••">
                </div>
                <button type="submit" class="login-btn" id="loginBtn">Sign In</button>
                <p class="login-error" id="loginError"></p>
            </form>
        </div>
    </div>
    <?php else: ?>
    <!-- App Container -->
    <div class="app-container visible" id="appContainer">
        <!-- Top Navigation -->
        <div class="top-nav">
            <div class="nav-tabs">
                <button class="nav-tab active" id="tabInvoices" onclick="showTab('invoices')">📋 Invoices</button>
                <button class="nav-tab" id="tabEditor" onclick="showTab('editor')">✏️ Editor</button>
            </div>
            <div class="user-info">
                <span class="user-email"><?php echo htmlspecialchars($userEmail); ?></span>
                <button class="logout-btn" onclick="logout()">Logout</button>
            </div>
        </div>

        <!-- Invoices List View -->
        <div class="invoices-list visible" id="invoicesList">
            <div class="invoices-header">
                <h2>Your Invoices</h2>
                <button class="new-invoice-btn" onclick="createNewInvoice()">+ New Invoice</button>
            </div>
            
            <div class="invoices-table">
                <table>
                    <thead>
                        <tr>
                            <th>Invoice #</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="invoicesTableBody">
                    </tbody>
                </table>
                <div class="empty-state" id="emptyState">
                    <p>No invoices yet. Create your first invoice!</p>
                    <button class="new-invoice-btn" onclick="createNewInvoice()">+ New Invoice</button>
                </div>
            </div>
        </div>

        <!-- Invoice Editor -->
        <div class="invoice-editor" id="invoiceEditor">
            <!-- Controls -->
            <div class="controls">
                <div class="lang-selector">
                    <label>🌐 Language:</label>
                    <select id="langSelect" onchange="changeLanguage(this.value)">
                        <option value="en">English</option>
                        <option value="de">Deutsch</option>
                        <option value="nl" selected>Nederlands</option>
                    </select>
                </div>
                <button class="btn-success" onclick="saveInvoice()">💾 Save Invoice</button>
                <button class="btn-primary" onclick="downloadPDF()">📄 Download PDF</button>
                <button class="btn-secondary" onclick="window.print()">🖨️ Print Invoice</button>
                <button class="btn-secondary" onclick="showTab('invoices')">← Back to List</button>
            </div>

            <!-- Invoice Page -->
            <div class="invoice-page" id="invoice">
                <!-- Header -->
                <div class="invoice-header">
                    <div class="logo-section">
                        <img src="logo-invoice.png" alt="ultimAItech">
                    </div>
                    <div class="invoice-title-section">
                        <div class="invoice-title">FACTUUR</div>
                        <div class="invoice-number">
                            <input type="text" id="invoiceNumber" value="" placeholder="Invoice Number" readonly>
                        </div>
                    </div>
                </div>

                <!-- Address Grid -->
                <div class="address-grid">
                    <div class="address-block">
                        <h4>Van</h4>
                        <p>
                            <strong>ultimAItech</strong><br>
                            Veneweg 199<br>
                            7946 LP Wanneperveen, NL<br>
                            info@ultimaitech.com<br>
                            www.ultimaitech.com
                        </p>
                    </div>
                    <div class="address-block">
                        <h4>Factuuradres</h4>
                        <p contenteditable="true" id="billTo">
                            <strong>Klantnaam</strong><br>
                            Bedrijfsnaam<br>
                            Adres<br>
                            Postcode, Plaats<br>
                            Land
                        </p>
                    </div>
                </div>

                <!-- Invoice Details -->
                <div class="invoice-details">
                    <div class="detail-item">
                        <label>Factuurdatum</label>
                        <input type="date" id="invoiceDate">
                    </div>
                    <div class="detail-item">
                        <label>Vervaldatum</label>
                        <input type="date" id="dueDate">
                    </div>
                    <div class="detail-item">
                        <label>Valuta</label>
                        <input type="text" id="currency" value="EUR" placeholder="EUR, USD, etc.">
                    </div>
                </div>

                <!-- Items Table -->
                <table class="items-table">
                    <thead>
                        <tr>
                            <th style="width: 40%">Omschrijving</th>
                            <th class="qty" style="width: 12%">Aantal</th>
                            <th class="rate" style="width: 18%">Prijs per stuk</th>
                            <th class="amount" style="width: 20%">Bedrag</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody id="itemsBody">
                        <tr class="item-row">
                            <td class="description"><input type="text" placeholder="Artikelomschrijving" onchange="calculateTotals()"></td>
                            <td class="qty"><input type="number" value="1" min="0" step="1" onchange="calculateTotals()"></td>
                            <td class="rate"><input type="number" value="0.00" min="0" step="0.01" onchange="calculateTotals()"></td>
                            <td class="amount"><input type="number" value="0.00" readonly></td>
                            <td><button class="remove-btn" onclick="removeRow(this)">×</button></td>
                        </tr>
                    </tbody>
                </table>

                <button class="add-item-btn" onclick="addItemRow()">+ Regel toevoegen</button>

                <!-- Totals -->
                <div class="totals-section">
                    <div class="totals-box">
                        <div class="total-row">
                            <label>Subtotaal</label>
                            <input type="text" id="subtotal" value="€0.00" readonly>
                        </div>
                        <div class="total-row">
                            <label>BTW (21%)</label>
                            <input type="text" id="vat" value="€0.00" readonly>
                        </div>
                        <div class="total-row grand-total">
                            <label>Totaal te betalen</label>
                            <input type="text" id="grandTotal" value="€0.00" readonly>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="notes-section">
                    <h4>Opmerkingen / Voorwaarden</h4>
                    <textarea id="notes" placeholder="Bedankt voor uw aankoop. De betaling dient binnen 30 dagen te worden voldaan.">Bedankt voor uw aankoop. De betaling dient binnen 30 dagen te worden voldaan.</textarea>
                </div>

                <!-- Payment Information -->
                <div class="payment-section">
                    <h4>Betalingsgegevens</h4>
                    <div class="payment-grid">
                        <div class="payment-item">
                            <label>Bank</label>
                            <input type="text" id="bankName" value="ING Bank" placeholder="Bank Name">
                        </div>
                        <div class="payment-item">
                            <label>IBAN</label>
                            <input type="text" id="iban" value="" placeholder="NL00 INGB 0000 0000 00">
                        </div>
                        <div class="payment-item">
                            <label>BIC/SWIFT</label>
                            <input type="text" id="bic" value="INGBNL2A" placeholder="BIC/SWIFT Code">
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="invoice-footer">
                    <div class="footer-details">
                        <span>KVK: 98782800</span>
                        <span>•</span>
                        <span>BTW: NL005353550860</span>
                        <span>•</span>
                        <span>Veneweg 199, 7946 LP Wanneperveen, Netherlands</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        // State
        let currentInvoiceId = null;
        let invoices = [];
        let currentLang = 'nl';

        // Translations
        const translations = {
            en: {
                invoice: 'INVOICE',
                from: 'From',
                billTo: 'Bill To',
                invoiceDate: 'Invoice Date',
                dueDate: 'Due Date',
                currency: 'Currency',
                description: 'Description',
                qty: 'Qty',
                unitPrice: 'Unit Price',
                amount: 'Amount',
                addLineItem: '+ Add Line Item',
                subtotal: 'Subtotal',
                vat: 'VAT (21%)',
                totalDue: 'Total Due',
                notesTerms: 'Notes / Terms',
                notesPlaceholder: 'Bedankt voor uw aankoop. De betaling dient binnen 30 dagen te worden voldaan.',
                paymentInfo: 'Payment Information',
                bankName: 'Bank Name',
                iban: 'IBAN',
                bic: 'BIC/SWIFT',
                itemPlaceholder: 'Item description',
                clientName: 'Client Name',
                companyName: 'Company Name',
                streetAddress: 'Street Address',
                cityPostal: 'City, Postal Code',
                country: 'Country'
            },
            de: {
                invoice: 'RECHNUNG',
                from: 'Von',
                billTo: 'Rechnungsadresse',
                invoiceDate: 'Rechnungsdatum',
                dueDate: 'Fälligkeitsdatum',
                currency: 'Währung',
                description: 'Beschreibung',
                qty: 'Menge',
                unitPrice: 'Einzelpreis',
                amount: 'Betrag',
                addLineItem: '+ Position hinzufügen',
                subtotal: 'Zwischensumme',
                vat: 'MwSt. (21%)',
                totalDue: 'Gesamtbetrag',
                notesTerms: 'Hinweise / Bedingungen',
                notesPlaceholder: 'Vielen Dank für Ihr Vertrauen. Zahlung ist innerhalb von 30 Tagen fällig.',
                paymentInfo: 'Zahlungsinformationen',
                bankName: 'Bank',
                iban: 'IBAN',
                bic: 'BIC/SWIFT',
                itemPlaceholder: 'Artikelbeschreibung',
                clientName: 'Kundenname',
                companyName: 'Firmenname',
                streetAddress: 'Straße',
                cityPostal: 'PLZ, Ort',
                country: 'Land'
            },
            nl: {
                invoice: 'FACTUUR',
                from: 'Van',
                billTo: 'Factuuradres',
                invoiceDate: 'Factuurdatum',
                dueDate: 'Vervaldatum',
                currency: 'Valuta',
                description: 'Omschrijving',
                qty: 'Aantal',
                unitPrice: 'Prijs per stuk',
                amount: 'Bedrag',
                addLineItem: '+ Regel toevoegen',
                subtotal: 'Subtotaal',
                vat: 'BTW (21%)',
                totalDue: 'Totaal te betalen',
                notesTerms: 'Opmerkingen / Voorwaarden',
                notesPlaceholder: 'Bedankt voor uw aankoop. De betaling dient binnen 30 dagen te worden voldaan.',
                paymentInfo: 'Betalingsgegevens',
                bankName: 'Bank',
                iban: 'IBAN',
                bic: 'BIC/SWIFT',
                itemPlaceholder: 'Artikelomschrijving',
                clientName: 'Klantnaam',
                companyName: 'Bedrijfsnaam',
                streetAddress: 'Adres',
                cityPostal: 'Postcode, Plaats',
                country: 'Land'
            }
        };

        <?php if (!$isLoggedIn): ?>
        // Login form handler
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            const errorEl = document.getElementById('loginError');
            const btn = document.getElementById('loginBtn');

            btn.disabled = true;
            btn.textContent = 'Signing in...';
            errorEl.style.display = 'none';

            try {
                const formData = new FormData();
                formData.append('action', 'login');
                formData.append('email', email);
                formData.append('password', password);

                const response = await fetch('auth.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (result.success) {
                    window.location.reload();
                } else {
                    errorEl.textContent = result.error || 'Invalid credentials';
                    errorEl.style.display = 'block';
                    btn.disabled = false;
                    btn.textContent = 'Sign In';
                }
            } catch (error) {
                errorEl.textContent = 'Connection error. Please try again.';
                errorEl.style.display = 'block';
                btn.disabled = false;
                btn.textContent = 'Sign In';
            }
        });
        <?php else: ?>
        // Logout
        async function logout() {
            const formData = new FormData();
            formData.append('action', 'logout');
            await fetch('auth.php', { method: 'POST', body: formData });
            window.location.reload();
        }

        // Load invoices from localStorage
        function loadInvoices() {
            const stored = localStorage.getItem('ultimaitech_invoices');
            invoices = stored ? JSON.parse(stored) : [];
            renderInvoicesList();
        }

        // Save invoices to localStorage
        function saveInvoicesToStorage() {
            localStorage.setItem('ultimaitech_invoices', JSON.stringify(invoices));
        }

        // Tab switching
        function showTab(tab) {
            document.getElementById('tabInvoices').classList.remove('active');
            document.getElementById('tabEditor').classList.remove('active');
            document.getElementById('invoicesList').classList.remove('visible');
            document.getElementById('invoiceEditor').classList.remove('visible');

            if (tab === 'invoices') {
                document.getElementById('tabInvoices').classList.add('active');
                document.getElementById('invoicesList').classList.add('visible');
                loadInvoices();
            } else {
                document.getElementById('tabEditor').classList.add('active');
                document.getElementById('invoiceEditor').classList.add('visible');
            }
        }

        // Render invoices list
        function renderInvoicesList() {
            const tbody = document.getElementById('invoicesTableBody');
            const emptyState = document.getElementById('emptyState');

            if (invoices.length === 0) {
                tbody.innerHTML = '';
                emptyState.style.display = 'block';
                return;
            }

            emptyState.style.display = 'none';
            tbody.innerHTML = invoices.map((inv, index) => `
                <tr>
                    <td><strong>${inv.invoiceNumber}</strong></td>
                    <td>${inv.clientName || 'N/A'}</td>
                    <td>${inv.invoiceDate || 'N/A'}</td>
                    <td>${inv.grandTotal || '€0.00'}</td>
                    <td class="actions">
                        <button class="action-btn view" onclick="editInvoice(${index})">Edit</button>
                        <button class="action-btn delete" onclick="deleteInvoice(${index})">Delete</button>
                    </td>
                </tr>
            `).join('');
        }

        // Generate next invoice number
        function generateInvoiceNumber() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const prefix = `INV-${year}${month}-`;

            // Find highest invoice number for this month
            let maxNum = 0;
            invoices.forEach(inv => {
                if (inv.invoiceNumber && inv.invoiceNumber.startsWith(prefix)) {
                    const num = parseInt(inv.invoiceNumber.split('-')[2]);
                    if (num > maxNum) maxNum = num;
                }
            });

            return prefix + String(maxNum + 1).padStart(4, '0');
        }

        // Create new invoice
        function createNewInvoice() {
            currentInvoiceId = null;

            // Generate new invoice number
            const newNumber = generateInvoiceNumber();
            document.getElementById('invoiceNumber').value = newNumber;

            // Set default dates
            const today = new Date();
            const dueDate = new Date(today);
            dueDate.setDate(dueDate.getDate() + 30);

            document.getElementById('invoiceDate').value = today.toISOString().split('T')[0];
            document.getElementById('dueDate').value = dueDate.toISOString().split('T')[0];

            // Reset form
            document.getElementById('billTo').innerHTML = '<strong>Klantnaam</strong><br>Bedrijfsnaam<br>Adres<br>Postcode, Plaats<br>Land';
            document.getElementById('currency').value = 'EUR';
            document.getElementById('notes').value = 'Bedankt voor uw aankoop. De betaling dient binnen 30 dagen te worden voldaan.';

            // Reset items
            document.getElementById('itemsBody').innerHTML = `
                <tr class="item-row">
                    <td class="description"><input type="text" placeholder="Artikelomschrijving" onchange="calculateTotals()"></td>
                    <td class="qty"><input type="number" value="1" min="0" step="1" onchange="calculateTotals()"></td>
                    <td class="rate"><input type="number" value="0.00" min="0" step="0.01" onchange="calculateTotals()"></td>
                    <td class="amount"><input type="number" value="0.00" readonly></td>
                    <td><button class="remove-btn" onclick="removeRow(this)">×</button></td>
                </tr>
            `;

            calculateTotals();
            showTab('editor');
        }

        // Edit existing invoice
        function editInvoice(index) {
            currentInvoiceId = index;
            const data = invoices[index];

            // Populate form
            document.getElementById('invoiceNumber').value = data.invoiceNumber || '';
            document.getElementById('invoiceDate').value = data.invoiceDate || '';
            document.getElementById('dueDate').value = data.dueDate || '';
            document.getElementById('currency').value = data.currency || 'EUR';
            document.getElementById('billTo').innerHTML = data.billTo || '';
            document.getElementById('notes').value = data.notes || '';
            document.getElementById('bankName').value = data.bankName || 'ING Bank';
            document.getElementById('iban').value = data.iban || '';
            document.getElementById('bic').value = data.bic || 'INGBNL2A';

            // Populate items
            const itemsBody = document.getElementById('itemsBody');
            if (data.items && data.items.length > 0) {
                itemsBody.innerHTML = data.items.map(item => `
                    <tr class="item-row">
                        <td class="description"><input type="text" value="${item.description || ''}" placeholder="Artikelomschrijving" onchange="calculateTotals()"></td>
                        <td class="qty"><input type="number" value="${item.qty || 1}" min="0" step="1" onchange="calculateTotals()"></td>
                        <td class="rate"><input type="number" value="${item.rate || 0}" min="0" step="0.01" onchange="calculateTotals()"></td>
                        <td class="amount"><input type="number" value="${item.amount || 0}" readonly></td>
                        <td><button class="remove-btn" onclick="removeRow(this)">×</button></td>
                    </tr>
                `).join('');
            }

            calculateTotals();
            showTab('editor');
        }

        // Save invoice
        function saveInvoice() {
            // Collect form data
            const items = [];
            document.querySelectorAll('.item-row').forEach(row => {
                items.push({
                    description: row.querySelector('.description input').value,
                    qty: parseFloat(row.querySelector('.qty input').value) || 0,
                    rate: parseFloat(row.querySelector('.rate input').value) || 0,
                    amount: parseFloat(row.querySelector('.amount input').value) || 0
                });
            });

            // Extract client name from billTo
            const billToHTML = document.getElementById('billTo').innerHTML;
            const clientNameMatch = billToHTML.match(/<strong>(.*?)<\/strong>/);
            const clientName = clientNameMatch ? clientNameMatch[1] : 'Unknown';

            const invoiceData = {
                invoiceNumber: document.getElementById('invoiceNumber').value,
                invoiceDate: document.getElementById('invoiceDate').value,
                dueDate: document.getElementById('dueDate').value,
                currency: document.getElementById('currency').value,
                billTo: billToHTML,
                clientName: clientName,
                items: items,
                subtotal: document.getElementById('subtotal').value,
                vat: document.getElementById('vat').value,
                grandTotal: document.getElementById('grandTotal').value,
                notes: document.getElementById('notes').value,
                bankName: document.getElementById('bankName').value,
                iban: document.getElementById('iban').value,
                bic: document.getElementById('bic').value,
                updatedAt: new Date().toISOString()
            };

            if (currentInvoiceId !== null) {
                // Update existing
                invoices[currentInvoiceId] = invoiceData;
            } else {
                // Create new
                invoiceData.createdAt = new Date().toISOString();
                invoices.push(invoiceData);
                currentInvoiceId = invoices.length - 1;
            }

            saveInvoicesToStorage();
            alert('Invoice saved successfully!');
        }

        // Delete invoice
        function deleteInvoice(index) {
            if (!confirm('Are you sure you want to delete this invoice?')) return;
            invoices.splice(index, 1);
            saveInvoicesToStorage();
            loadInvoices();
        }

        // Change language
        function changeLanguage(lang) {
            currentLang = lang;
            const t = translations[lang];

            document.querySelector('.invoice-title').textContent = t.invoice;

            const addressHeaders = document.querySelectorAll('.address-block h4');
            addressHeaders[0].textContent = t.from;
            addressHeaders[1].textContent = t.billTo;

            const detailLabels = document.querySelectorAll('.detail-item label');
            detailLabels[0].textContent = t.invoiceDate;
            detailLabels[1].textContent = t.dueDate;
            detailLabels[2].textContent = t.currency;

            const tableHeaders = document.querySelectorAll('.items-table th');
            tableHeaders[0].textContent = t.description;
            tableHeaders[1].textContent = t.qty;
            tableHeaders[2].textContent = t.unitPrice;
            tableHeaders[3].textContent = t.amount;

            document.querySelector('.add-item-btn').textContent = t.addLineItem;

            const totalLabels = document.querySelectorAll('.total-row label');
            totalLabels[0].textContent = t.subtotal;
            totalLabels[1].textContent = t.vat;
            totalLabels[2].textContent = t.totalDue;

            document.querySelector('.notes-section h4').textContent = t.notesTerms;
            document.getElementById('notes').placeholder = t.notesPlaceholder;

            document.querySelector('.payment-section h4').textContent = t.paymentInfo;
            const paymentLabels = document.querySelectorAll('.payment-item label');
            paymentLabels[0].textContent = t.bankName;
            paymentLabels[1].textContent = t.iban;
            paymentLabels[2].textContent = t.bic;

            document.querySelectorAll('.item-row .description input').forEach(input => {
                input.placeholder = t.itemPlaceholder;
            });
        }

        // Add new item row
        function addItemRow() {
            const tbody = document.getElementById('itemsBody');
            const t = translations[currentLang];
            const newRow = document.createElement('tr');
            newRow.className = 'item-row';
            newRow.innerHTML = `
                <td class="description"><input type="text" placeholder="${t.itemPlaceholder}" onchange="calculateTotals()"></td>
                <td class="qty"><input type="number" value="1" min="0" step="1" onchange="calculateTotals()"></td>
                <td class="rate"><input type="number" value="0.00" min="0" step="0.01" onchange="calculateTotals()"></td>
                <td class="amount"><input type="number" value="0.00" readonly></td>
                <td><button class="remove-btn" onclick="removeRow(this)">×</button></td>
            `;
            tbody.appendChild(newRow);
        }

        // Remove item row
        function removeRow(btn) {
            const row = btn.closest('tr');
            const tbody = document.getElementById('itemsBody');
            if (tbody.querySelectorAll('.item-row').length > 1) {
                row.remove();
                calculateTotals();
            }
        }

        // Calculate all totals
        function calculateTotals() {
            const rows = document.querySelectorAll('.item-row');
            let subtotal = 0;
            const currency = document.getElementById('currency').value || 'EUR';
            const currencySymbol = getCurrencySymbol(currency);

            rows.forEach(row => {
                const qty = parseFloat(row.querySelector('.qty input').value) || 0;
                const rate = parseFloat(row.querySelector('.rate input').value) || 0;
                const amount = qty * rate;
                row.querySelector('.amount input').value = amount.toFixed(2);
                subtotal += amount;
            });

            const vatRate = 0.21;
            const vat = Math.floor(subtotal * vatRate * 100) / 100;
            const total = Math.floor((subtotal + vat) * 100) / 100;

            document.getElementById('subtotal').value = currencySymbol + subtotal.toFixed(2);
            document.getElementById('vat').value = currencySymbol + vat.toFixed(2);
            document.getElementById('grandTotal').value = currencySymbol + total.toFixed(2);
        }

        // Get currency symbol
        function getCurrencySymbol(currency) {
            const symbols = {
                'EUR': '€',
                'USD': '$',
                'GBP': '£',
                'CHF': 'CHF ',
                'JPY': '¥',
                'CAD': 'C$',
                'AUD': 'A$'
            };
            return symbols[currency.toUpperCase()] || currency + ' ';
        }

        // Download as PDF
        function downloadPDF() {
            const element = document.getElementById('invoice');
            const invoiceNumber = document.getElementById('invoiceNumber').value || 'invoice';

            const addBtn = document.querySelector('.add-item-btn');
            const removeBtns = document.querySelectorAll('.remove-btn');
            addBtn.style.display = 'none';
            removeBtns.forEach(btn => btn.style.display = 'none');

            const invoiceTitle = document.querySelector('.invoice-title');
            const originalTitleHTML = invoiceTitle.innerHTML;
            const titleText = invoiceTitle.textContent;

            invoiceTitle.innerHTML = `
                <svg width="180" height="40" viewBox="0 0 180 40" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="titleGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#6366f1"/>
                            <stop offset="50%" style="stop-color:#8b5cf6"/>
                            <stop offset="100%" style="stop-color:#ec4899"/>
                        </linearGradient>
                    </defs>
                    <text x="0" y="30" font-family="Inter, sans-serif" font-size="28" font-weight="700" fill="url(#titleGradient)">${titleText}</text>
                </svg>
            `;
            invoiceTitle.style.background = 'none';
            invoiceTitle.style.webkitTextFillColor = 'transparent';

            const opt = {
                margin: 0,
                filename: invoiceNumber + '.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: {
                    scale: 2,
                    useCORS: true,
                    letterRendering: true,
                    height: element.offsetHeight,
                    windowHeight: element.offsetHeight
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                },
                pagebreak: { mode: 'avoid-all' }
            };

            html2pdf().set(opt).from(element).save().then(() => {
                invoiceTitle.innerHTML = originalTitleHTML;
                invoiceTitle.style.background = '';
                invoiceTitle.style.webkitTextFillColor = '';
                addBtn.style.display = '';
                removeBtns.forEach(btn => btn.style.display = '');
            });
        }

        // Initialize
        document.getElementById('currency').addEventListener('change', calculateTotals);
        loadInvoices();
        calculateTotals();
        <?php endif; ?>
    </script>
</body>

</html>