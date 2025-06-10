<template>
  <AppSidebarLayout>
    <div class="container mx-auto px-4 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-700 dark:text-blue-200 text-center w-full">Reportes</h1>
      </div>
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Reportes ventas</h1>
        <a
          href="/pdf"
          class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
          target="_blank"
        >
          <span>Descargar PDF</span>
        </a>
      </div>
      <div class="flex gap-4 mb-4">
        <div>
          <label for="fechainicio" class="block text-xs text-blue-800 dark:text-blue-200">Desde:</label>
          <input type="date" v-model="fechainicio" id="fechainicio" class="border border-blue-300 rounded px-2 py-1 bg-white dark:bg-blue-950 text-blue-900 dark:text-blue-100" />
        </div>
        <div>
          <label for="fechafin" class="block text-xs text-blue-800 dark:text-blue-200">Hasta:</label>
          <input type="date" v-model="fechafin" id="fechafin" class="border border-blue-300 rounded px-2 py-1 bg-white dark:bg-blue-950 text-blue-900 dark:text-blue-100" />
        </div>
      </div>

      <div v-if="ventasFiltradas.length" class="flex justify-center">
        <table class="min-w-full bg-blue-50 dark:bg-blue-950 text-center shadow-md rounded-lg">
          <thead class="bg-blue-100 dark:bg-blue-900">
            <tr>
              <th class="py-2 px-4 text-blue-800 dark:text-blue-200">ID</th>
              <th class="py-2 px-4 text-blue-800 dark:text-blue-200">Cliente</th>
              <th class="py-2 px-4 text-blue-800 dark:text-blue-200">Total</th>
              <th class="py-2 px-4 text-blue-800 dark:text-blue-200">Fecha</th>
            </tr>
          </thead>
          <tbody class="bg-white dark:bg-blue-950 divide-y divide-blue-200 dark:divide-blue-900">
            <tr v-for="venta in ventasFiltradas" :key="venta.id" class="hover:bg-blue-100 dark:hover:bg-blue-900 transition">
              <td class="py-2 px-4 text-blue-900 dark:text-blue-100">{{ venta.id }}</td>
              <td class="py-2 px-4 text-blue-900 dark:text-blue-100">{{ venta.cliente_nombre }}</td>
              <td class="py-2 px-4 text-blue-900 dark:text-blue-100">{{ venta.total }}</td>
              <td class="py-2 px-4 text-blue-900 dark:text-blue-100">{{ venta.fecha_registro }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else class="text-center">
        <p class="text-blue-700 dark:text-blue-200">No hay ventas disponibles.</p>
      </div>
    </div>
  </AppSidebarLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';

const props = defineProps({
  ventas: {
    type: Array,
    required: true
  }
});
const fechainicio = ref('');
const fechafin = ref('');

const ventasFiltradas = computed(() => {
  return props.ventas.filter(venta => {
    const fecha = venta.fecha_registro.substring(0, 10);
    const desde = fechainicio.value ? fechainicio.value : '0000-00-00';
    const hasta = fechafin.value ? fechafin.value : '9999-99-99';
    return fecha >= desde && fecha <= hasta;
  });
});
</script>