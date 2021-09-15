$(function () {
    //STATUS
    $('body').on('click', '.status', function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Confirmar alteração",
            text: "Tem certeza que deseja alterar o status desta inscrição?",
            type: "primary",
            showCancelButton: true,
            confirmButtonColor: "#1b3b6a",
            confirmButtonText: "Sim, alterar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.value) {
                location.href = $(this).attr('href');
            }
        })
    });

    //EXCLUIR
    $('body').on('click', '.remover', function () {
        Swal.fire({
            title: "Confirmar exclusão",
            text: "Tem certeza que deseja excluir este item?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim, excluir",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.value) {
                location.href = $(this).attr('data-url');
            }
        })
    });

    /*
    MASCARAS
     */

    $('.cpfcnpj').keydown(function () {
        try {
            $(this).unmask();
        } catch (e) {
        }

        var tamanho = $(this).val().length;

        if (tamanho < 11) {
            $(this).mask('000.000.000-00', {placeholder: '___.___.___-__', reverse: true});
        } else {
            $(this).mask('00.000.000/0000-00', {placeholder: '___.___.___-__', reverse: true});
        }

        // ajustando foco
        var elem = this;
        setTimeout(function () {
            // mudo a posição do seletor
            elem.selectionStart = elem.selectionEnd = 10000;
        }, 0);
        // reaplico o valor para mudar o foco
        var currentValue = $(this).val();
        $(this).val('');
        $(this).val(currentValue);
    });

    $('.cep').mask('00000-000', {placeholder: "_____-___"});
    $('.telefone').mask('(00) 0000-0000', {placeholder: '(__) ____-____'});
    $('.cnpj').mask('00.000.000/0000-00', {placeholder: '__.___.___/____-__', reverse: true});
    $('.cpf').mask('000.000.000-00', {placeholder: '___.___.___-__', reverse: true});
    $('.money').mask('#.##0,00', {reverse: true});
    $('.date').mask('99/99/9999');

    $('.timeabc').mask('00:00:000');
    $('.nota').mask('#.00', {reverse: true});


    var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

    $('.celular').mask(SPMaskBehavior, spOptions);
});

try {
    new dgCidadesEstados({
        cidade: document.getElementById('cidade'),
        estado: document.getElementById('uf'),
        estadoVal: document.getElementById('uf').value,
        estadoVal: document.getElementById('cidade').value,
        change: true
    });
} catch (e) {

}
