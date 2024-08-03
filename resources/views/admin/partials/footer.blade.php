 <!-- ============================================================== -->
 <!-- footer -->
 <!-- ============================================================== -->
 <footer class="footer"> © 2024 Designed
 </footer>
 <!-- ============================================================== -->
 <!-- End footer -->
 <!-- ============================================================== -->

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <script>
     var state_id = $('#state_id').val();

     if (state_id != '' && state_id != undefined) {
         getCity(state_id);
     }
     $('#state_id').change(function() {
         getCity(this.value)
     });

     function getCity(state_id) {
         var city_id = $('#city').val();
         $.ajax({
             url: "{{ url('/admin/get_cities') }}?state_id=" + state_id,
             type: "GET",
             dataType: 'json',
             success: function(response) {
                 $('#city_id').html('');
                 $('#city_id').append('<option value="">Select City</option>');
                 $.each(response.cities, function(key, value) {
                     if (city_id && city_id != '') {
                         var option = '<option value="' + value.id + '" selected>' + value.name +
                             '</option>';
                     } else {
                         var option = '<option value="' + value.id + '" >' + value.name + '</option>'
                     }
                     $('#city_id').append(option);
                 });

             }
         });
     }
 </script>
