/**
 * Pruebas por examen
 * @since 16/4/2018
 */
$(document).ready(function () {
	    
    $('#prueba').change(function () {
        $('#prueba option:selected').each(function () {
            var prueba = $('#prueba').val();
            if (prueba > 0 || prueba != '-') {
                $.ajax ({
                    type: 'POST',
                    url: base_url + 'solicitud/pruebaList',
                    data: {'identificador': prueba},
                    cache: false,
                    success: function (data)
                    {
                        $('#grupo_items').html(data);
                    }
                });
            } else {
                var data = '';
                $('#grupo_items').html(data);
            }
        });
    });
    
});