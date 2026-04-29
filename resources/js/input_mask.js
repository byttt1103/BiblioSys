import Inputmask from "inputmask";

//=== elements we need ===
const documentInput = document.querySelector("#document_number")
const phoneInput = document.querySelector("#phone_number_show")
const phone_number = document.querySelector("#phone_number")
const form = document.querySelector("form");

export function initInputMasks() {

    Inputmask("+57 999 999 9999").mask(phoneInput)

    Inputmask("numeric", {
        numericInput: true,
        digits: 0,
        allowMinus: false,
        rightAlign: false
    }).mask(documentInput);

}

form.addEventListener("submit", () => {
    phone_number.value = phoneInput.inputmask.unmaskedvalue();
});
