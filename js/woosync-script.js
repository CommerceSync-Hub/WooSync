jQuery(document).ready(function($) {
    $(document).on('click', '#generate-api-key-btn', function() {
        $.ajax({
            url: woosync_ajax_obj.ajax_url,
            type: 'post',
            data: {
                action: 'generate_api_key',
                security: woosync_ajax_obj.security
            },
            success: function(response) {
                if (response) {
                    $('.wrap').html(response);
                }
            }
        });
    });

    $(document).on('click', '.copy-api-key-btn', function() {
        var apiKey = $(this).data('api-key');
        navigator.clipboard.writeText(apiKey).then(function() {
            alert('API Key copied to clipboard: ' + apiKey);
        }, function() {
            alert('Clipboard functionality is not available.');
        });
    });

    $(document).on('click', '.reset-api-key-btn', function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to reset the API key?')) {
            $.ajax({
                url: woosync_ajax_obj.ajax_url,
                type: 'post',
                data: {
                    action: 'reset_api_key',
                    security: woosync_ajax_obj.security
                },
                success: function(response) {
                    $('.wrap').html(response);
                }
            });
        }
    });
});
