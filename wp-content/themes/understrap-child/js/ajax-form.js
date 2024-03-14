jQuery(document).ready(function ($) {
    const form = $('#new-estate-form');
    const submitBtn = form.find('[type=submit]');

    // Сбрасываем значения полей
    $('#new-estate-form input, #new-estate-form textarea').on('blur', function () {
        $('#new-estate-form input, #new-estate-form textarea').removeClass('error');
        $('.notification').remove();
        submitBtn.val('Отправить');
    });

    // Отправка значений полей
    var options = {
        url: new_estate_ajax_form.url,
        data: {
            action: 'new_estate_ajax_form_action',
            nonce: new_estate_ajax_form.nonce
        },
        type: 'POST',
        dataType: 'json',
        beforeSubmit: function (xhr) {
            submitBtn.val('Отправляем...');
        },
        success: function (request, xhr, status, error) {

            if (request.success === true) {
                // Если все поля заполнены, отправляем данные и меняем надпись на кнопке
                form.after('<div class="notification notification_accept">' + request.data + '</div>').slideDown();
                submitBtn.val('Отправить');
            } else {
                // Если поля не заполнены, выводим сообщения и меняем надпись на кнопке
                $.each(request.data, function (key, val) {
                    $('.form_' + key).addClass('error');
                    $('.form_' + key).after('<div class="notification notification_warning notification_warning_' + key + '">' + val + '</div>');
                });
                submitBtn.val('Что-то пошло не так...');
            }
            // При успешной отправке сбрасываем значения полей
            $('#new-estate-form')[0].reset();
        },
        error: function (request, status, error) {
            submitBtn.val('Что-то пошло не так...');
        }
    };

    // Отправка формы
    form.ajaxForm(options);
});