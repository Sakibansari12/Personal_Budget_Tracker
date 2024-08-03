@extends('admin.layouts.main')
@section('content')
<!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0"> Monthly Report</h3>
            </div>
            
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card-actions" style="overflow: hidden; margin-top: 22px; margin-left: 140px;">
                    <a href="javascript:void(0);" id="ReportBtn" class="btn btn-secondary d-none d-md-inline-block text-white">
                        Generate Report
                    </a>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="search-bar mb-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Date From</label>
                                        <input type="date"  name="start_date" id="start_date"
                                            class="form-control" placeholder="Enter Date">
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Date To</label>
                                        <input type="date"  name="end_date" id="end_date"
                                            class="form-control" placeholder="Enter Date">
                                            
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label>Type<span class="text-danger">*</span></label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="">Select Type</option>
                                        <option value="income">Income</option>
                                        <option value="expense">Expense</option>
                                    </select>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>






                    <div class="alert alert-success" id="success-message" style="display: none; background-color: green; color: white;"></div>
                    <div class="alert alert-danger" id="danger-message" style="display: none; background-color: #b62a2a; color: white;"></div>
                        <div class="table-responsive">
                            <table class="table table-th-background" id="transaction_table">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">User Name</th>
                                        <th class="border-top-0">Category</th>
                                        <th class="border-top-0">Amount</th>
                                        <th class="border-top-0">Type</th>
                                        <th class="border-top-0">Date</th>
                                        <th class="border-top-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = localStorage.getItem('successMessage');
            if (successMessage) {
                var successMessageDiv = document.getElementById('success-message');
                successMessageDiv.innerText = successMessage;
                successMessageDiv.style.display = 'block';
                localStorage.removeItem('successMessage');
                setTimeout(function() {
                    successMessageDiv.style.display = 'none';
                }, 5000); 
            }
        });
    </script>
   <script>
    $(document).ready(function() {
        var successMessage = $('#success-message');
        if (successMessage.length > 0) {
            setTimeout(function() {
                successMessage.hide();
            }, 3000);
        }
    });
    </script>
    <script>
        $(document).ready(function() {
            var successMessage = $('#danger-message');
            if (successMessage.length > 0) {
                setTimeout(function() {
                    successMessage.hide();
                }, 3000);
            }
        });
    </script>
    <script>
        $(function () {
var oTable = $('#transaction_table').DataTable({
    processing: true,
    serverSide: true,
    "stateSave": true,
    ajax: {
        url: "{{ route('monthly.report') }}",
        data: function (d) {
            d.start_date = $("#start_date").val();
            d.end_date = $("#end_date").val();
            d.type = $("#type").val();
        }
    },
    columns: [
        {
            data: 'index', 
            index: 'index'
        },
        {
            data: 'name', 
            name: 'name'
        },
        {
            data: 'categorie_name', 
            name: 'categorie_name'
        },
        {
            data: 'amount', 
            name: 'amount'
        },
        {
            data: 'type', 
            name: 'type'
        },
        {
            data: 'date', 
            name: 'date'
        },
        {
            data: 'action', 
            action: 'action', 
            orderable: false, 
            searchable: false
        },
    ],
    buttons: [
        {
            text: 'Export Records',
            className: 'btn btn-default',
            action: function (e, dt, button, config) {
                $.ajax({
                    method: "post",
                    headers:
                        {
                            'X-CSRF-TOKEN':
                                $('meta[name="csrf-token"]').attr('content')
                        },
                    url: "",
                    data:
                        {
                        },
                    success: function (response) {
                        if (response.status === 200) {
                            alertify.success('User Export Started!!');
                            setTimeout(function () {
                                location.reload()
                            }, 10000);
                        }

                    }
                });
            }
        },
    ],

    pageLength: 5,
    lengthMenu: [[5, 10, 20, 50, -1], [5, 10, 20, 50, 'all']],
    lengthChange: true,
});

$('#search_form').on('submit', function (e) {
    oTable.draw();
    e.preventDefault();
});
$("#start_date, #end_date").change(function() {
       oTable.draw();
    }); 
    $("#type").change(function() {
        oTable.draw();
    }); 

});
    </script>

<script>
    document.getElementById('ReportBtn').addEventListener('click', function() {
        var startDate = document.getElementById('start_date').value;
        var EndDate = document.getElementById('end_date').value;
        var type = document.getElementById('type').value;
        if (!type) {
            alert('Please select a type.');
            return;
        }
        var url = '{{ route("monthly-report") }}';
        var params = new URLSearchParams({
            start_date: startDate,
            end_date: EndDate,
            type: type
        }).toString();
        window.location.href = url + '?' + params;
    });
</script>
@endsection
