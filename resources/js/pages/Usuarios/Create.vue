<template>
  <AppLayout>
    <div class="max-w-md mx-auto bg-blue-50 dark:bg-gray-900 p-8 rounded shadow">
      <h1 class="text-2xl font-bold mb-6 text-blue-700">Crear Nuevo Usuario</h1>
      <form @submit.prevent="submitUsuario">
        <div class="mb-4">
          <label class="block text-sm font-medium text-blue-800">Nombre</label>
          <input
            v-model="form.nombre"
            type="text"
            class="mt-1 block w-full rounded border border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-blue-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
            required
          />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-blue-800">Usuario</label>
          <input
            v-model="form.usuario"
            type="text"
            class="mt-1 block w-full rounded border border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-blue-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
            required
          />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-blue-800">Email</label>
          <input
            v-model="form.email"
            type="email"
            class="mt-1 block w-full rounded border border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-blue-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
            required
          />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-blue-800">Contraseña</label>
          <input
            v-model="form.contraseña"
            type="password"
            class="mt-1 block w-full rounded border border-blue-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-blue-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"
            required
          />
        </div>
        <div class="flex justify-end gap-2">
          <Link
            :href="route('usuarios.index')"
            class="bg-gray-400 hover:bg-gray-600 text-white px-4 py-2 rounded"
          >
            Cancelar
          </Link>
          <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
          >
            Guardar
          </button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const form = ref({
  nombre: '',
  usuario: '',
  email: '',
  contraseña: ''
});

const submitUsuario = () => {
  router.post(route('usuarios.store'), form.value);
};
</script>