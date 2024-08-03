@extends('admin.layouts.main')
@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Create Transaction</h3>
        </div>
        <div class="col-md-6 col-4 align-self-center">
            <div class="text-end upgrade-btn">
                <a href="{{route('transaction.index')}}"
                    class="btn btn-secondary d-none d-md-inline-block text-white"> Transaction <i class="mdi me-2 mdi-format-list-bulleted"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- column -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form name="Transactioncreate" id="Transactioncreate" method="POST" class="form-horizontal form-material mx-2" enctype="multipart/form-data">
                        @csrf
                          <div class="row mt-3">
                              <div class="col-md-6">
                                   <label>Category<span class="text-danger">*</span></label>
                                    <select class="form-control" name="category" id="category">
                                        <option value="">Select Category</option>
                                        @isset($category_data)
                                            @foreach ($category_data as $category)
                                                <option value="{{ $category->id }}"
                                                {{ $category->id == old('category') ? 'selected' : '' }}>
                                                {{ $category->categorie_name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    <p></p>
                              </div>
                              <div class="col-md-6">
                                   <label>Type<span class="text-danger">*</span></label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="">Select Type</option>
                                        <option value="income">Income</option>
                                        <option value="expense">Expense</option>
                                    </select>
                                    <p></p>
                              </div>
                              <div class="col-md-6 mb-2">
                                    <label>Amount<span class="text-danger">*</span></label>
                                    <input type="text" name="amount" id="amount" placeholder="Enter Amount" class="form-control"
                                        value="{{  old('amount') }}">
                                    <p></p>
                                </div>
                                <input type="hidden" name="budget_limit" id="budget_limit" value="{{ $budget_limit }}">
                                <div class="col-md-6 mb-2">
                                    <label>Date<span class="text-danger">*</span></label>
                                    <input type="date" name="date" id="date" placeholder="Enter Date"
                                        class="form-control"
                                        value="{{ old('date') }}">
                                    <p></p>
                                </div>
                                
                              <div class="col-md-6">
                                    <label>Description</label>
                                    <textarea name="description" id="description" placeholder="Enter Description" class="form-control" rows="5">{{  old('description') }}</textarea>
                                    <p></p>
                                </div>
                          </div>
                        <div class="row mt-3">
                            <div>
                                <button type="submit" class="btn btn-secondary" id="savebutton">Submit
                                <span id="spinner_new_prompt" class="spinner-border spinner-border-sm " style="color: #fff; display: none;" role="status"  aria-hidden="true" ></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$('#Transactioncreate').submit(function (event) {
    event.preventDefault();
        var budgetLimit = parseFloat($('#budget_limit').val()) || 0;
        var amount = parseFloat($('#amount').val()) || 0; 
        var currentSpent = 0; 
        if (currentSpent + amount > budgetLimit) {
            alert('You are about to exceed your budget limit!');
            return; 
        }
    var formData = new FormData(this);
    var button_new = document.getElementById('savebutton');
    button_new.disabled = true;
    var spinner_new = document.getElementById('spinner_new_prompt');
    spinner_new.style.display = 'inline-block';
    
    $.ajax({
        url: '{{ route("transaction.store") }}',
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            if (response['status'] == true) {
                localStorage.setItem('successMessage', 'transaction create successfully');
                window.location.href = "{{  route('transaction.index') }}";
                
                button_new.disabled = false;
                spinner_new.style.display = 'none';
            } else {
                // Handle errors
                button_new.disabled = false;
                spinner_new.style.display = 'none';
                var errors = response['errors'];
                $.each(errors, function (key, value) {
                    var elementId = key.replace(/\./g, '_');
                    $('#' + elementId).next('p').addClass('text-danger').html(value[0]);
                });
            }
        },
        error: function () {
            console.log('Something went wrong');
        }
    });
});
    $(document).ready(function() {
        $('#category').on('input', function() {
            $('#category').siblings('p').removeClass('text-danger').html('');
        });
        $('#amount').on('input', function() {
            $('#amount').siblings('p').removeClass('text-danger').html('');
        });
        $('#date').on('input', function() {
            $('#date').siblings('p').removeClass('text-danger').html('');
        });
        $('#description').on('input', function() {
            $('#description').siblings('p').removeClass('text-danger').html('');
        });
        $('#type').on('input', function() {
            $('#type').siblings('p').removeClass('text-danger').html('');
        });
    });
</script>

@endsection