<template>
  <AppSidebarLayout>
    <br>
    <div
      class="min-h-[90vh] transition-colors duration-300
             bg-[#f7f9fc] text-gray-900
             dark:bg-gradient-to-br dark:from-black dark:to-[#0a2540] dark:text-white
             container mx-auto px-4 py-8"
    >
      <!-- Encabezado con imagen -->
      <div
        class="flex items-center justify-between rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 p-6 mb-6
               bg-blue-50 dark:bg-gray-800 dark:shadow-blue-900/80"
      >
        <div>
          <h1
            class="text-3xl font-extrabold text-blue-700 dark:text-blue-400 flex items-center gap-2"
          >
            🏥 Reportes de Ventas - Farmacia
          </h1>
          <p class="text-gray-600 dark:text-gray-300 mt-1">
            Revisa el historial de ventas realizadas en tu farmacia
          </p>
        </div>
        <img
          src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png"
          alt="Medicamento"
          class="w-16 h-16"
        />
      </div>
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Reportes ventas</h1>
        <div class="flex items-center gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Desde</label>
            <input
              type="date"
              v-model="fechaInicio"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white dark:border-gray-600"
              id="fechaInicio"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hasta</label>
            <input
              type="date"
              v-model="fechaFin"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-800 dark:text-white dark:border-gray-600"
              id="fechaFin"
            />
          </div>
          <a
            :href="`/pdf?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
            target="_blank"
          >
            <span>Descargar PDF</span>
          </a>
        </div>
      </div>
      <!-- Tabla de ventas -->
      <div v-if="ventas.length">
        <div
          class="overflow-x-auto rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 border border-blue-200 bg-white dark:bg-gray-900 dark:border-blue-700 dark:shadow-blue-900/80"
        >
          <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
            <thead
              class="bg-blue-600 text-white uppercase text-xs tracking-wider dark:bg-blue-700"
            >
              <tr>
                <th class="px-6 py-3">🧾 ID</th>
                <th class="px-6 py-3">👤 Cliente</th>
                <th class="px-6 py-3">💵 Total</th>
                <th class="px-6 py-3">📅 Fecha</th>
              </tr>
            </thead>
            <transition-group name="fade" tag="tbody">
              <tr
                v-for="(venta, idx) in ventasFiltradas"
                :key="venta.id"
                class="border-b hover:bg-blue-50 dark:hover:bg-blue-900 transition-all duration-300 ease-in-out"
              >
                <td class="px-6 py-4 font-semibold text-blue-800 dark:text-blue-400">
                  {{ idx + 1 }}
                </td>
                <td class="px-6 py-4">{{ venta.cliente_nombre }}</td>
                <td class="px-6 py-4">{{ venta.total }}</td>
                <td class="px-6 py-4">{{ venta.fecha_registro }}</td>
              </tr>
            </transition-group>
          </table>
        </div>
      </div>
      <!-- Sin ventas -->
      <div v-else class="mt-12 text-center">
        <img
          src="https://cdn-icons-png.flaticon.com/512/4149/4149623.png"
          alt="Sin datos"
          class="mx-auto w-24 h-24 opacity-60"
        />
        <p class="text-blue-500 dark:text-blue-400 mt-4 font-semibold text-lg animate-pulse">
          No hay ventas disponibles por el momento 💤
        </p>
      </div>
    </div>
  </AppSidebarLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
import { ref, computed } from 'vue';

const fechaInicio = ref('');
const fechaFin = ref('');

const props = defineProps({
  ventas: {
    type: Array,
    required: true,
  },
});

const ventasFiltradas = computed(() => {
  return props.ventas.filter(venta => {
    const fecha = venta.fecha_registro.substring(0, 10);
    const desde = fechaInicio.value ? fechaInicio.value : '0000-00-00';
    const hasta = fechaFin.value ? fechaFin.value : '9999-12-31';
    return fecha >= desde && fecha <= hasta;
  });
});
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.4s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(10px);
}
</style>