    $('.date-picker').datepicker({
        format: 'dd/mm/yyyy',
        setDate: new Date(),
        language: 'pt-BR',
        pickTime: true
    });

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '-3d',
        language: 'pt-BR',
    });