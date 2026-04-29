//import libraries
import Alpine from 'alpinejs';
//import files
import './bootstrap';
import './fix_height';
import './dropdown';
import './input_mask';

window.Alpine = Alpine;
window.Inputmask = Inputmask;

Alpine.start();

import { initInputMasks } from "./input_mask"

document.addEventListener("DOMContentLoaded", () => {
    initInputMasks()
});
