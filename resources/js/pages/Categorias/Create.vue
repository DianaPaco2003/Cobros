<template>
  <div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
      <h1 class="text-2xl font-bold mb-6 text-blue-700">Registrar nuevo cobro</h1>

      <form @submit.prevent="submit" class="bg-blue-50 shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
          <label class="block text-blue-800 text-sm font-bold mb-2" for="nombre">
            Fecha del cobro
          </label>
          <input
            v-model="form.nombre"
            class="shadow appearance-none border border-blue-300 rounded w-full py-2 px-3 text-blue-900 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:shadow-outline"
            id="nombre"
            type="text"
            required
          />
        </div>

        <div class="mb-4">
          <label class="block text-blue-800 text-sm font-bold mb-2" for="descripcion">
            Descripción del cobro
          </label>
          <textarea
            v-model="form.descripcion"
            class="shadow appearance-none border border-blue-300 rounded w-full py-2 px-3 text-blue-900 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:shadow-outline"
            id="descripcion"
            rows="3"
          ></textarea>
        </div>

        <div class="flex items-center justify-between">
          <Link
            :href="route('categorias.index')"
            class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          >
            Cancelar
          </Link>
          <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            :disabled="form.processing"
          >
            Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const form = useForm({
  nombre: '',
  descripcion: ''
});

const submit = () => {
  form.post(route('categorias.store'));
};
</script>

<script>
export default {
  layout: AppLayout
}
</script>