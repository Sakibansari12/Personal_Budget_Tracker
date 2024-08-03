@extends('admin.layouts.main')
@section('content')
<!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0"> Transaction List</h3>
            </div>
            <div class="col-md-6 col-4 align-self-center">
                <div class="text-end upgrade-btn">
                    <a href="{{route('transaction.create')}}" class="btn btn-secondary d-none d-md-inline-block text-white"><i class="mdi me-2 mdi-plus-box" style="font-size:16px;color:white;"></i>Transaction</a>
                </div>
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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
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
                                        <th class="border-top-0">Description</th>
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
    $(document).ready(function() {
    $(document).on('click', '.delete-button', function() {
        var id = $(this).data('id');
        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'transaction/' + id,
                type: 'DELETE',
                success: function(data) {
                    if(data == 'removed'){
                        $('#sid' + id).hide();
                        $('#transaction_table').DataTable().ajax.reload();
                        var successMessageDiv = document.getElementById('success-message');
                            successMessageDiv.innerText = 'You have successfully deleted this Transaction!';
                            successMessageDiv.style.display = 'block';
                            setTimeout(function() {
                                successMessageDiv.style.display = 'none';
                            }, 5000); 
                    } else{
                        var dangerMessageDiv = document.getElementById('danger-message');
                                dangerMessageDiv.innerText = 'Expense Category exists, please remove all accounts first.';
                                dangerMessageDiv.style.display = 'block';
                                setTimeout(function() {
                                    dangerMessageDiv.style.display = 'none';
                                }, 5000); 
                    } 
                  

                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        }
    });
});

    </script>
    <script>
        $(function () {
var oTable = $('#transaction_table').DataTable({
    processing: true,
    serverSide: true,
    "stateSave": true,
    ajax: {
        url: "{{ route('transaction.index') }}",
        data: function (d) {
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
            data: 'description', 
            name: 'description'
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


});
    </script>
@endsection
