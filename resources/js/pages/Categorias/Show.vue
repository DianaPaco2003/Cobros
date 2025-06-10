<template>
  <div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-blue-700">Detalles de los Cobros</h1>
        <div class="flex space-x-2">
          <Link
            :href="route('categorias.edit', categoria.id)"
            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow"
          >
            Editar
          </Link>
          <Link
            :href="route('categorias.index')"
            class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg shadow"
          >
            Volver
          </Link>
        </div>
      </div>

      <div class="bg-blue-50 shadow-lg rounded-xl px-8 pt-6 pb-8">
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label class="block text-blue-800 text-sm font-semibold mb-1">Fecha del cobro</label>
            <p class="text-gray-900">{{ categoria.nombre }}</p>
          </div>

          <div>
            <label class="block text-blue-800 text-sm font-semibold mb-1">Descripción del cobro</label>
            <p class="text-gray-900">{{ categoria.descripcion }}</p>
          </div>

          <div>
            <label class="block text-blue-800 text-sm font-semibold mb-1">Cobros</label>
            <p class="text-gray-900">{{ categoria.productos?.length || 0 }}</p>
          </div>
        </div>

        <div v-if="categoria.productos?.length" class="mt-10">
          <h2 class="text-2xl font-bold text-blue-700 mb-4">Productos en esta categoría</h2>
          <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full bg-white rounded-lg">
              <thead class="bg-blue-100 text-blue-800">
                <tr>
                  <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Nombre</th>
                  <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Precio</th>
                  <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Stock</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-blue-200">
                <tr v-for="producto in categoria.productos" :key="producto.id" class="hover:bg-blue-50 transition">
                  <td class="px-6 py-4 text-gray-800">{{ producto.nombre }}</td>
                  <td class="px-6 py-4 text-gray-800">${{ producto.precio }}</td>
                  <td class="px-6 py-4 text-gray-800">{{ producto.stock }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

defineProps({
  categoria: Object
});
</script>

<script>
export default {
  layout: AppLayout
}
</script>