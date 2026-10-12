import './bootstrap';
import { createApp } from 'vue';
import Comisiones from './components/Comisiones.vue';

const elemento = document.getElementById('app');

if (elemento) {
    createApp(Comisiones, window.datosIniciales).mount(elemento);
}
