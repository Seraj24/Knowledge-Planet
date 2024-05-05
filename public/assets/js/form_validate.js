export class ValidateForm {
    constructor(fields, path) {
        this.fields = fields; //Fields names array
        this.path = path; //Path to send the ajax request to
    }

    validateField(fieldName, validateAll=false) {
        var data = "";
        if (validateAll) {
            this.fields.forEach((field, index) => {
                if (index === 0) {
                    data += field + '=' + encodeURIComponent(document.getElementById(field).value);
                } else {
                    data += '&' + field + '=' + encodeURIComponent(document.getElementById(field).value);
                }
            });
            data += '&' + "validateAll" + '=' + encodeURIComponent(validateAll);
        } else {
            var fieldValue = document.getElementById(fieldName).value;
            data = fieldName + '=' + encodeURIComponent(fieldValue);
            if (fieldName === "confirm_password") {
                var password = document.getElementById("password").value;
                data += '&password=' + encodeURIComponent(password);
            }
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', this.path, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (validateAll) {
                        this.fields.forEach((field) => {
                            var errorText = field + 'Error';
                            var errorMessage = response[errorText] !== undefined ? response[errorText] : '';
                            document.getElementById(errorText).innerText = errorMessage;
                        });
                    } else {
                        var errorText = fieldName + 'Error';
                        var errorMessage = response[errorText] !== undefined ? response[errorText] : '';
                        document.getElementById(errorText).innerText = errorMessage;
                    }

                    var submitFormButton = document.getElementById('submitButton');
                    if (response['success']) {
                        submitFormButton.style.color = 'rgb(80, 180, 80)';
                        submitFormButton.removeAttribute('disabled');
                    } else {
                        submitFormButton.style.color = '';
                        submitFormButton.setAttribute('disabled', 'disabled');
                    }
                } else {
                    console.error('AJAX request failed:', xhr.status);
                }
            }
        }.bind(this);
        xhr.send(data);
    }

    allFieldsFilled() {
        return this.fields.every(fieldName => {
            var fieldValue = document.getElementById(fieldName).value.trim();
            return fieldValue !== '';
        }); 
    }

    validateForm() {
        if (this.allFieldsFilled()) {
            this.validateField(null, true);
        }
    }

    initialize() {
        this.fields.forEach((fieldName) => {
            document.getElementById(fieldName).addEventListener("keyup", () => {
                this.validateField(fieldName);
                this.validateForm();
                
            });
        });
    }
}


