<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Simple Table</title>
  <link rel="stylesheet">
  <style>
  /* Basic styling for the table */
    .simple-table {
    border-collapse: collapse;
    width: 100%;
    border: 2px solid black; /* Border color and thickness */
    }

    .simple-table th, .simple-table td {
    border: 1px solid black; /* Border for table cells */
    padding: 8px; /* Padding for content within cells */
    text-align: left; /* Align text to the left within cells */
    }
    #statement_title {
        text-align: center;
        font-size: 30px;
        font-weight: bold;
    }
  </style>
</head>
<body>
    <div>
        <h1>Good Day Mr./Mrs: {{strtoupper($record->user->userDetails->last_name) }},</h1>
        <p>Your result has been posted</span></p>
        <p>Date Posted: <span style="font-weight: bold;">{{Carbon\Carbon::parse($record->created_at)->format('F d, Y')}}</span></p>
        <p>Time Posted: <span style="font-weight: bold;">{{Carbon\Carbon::parse($record->created_at)->format('h:i A')}}</span></p>
        <p>Transaction Number: <span style="font-weight: bold;">{{strtoupper($record->user_payment->transaction_number)}}</span></p>
        <p>Thank You.</p>
    </div>

<div>
    <p id="statement_title">Result</p>
</div>
<table class="simple-table">
  <thead>
    <tr>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td class="border border-gray-500 px-4 py-2 text-center">{!! str($record->result->result)->sanitizeHtml() !!}</td>
    </tr>
  </tbody>
</table>
<div style="margin-top: 50px">
    {{now()}} End of Message.
</div>
</body>
</html>
