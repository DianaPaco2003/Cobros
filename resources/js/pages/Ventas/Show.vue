<template>
  <AppLayout>
    <div class="container mx-auto px-4 py-8">
      <h1 class="text-2xl font-bold mb-6 text-blue-700">Detalles de Venta</h1>
      <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <p class="text-sm font-medium text-blue-800">ID de Venta</p>
          <p class="mt-1 text-gray-900">{{ venta.id }}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-blue-800">Cliente</p>
          <p class="mt-1 text-gray-900">{{ venta.cliente_nombre }}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-blue-800">Vendedor</p>
          <p class="mt-1 text-gray-900">{{ venta.usuario?.nombre }}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-blue-800">Fecha</p>
          <p class="mt-1 text-gray-900">{{ venta.fecha_registro }}</p>
        </div>
      </div>
      <div class="mt-8">
        <h3 class="text-lg font-medium text-blue-700">Productos</h3>
        <div class="mt-4">
          <table class="min-w-full divide-y divide-blue-200">
            <thead class="bg-blue-100 text-blue-800">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Producto</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Cantidad</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Precio Unitario</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Subtotal</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-blue-200">
              <tr v-for="detalle in venta.detalles" :key="detalle.id" class="hover:bg-blue-50 transition">
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ detalle.producto?.nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ detalle.cantidad }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ formatCurrency(detalle.precio_unitario) }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ formatCurrency(detalle.subtotal) }}</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="px-6 py-4 text-right font-medium text-blue-800">Total:</td>
                <td class="px-6 py-4 font-medium text-gray-900">{{ formatCurrency(venta.total) }}</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="mt-6 flex items-center justify-end">
        <Link :href="route('ventas.index')" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
          Volver
        </Link>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

// Define props with a default value for venta
defineProps({
  venta: {
    type: Object,
    default: () => ({
      id: '',
      cliente_nombre: '',
      usuario: null,
      fecha_registro: '',
      detalles: [],
      total: 0,
    }),
  },
});

// Utility function to format currency
const formatCurrency = (value) => {
  return Number(value).toLocaleString('es-ES', {
    style: 'currency',
    currency: 'USD',
  });
};
</script>