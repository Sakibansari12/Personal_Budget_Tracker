<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Cash Flow Report</title>
    <style>
        
       

       
        body {
            
        }
       
        .custom-table {
             
             width: 95%; 
             margin-top: 10px; 
        }
        .custom-table th, .custom-table td {
            border: 1px solid black;
             /* padding: 10px;  */
             padding: 20px;
           
            vertical-align: top; /* Ensure all cells align at the top */
        }
        
       
    </style>
</head>

       

<body>
<div class="wrapper">
        <!-- <h2>Income Report</h2> -->
        <table class="custom-table" style="margin: 30px;" cellspacing="0" cellpadding="15">
            <thead>
                <tr>
                    <th style="font-size: 20px;">Income Report</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ReportData as $data)
                    <tr>
                        <td>
                            <strong>Category :</strong> {{ $data->categorie_name }}<br>
                            <strong>Amount :</strong> {{ $data->amount }}<br>
                            <strong>Date :</strong> {{ $data->formatted_date }}<br>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="1" style="text-align: center;">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
<?php //die; ?>