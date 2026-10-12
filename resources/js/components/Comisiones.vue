<script setup>
import { ref } from 'vue';

defineProps({
    vendedores: { type: Array, required: true },
    reglas: { type: Array, required: true },
});

const fechaInicio = ref('');
const fechaFin = ref('');
const resultados = ref(null);
const errores = ref({});
const cargando = ref(false);

async function calcular() {
    cargando.value = true;
    errores.value = {};

    try {
        const respuesta = await fetch('/comisiones', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                fecha_inicio: fechaInicio.value,
                fecha_fin: fechaFin.value,
            }),
        });

        const datos = await respuesta.json();

        if (!respuesta.ok) {
            errores.value = datos.errors ?? {};
            return;
        }

        resultados.value = datos.resultados;
    } finally {
        cargando.value = false;
    }
}

function dinero(valor) {
    return new Intl.NumberFormat('es-EC', {
        style: 'currency',
        currency: 'USD',
    }).format(valor);
}
</script>

<template>
    <div class="space-y-8">
        <section class="overflow-hidden rounded-2xl bg-slate-900 text-white shadow-lg">
            <div class="grid gap-8 px-6 py-8 md:grid-cols-[1.2fr_1fr] md:px-10">
                <div class="self-center">
                    <p class="mb-2 text-sm font-semibold uppercase tracking-[0.2em] text-emerald-400">
                        Módulo de ventas
                    </p>
                    <h2 class="max-w-xl text-3xl font-bold leading-tight md:text-4xl">
                        Consulta las comisiones por periodo
                    </h2>
                    <p class="mt-3 max-w-lg text-sm leading-6 text-slate-300">
                        Selecciona un rango de fechas para aplicar las reglas registradas a las ventas de cada vendedor.
                    </p>
                </div>

                <form class="rounded-xl bg-white p-5 text-slate-800" @submit.prevent="calcular">
                    <h3 class="mb-4 font-semibold">Periodo de consulta</h3>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="fecha-inicio" class="text-sm font-medium">Desde</label>
                            <input id="fecha-inicio" v-model="fechaInicio" type="date"
                                class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:border-emerald-500">
                            <p v-if="errores.fecha_inicio" class="mt-1 text-xs text-red-600">
                                {{ errores.fecha_inicio[0] }}
                            </p>
                        </div>

                        <div>
                            <label for="fecha-fin" class="text-sm font-medium">Hasta</label>
                            <input id="fecha-fin" v-model="fechaFin" type="date"
                                class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:border-emerald-500">
                            <p v-if="errores.fecha_fin" class="mt-1 text-xs text-red-600">
                                {{ errores.fecha_fin[0] }}
                            </p>
                        </div>
                    </div>

                    <button type="submit" :disabled="cargando"
                        class="mt-5 w-full rounded-lg bg-emerald-500 px-4 py-2.5 font-semibold text-slate-950 transition hover:bg-emerald-400 disabled:cursor-not-allowed disabled:opacity-60">
                        {{ cargando ? 'Calculando...' : 'Calcular comisiones' }}
                    </button>
                </form>
            </div>
        </section>

        <section v-if="resultados !== null" class="rounded-2xl border border-emerald-200 bg-emerald-50 p-6">
            <div class="mb-5 flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-emerald-700">Resumen calculado</p>
                    <h2 class="text-xl font-bold text-slate-900">Comisiones por vendedor</h2>
                </div>
                <span class="rounded-full bg-white px-3 py-1 text-sm text-slate-600 shadow-sm">
                    {{ resultados.length }} resultados
                </span>
            </div>

            <div v-if="resultados.length" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <article v-for="resultado in resultados" :key="resultado.vendedor_id"
                    class="rounded-xl bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">{{ resultado.nombre }}</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900">
                        {{ dinero(resultado.comision_total) }}
                    </p>
                </article>
            </div>

            <p v-else class="rounded-xl bg-white p-5 text-center text-slate-500">
                No hay ventas en el rango seleccionado.
            </p>
        </section>

        <div class="grid gap-6 lg:grid-cols-2">
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-5">
                    <p class="text-sm font-medium text-indigo-600">Equipo comercial</p>
                    <h2 class="text-xl font-bold text-slate-900">Vendedores registrados</h2>
                </div>

                <div class="overflow-x-auto p-4">
                    <table class="w-full text-left text-sm">
                        <thead class="text-xs uppercase tracking-wide text-slate-500">
                            <tr>
                                <th class="px-3 py-3">Nombre</th>
                                <th class="px-3 py-3">Correo electrónico</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr v-for="vendedor in vendedores" :key="vendedor.id" class="hover:bg-slate-50">
                                <td class="px-3 py-4 font-medium text-slate-800">{{ vendedor.nombre }}</td>
                                <td class="px-3 py-4 text-slate-500">{{ vendedor.email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-5">
                    <p class="text-sm font-medium text-amber-600">Escala aplicada</p>
                    <h2 class="text-xl font-bold text-slate-900">Reglas de comisión</h2>
                </div>

                <div class="overflow-x-auto p-4">
                    <table class="w-full text-left text-sm">
                        <thead class="text-xs uppercase tracking-wide text-slate-500">
                            <tr>
                                <th class="px-3 py-3">Venta desde</th>
                                <th class="px-3 py-3 text-right">Comisión</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr v-for="regla in reglas" :key="regla.id" class="hover:bg-slate-50">
                                <td class="px-3 py-4 font-medium text-slate-800">
                                    {{ dinero(regla.umbral_monto) }}
                                </td>
                                <td class="px-3 py-4 text-right">
                                    <span class="rounded-full bg-amber-100 px-3 py-1 font-semibold text-amber-800">
                                        {{ Number(regla.porcentaje) * 100 }}%
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</template>
