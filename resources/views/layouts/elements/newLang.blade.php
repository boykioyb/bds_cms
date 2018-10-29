<script>
    $(document).ready(function () {
        $('#addLang').on('click', function () {
            var lang = $('#selectLang').val();
            $.get('{{ route('add.lang') }}', {lang_code: lang}, function (data) {
                if (checkLangCode(lang)) {
                    toastr.error('Ngôn ngữ đã có!');
                } else {
                    $('.wrap-lang').append(data);
                }
            });

        });
    });

    function checkLangCode(lang_code) {
        var is_check = false;
        $('.check-lang').each(function () {
            if ($(this).data('lang') === lang_code) {
                is_check = true;
            }
        });

        return is_check;
    }

</script>
