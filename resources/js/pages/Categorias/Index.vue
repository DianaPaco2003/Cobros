<template>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-pink-700">Lista de Cobro</h1>
      <Link :href="route('categorias.create')" class="bg-pink-400 text-white px-4 py-2 rounded-lg shadow-md hover:bg-pink-500 transition">
        Crear Categoría
      </Link>
    </div>

    <div class="bg-pink-50 shadow-lg rounded-xl overflow-hidden border border-pink-200">
      <table class="min-w-full">
        <thead class="bg-pink-100 text-pink-800">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wide">Nombre</th>
            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wide">Descripción</th>
            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wide">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-pink-200">
          <tr v-for="categoria in categorias.data" :key="categoria.id" class="hover:bg-pink-100 transition">
            <td class="px-6 py-4 text-pink-900 font-medium">{{ categoria.nombre }}</td>
            <td class="px-6 py-4 text-pink-900">{{ categoria.descripcion }}</td>
            <td class="px-6 py-4 flex gap-3">
              <Link :href="route('categorias.show', categoria.id)" class="text-purple-500 hover:text-purple-700 transition" title="Ver">
                <Eye class="w-5 h-5" />
              </Link>
              <Link :href="route('categorias.edit', categoria.id)" class="text-pink-500 hover:text-pink-700 transition" title="Editar">
                <Pencil class="w-5 h-5" />
              </Link>
              <button @click="confirmDelete(categoria)" class="text-red-400 hover:text-red-600 transition" title="Eliminar">
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
