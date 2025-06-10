<template>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-blue-700">Lista de Cobro</h1>
      <Link :href="route('categorias.create')" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition">
        Crear Categoría
      </Link>
    </div>

    <div class="bg-blue-50 shadow-lg rounded-xl overflow-hidden border border-blue-200">
      <table class="min-w-full">
        <thead class="bg-blue-100 text-blue-800">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wide">fecha del cobro</th>
            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wide">Descripción del cobro</th>
            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wide">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-blue-200">
          <tr v-for="categoria in categorias.data" :key="categoria.id" class="hover:bg-blue-100 transition">
            <td class="px-6 py-4 text-blue-900 font-medium">{{ categoria.nombre }}</td>
            <td class="px-6 py-4 text-blue-900">{{ categoria.descripcion }}</td>
            <td class="px-6 py-4 flex gap-3">
              <Link :href="route('categorias.show', categoria.id)" class="text-blue-500 hover:text-blue-700 transition" title="Ver">
                <Eye class="w-5 h-5" />
              </Link>
              <Link :href="route('categorias.edit', categoria.id)" class="text-blue-500 hover:text-blue-700 transition" title="Editar">
                <Pencil class="w-5 h-5" />
              </Link>
              <button @click="confirmDelete(categoria)" class="text-red-500 hover:text-red-700 transition" title="Eliminar">
                <Trash2 class="w-5 h-5" />
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="mt-6">
      <Pagination :links="categorias.links" />
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import Pagination from '@/components/Pagination.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Trash2, Pencil, Eye } from 'lucide-vue-next';

defineProps({
  categorias: Object
});

const confirmDelete = (categoria) => {
  if (confirm('¿Estás segura de que deseas eliminar esta categoría?')) {
    router.delete(route('categorias.destroy', categoria.id));
  }
};
</script>

<script>
export default {
  layout: AppLayout
}
</script>