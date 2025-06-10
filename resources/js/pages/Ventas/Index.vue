<template>
  <AppLayout>
    <div class="container mx-auto px-4 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Lista de Ventas</h1>
        <Link :href="route('ventas.create')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          Nueva Venta
        </Link>
      </div>
      <div class="bg-blue-50 shadow-md rounded-lg overflow-hidden border border-blue-200">
        <div class="overflow-x-auto">
          <table class="w-full min-w-max">
            <thead class="bg-blue-100 text-blue-800">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Cliente</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Vendedor</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Fecha</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Acciones</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-blue-200">
              <tr v-for="venta in ventas" :key="venta.id" class="hover:bg-blue-50 transition">
                <td class="px-6 py-4 whitespace-nowrap text-blue-900">{{ venta.id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-blue-900">{{ venta.cliente_nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap font-semibold text-blue-600">
                  {{ venta.usuario?.nombre || 'Sin asignar' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-blue-900">{{ formatCurrency(venta.total) }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-blue-900">{{ venta.fecha_registro }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2 items-center">
                  <Link :href="route('ventas.show', venta.id)" class="text-blue-500 hover:text-blue-700" title="Ver Detalles">
                    Ver
                  </Link>
                  <button @click="confirmDelete(venta)" class="text-red-500 hover:text-red-700" title="Eliminar">
                    Eliminar
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

// Define props with a default value for ventas
defineProps({
  ventas: {
    type: Array,
    default: () => [],
  },
});

// Function to confirm deletion
const confirmDelete = (venta) => {
  if (confirm('¿Estás seguro de que deseas eliminar esta venta?')) {
    router.delete(route('ventas.destroy', venta.id));
  }
};

// Utility function to format currency
const formatCurrency = (value) => {
  return Number(value).toLocaleString('es-ES', {
    style: 'currency',
    currency: 'USD',
  });
};
</script>