{{-- @if (Session::has('sweet_alert.alert'))
    <script>
        swal({!! Session::pull('sweet_alert.alert') !!});
    </script>
    type: "{!! Session::get('sweet_alert.type') !!}",
    // icon:   "{!! Session::get('sweet_alert.icon') !!}",
@endif --}}

@if (Session::has('sweet_alert.alert'))
    <script>
        swal({
            text:   "{!! Session::get('sweet_alert.text') !!}",
            title:  "{!! Session::get('sweet_alert.title') !!}",
            timer:  {!! Session::get('sweet_alert.timer') !!},
            icon:   "{!! Session::get('sweet_alert.type') !!}",
            
            // showConfirmButton: "{!! Session::get('sweet_alert.showConfirmButton') !!}",
            // confirmButtonText: "{!! Session::get('sweet_alert.confirmButtonText') !!}",
            // confirmButtonColor: "#AEDEF4"

            // more options
        });
    </script>
@endif