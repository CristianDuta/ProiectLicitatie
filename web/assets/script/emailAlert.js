(function ($) {
    "use strict";
    var shouldSave = false;
    var modifiedData = [];
    var newData = [];
    var emailAlertsTable = $('#emailAlertsTable').DataTable({
        "dom":  "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'l><'col-sm-7'p>>"+
                "<'row'<'col-sm-12'i>>",
        "buttons":[
            {
                "text": '<i class="fa fa-plus"></i>&nbsp;Adauga',
                "action": function () {
                    $('#addNewEmailAlertModal').modal('show');
                }
            },
            {
                "text": '<i class="fa fa-floppy-o"></i>&nbsp;Salveaza',
                "className" : 'saveDataTableButton',
                "action": function () {
                    if (!shouldSave) {
                        return false;
                    }

                    saveButton.toggleSavingState();
                    $.ajax({
                        type: "POST",
                        url: '/emailAlerts/save',
                        data: {
                            emailAlerts: modifiedData.filter(function (e) {
                                if (e.length > 0) {
                                    return e;
                                }
                            }).concat(newData)
                        },
                        success: function() {
                            saveButton.toggleSavingState();
                            saveButton.toggleShouldNotSave();
                            modifiedData = [];
                            newData = [];
                        },
                        error : function () {
                            saveButton.toggleSavingState();
                        }
                    });
                }
            }
        ],
        "language": {
            "sProcessing":   "Proceseaza...",
            "sLengthMenu":   "Afiseaza _MENU_ inregistrari pe pagina",
            "sZeroRecords":  "Nu am gasit nimic - ne pare rau",
            "sInfo":         "Afisate de la _START_ la _END_ din _TOTAL_ inregistrari",
            "sInfoEmpty":    "Afisate de la 0 la 0 din 0 inregistrari",
            "sInfoFiltered": "(filtrate dintr-un total de _MAX_ inregistrari)",
            "sInfoPostFix":  "",
            "sSearch":       "Cauta:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Prima",
                "sPrevious": "Precedenta",
                "sNext":     "Urmatoarea",
                "sLast":     "Ultima"
            }
        },
        "ajax": {
            "url": "/getEmailAlertList",
            "dataSrc": function (json) {
                return json;
            }
        },
        "rowCallback": function( row, data ) {
            for (var colIndex = 1; colIndex < data.length; colIndex++) {
                var isChecked = '';
                if (data[colIndex]) {
                    isChecked = 'checked="checked"';
                }
                $('td:eq('+colIndex+')', row).html('<input type="checkbox" ' + isChecked + '/>');
            }
        }
    });

    var submitForm = $('#addNewEmailAlertForm');
    var getSubmitFormData = function () {
        var data = [];
        submitForm.find('input').each(function(){
            if ($(this).is("[type=checkbox]")) {
                data.push($(this).is(":checked"));
            } else {
                data.push($(this).val());
            }
        });

        return data;
    };
    submitForm.find('button.saveButton').click(function(){
        $('#addNewEmailAlertModal').modal('hide');
        var rowData = getSubmitFormData();
        if (!rowData[0].length > 0) {
            return false;
        }
        submitForm.find('input[name=email]').val('');
        emailAlertsTable.row.add(rowData).draw(false);
        newData.push(rowData);
        saveButton.toggleShouldSave();
    });

    emailAlertsTable.on('click', 'tbody td', function () {
        if (emailAlertsTable.cell(this).index().column != 0) {
            emailAlertsTable.cell(this).data($(this).find('input[type=checkbox]').is(":checked")).draw(false);
            modifiedData[emailAlertsTable.cell(this).index().row] = emailAlertsTable.row(emailAlertsTable.cell(this).index().row).data();
        }
        saveButton.toggleShouldSave();
    });

    var saveButton = {
        buttonElement: $(".saveDataTableButton"),

        toggleShouldSave: function () {
            if (!shouldSave) {
                shouldSave = true;
                this.buttonElement.toggleClass('btn-default').toggleClass('btn-danger');
            }
        },

        toggleShouldNotSave: function () {
            if (shouldSave) {
                shouldSave = false;
                this.buttonElement.toggleClass('btn-default').toggleClass('btn-danger');
            }
        },

        toggleSavingState: function () {
            this.buttonElement.find('span i').toggleClass('fa-floppy-o').toggleClass('fa-spinner').toggleClass('fa-spin');
        }
    };
})(jQuery);
