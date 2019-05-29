<script src="{{ asset('js/app.js') }}"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>
<script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('textarea_description');
</script>
<script src="{{ asset('js/fundtime.js') }}"></script>
<script>
    $(document).foundation();
</script>

<script>
    $('.datepicker').pickadate({
        format: 'dd-mm-yyyy',
        formatSubmit: 'yyyy-mm-dd'
    });
</script>