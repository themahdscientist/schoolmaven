import axios from 'axios';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm'
import $ from 'jquery';
import intlTelInput from 'intl-tel-input';
import flatpickr from 'flatpickr';
import 'flowbite';
window.axios = axios;
window.Livewire = Livewire;
window.Alpine = Alpine;
window.$ = window.jQuery = $;
window.intlTelInput = intlTelInput;
window.flatpickr = flatpickr;

Alpine.store('darkMode', {
    init() {
        this.on = localStorage.getItem('darkMode') === 'true'
            ? true
            : localStorage.getItem('darkMode') === 'false'
                ? false
                : window.matchMedia('(prefers-color-scheme: dark)').matches;
        this.apply()
    },
    toggle() {
        this.on = !this.on
        localStorage.setItem('darkMode', this.on);
        this.apply()
    },
    apply() {
        if (this.on) {
            $('html').addClass('dark');
        } else {
            $('html').removeClass('dark');
        }
    },
    on: false,
});
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Livewire.start();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
