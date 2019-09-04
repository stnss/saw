$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function ()
{

    "use strict";

    //ajax mocks
    $.mockjaxSettings.responseTime = 500;

    $.mockjax({
        url: '/post',
        response: function (settings)
        {
            log(settings, this);
        }
    });

    $.mockjax({
        url: '/error',
        status: 400,
        statusText: 'Bad Request',
        response: function (settings)
        {
            this.responseText = 'Please input correct value';
            log(settings, this);
        }
    });

    $.mockjax({
        url: '/status',
        status: 500,
        response: function (settings)
        {
            this.responseText = 'Internal Server Error';
            log(settings, this);
        }
    });

    $.mockjax({
        url: '/groups',
        response: function (settings)
        {
            this.responseText = [
                { value: 0, text: 'Guest' },
                { value: 1, text: 'Service' },
                { value: 2, text: 'Customer' },
                { value: 3, text: 'Operator' },
                { value: 4, text: 'Support' },
                { value: 5, text: 'Admin' }
            ];
            log(settings, this);
        }
    });

    function log(settings, response)
    {
        var s = [], str;
        s.push(settings.type.toUpperCase() + ' url = "' + settings.url + '"');
        for (var a in settings.data)
        {
            if (settings.data[ a ] && typeof settings.data[ a ] === 'object')
            {
                str = [];
                for (var j in settings.data[ a ]) { str.push(j + ': "' + settings.data[ a ][ j ] + '"'); }
                str = '{ ' + str.join(', ') + ' }';
            } else
            {
                str = '"' + settings.data[ a ] + '"';
            }
            s.push(a + ' = ' + str);
        }
        s.push('RESPONSE: status = ' + response.status);

        if (response.responseText)
        {
            if ($.isArray(response.responseText))
            {
                s.push('[');
                $.each(response.responseText, function (i, v)
                {
                    s.push('{value: ' + v.value + ', text: "' + v.text + '"}');
                });
                s.push(']');
            } else
            {
                s.push($.trim(response.responseText));
            }
        }
        s.push('--------------------------------------\n');
        $('#console').val(s.join('\n') + $('#console').val());
    }

    //defaults
    $.fn.editable.defaults.url = '/post';

    // var c = window.location.href.match(/c=inline/i) ? 'inline' : 'popup';
    $.fn.editable.defaults.mode = 'inline';
    //enable / disable
    $('#enable').click(function ()
    {
        $('#user .editable').editable('toggleDisabled');
    });

    //editables
    $('.perhitungan').editable({
        url: '/post',
        type: 'text',
        pk: '1',
        name: 'kriteria',
        title: 'Enter kriteria',
        validate: function (value)
        {
            if (!value)
            {
                return 'Required field!';
            } else if ($.isNumeric(value) == '')
            {
                return 'Only numbers are allowed';
            } else if (value < 0)
            {
                return 'Only positive numbers are allowed';
            } else if (value == 0)
            {
                return 'Only number greater that 0 allowed';
            } else if (value > 5)
            {
                return 'Max value must less than or equal 5';
            }
        }
    });

    $('#perhitungan .editable').on('hidden', function (e, reason)
    {
        if (reason === 'save' || reason === 'nochange')
        {
            var $next = $(this).closest('td').next().find('.editable');
            if ($next.length < 1)
            {
                return;
            }

            $next.editable('show');

        }
    });
});

