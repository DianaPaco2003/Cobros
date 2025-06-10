<template>
  <AppLayout>
    <div class="container mx-auto px-4 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-700 dark:text-blue-300">Lista de Usuarios</h1>
        <Link :href="route('usuarios.create')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
          Nuevo Usuario
        </Link>
      </div>
      <div class="bg-blue-50 dark:bg-gray-900 shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full min-w-max">
            <thead class="bg-blue-100 dark:bg-blue-950">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 dark:text-blue-200 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 dark:text-blue-200 uppercase tracking-wider">Usuario</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 dark:text-blue-200 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 dark:text-blue-200 uppercase tracking-wider">Fecha Registro</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 dark:text-blue-200 uppercase tracking-wider">Acciones</th>
              </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-blue-200 dark:divide-blue-950">
              <tr v-for="usuario in usuarios" :key="usuario.id" class="hover:bg-blue-100 dark:hover:bg-blue-950 transition">
                <td class="px-6 py-4 whitespace-nowrap text-blue-900 dark:text-blue-100">{{ usuario.nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-blue-900 dark:text-blue-100">{{ usuario.usuario }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-blue-900 dark:text-blue-100">{{ usuario.email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-blue-900 dark:text-blue-100">{{ usuario.fecha_registro }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2 items-center">
                  <Link :href="route('usuarios.edit', usuario.id)" class="text-indigo-500 hover:text-indigo-300" title="Editar">
                    Editar
                  </Link>
                  <button @click="confirmDelete(usuario)" class="text-red-500 hover:text-red-700" title="Eliminar">
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

defineProps({ usuarios: Array });

const confirmDelete = (usuario) => {
  if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
    router.delete(route('usuarios.destroy', usuario.id));
  }
};
</script>