<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Emission Test Result</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
        }
        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .right-date {
            text-align: right;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .table td, .table th {
            padding: 10px;
            text-align: left;
            border: 1px solid #000;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .result-table {
            width: 100%;
            border-collapse: collapse;
        }
        .result-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #000;
        }
        .result-table th {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Title Section -->
    <div class="title">
        <strong>EMISSION TEST RESULT</strong>
    </div>

    <!-- Date Section (Aligned to the right) -->
    <div class="right-date">
        <strong>{{ \Carbon\Carbon::now()->format('F d, Y') }}</strong>
    </div>

    <!-- Data Table (Single column with headers) -->
    <table class="table">
        <tr>
            <th>Full Name</th>
            <td>{{ $full_name }}</td>
        </tr>
        <tr>
            <th>Transaction Number</th>
            <td>{{ $transaction_number }}</td>
        </tr>
        <tr>
            <th>Vehicle</th>
            <td>{{ $vehicle }}</td>
        </tr>
        <tr>
            <th>Plate Number</th>
            <td>{{ $plate_number }}</td>
        </tr>
        <tr>
            <th>Schedule</th>
            <td>{{ $schedule }}</td>
        </tr>
        <tr>
            <th>Date Created</th>
            <td>{{ $created_at }}</td>
        </tr>
    </table>

    <!-- Result Table (Spanning full width) -->
    <table class="result-table">
        <tr>
            <th>Test Result</th>
        </tr>
        <tr>
            <td style="text-align: left; font-style: italic;">{!! str($result)->sanitizeHtml() !!}</td>
        </tr>
    </table>
</body>
</html>
