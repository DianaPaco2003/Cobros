<template>
  <AppLayout>
    <div class="container mx-auto px-4 py-8">
      <div class="max-w-2xl mx-auto bg-blue-50 dark:bg-gray-900 p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-blue-700">Registrar Nueva Venta</h1>
        <form @submit.prevent="submitVenta">
          <div class="mb-4">
            <label class="block text-sm font-medium text-blue-800">Nombre del Cliente</label>
            <input v-model="form.cliente_nombre" type="text" class="mt-1 block w-full rounded border-blue-300 bg-white dark:bg-gray-800 text-blue-900 dark:text-white focus:ring-blue-400 focus:border-blue-400" required />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-blue-800">Vendedor</label>
            <select
              v-model="form.usuario_id"
              class="mt-1 block w-full rounded border-blue-300 bg-white dark:bg-gray-800 text-blue-900 dark:text-white focus:ring-blue-400 focus:border-blue-400"
              required
            >
              <option value="">Seleccione un vendedor</option>
              <option v-for="usuario in usuarios" :key="usuario.id" :value="usuario.id">
                {{ usuario.nombre }}
              </option>
            </select>
          </div>
          <div class="mb-4">
            <h3 class="text-lg font-medium text-blue-700 mb-2">Productos</h3>
            <div v-if="!productos.length" class="text-red-500 mb-4">
              No hay productos disponibles para la venta.
            </div>
            <div v-for="(item, idx) in form.productos" :key="idx" class="mb-2 flex gap-2 items-center">
              <select
                v-model="item.id"
                class="rounded border-blue-300 bg-white dark:bg-gray-800 text-blue-900 dark:text-white focus:ring-blue-400 focus:border-blue-400"
                required
                @change="updatePrecio(idx)"
              >
                <option value="">Seleccione un producto</option>
                <option v-for="producto in productos" :key="producto.id" :value="producto.id">
                  {{ producto.nombre }} - {{ producto.precio }} Bs
                </option>
              </select>
              <input
                v-model.number="item.cantidad"
                type="number"
                min="1"
                class="w-20 rounded border-blue-300 bg-white dark:bg-gray-800 text-blue-900 dark:text-white focus:ring-blue-400 focus:border-blue-400"
                required
                @input="updateSubtotal(idx)"
              />
              <input
                :value="item.precio_unitario + ' Bs'"
                type="text"
                class="w-24 rounded border-blue-300 bg-blue-100 text-blue-900"
                readonly
                tabindex="-1"
              />
              <input
                :value="item.subtotal + ' Bs'"
                type="text"
                class="w-24 rounded border-blue-300 bg-blue-100 text-blue-900"
                readonly
                tabindex="-1"
              />
              <button type="button" @click="removeProducto(idx)" class="text-red-500 hover:text-red-700">Eliminar</button>
            </div>
            <button type="button" @click="addProducto" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">Agregar Producto</button>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-blue-800">Total</label>
            <input :value="total + ' Bs'" type="text" class="mt-1 block w-full rounded border-blue-300 bg-blue-100 text-blue-900" readonly />
          </div>
          <div class="flex justify-end gap-2">
            <Link :href="route('ventas.index')" class="bg-gray-400 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancelar</Link>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Registrar Venta</button>
          </div>
        </form>
        <div v-if="Object.keys(form.errors).length" class="text-red-500 mt-2">
          <div v-for="(msg, key) in form.errors" :key="key">{{ msg }}</div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { onMounted, watch, computed } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
  productos: {
    type: Array,
    default: () => []
  },
  usuarios: {
    type: Array,
    default: () => []
  }
});

const form = useForm({
  cliente_nombre: '',
  usuario_id: '',
  productos: []
});

const addProducto = () => {
  form.productos.push({
    id: '',
    cantidad: 1,
    precio_unitario: 0,
    subtotal: 0
  });
};
const removeProducto = (idx) => {
  form.productos.splice(idx, 1);
};
const updatePrecio = (idx) => {
  const producto = props.productos.find(p => p.id === form.productos[idx].id);
  if (producto) {
    form.productos[idx].precio_unitario = producto.precio;
    updateSubtotal(idx);
  }
};
const updateSubtotal = (idx) => {
  form.productos[idx].subtotal = form.productos[idx].cantidad * form.productos[idx].precio_unitario;
};
const total = computed(() => {
  return form.productos.reduce((sum, item) => sum + item.subtotal, 0);
});
const submitVenta = () => {
  const productosValidos = form.productos.filter(
    item => item.id && item.cantidad > 0
  );
  if (productosValidos.length === 0) {
    alert('Debes agregar al menos un producto válido.');
    return;
  }
  const formData = {
    cliente_nombre: form.cliente_nombre,
    usuario_id: form.usuario_id,
    productos: productosValidos.map(item => ({
      id: item.id,
      cantidad: item.cantidad
    }))
  };
  router.post(route('ventas.store'), formData, {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
    onError: () => {
      alert('Error al registrar la venta');
    }
  });
};

onMounted(() => {
  if (form.productos.length === 0) {
    addProducto();
  }
});

watch(
  () => form.productos.map(item => item.id),
  (newIds, oldIds) => {
    newIds.forEach((id, idx) => {
      if (id && (!oldIds || id !== oldIds[idx])) {
        updatePrecio(idx);
      }
    });
  }
);
</script>