import Vue from 'vue'
import Logotypes from './components/Logotypes'
import { VueperSlides, VueperSlide } from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'

window.app = new Vue({
    el: '#app',
    components: {Logotypes, VueperSlides, VueperSlide},
    data: {
        form: 'contact',
        breakpoints: {
            600: {
                visibleSlides: 1
            },
        },
    }
});