<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import BarChart from '@/components/BarChart.vue';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

defineProps(['productosVendidos', 'clientes', 'ventasPorMesLabels', 'ventasPorMesData'])
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-6 bg-[#eaf6fb]">
            <div class="grid auto-rows-min gap-6 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border-2 border-[#00b6e3] bg-white shadow-lg flex flex-col items-center justify-center">
                    <img src="https://img.icons8.com/fluency/48/000000/shopping-cart-loaded.png" alt="Productos" class="mb-2 w-12 h-12" />
                    <h3 class="text-xl font-bold text-[#009edb]">PRODUCTOS VENDIDOS</h3>
                    <p class="text-lg text-[#007bb8] font-semibold">Cantidad: {{ productosVendidos }}</p>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border-2 border-[#00b6e3] bg-white shadow-lg flex flex-col items-center justify-center">
                    <img src="https://img.icons8.com/fluency/48/000000/group-foreground-selected.png" alt="Clientes" class="mb-2 w-12 h-12" />
                    <h3 class="text-xl font-bold text-[#009edb]">CLIENTES</h3>
                    <p class="text-lg text-[#007bb8] font-semibold">Cantidad: {{ clientes }}</p>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border-2 border-[#00b6e3] bg-white shadow-lg flex flex-col items-center justify-center">
                    <img src="https://img.icons8.com/fluency/48/000000/graph.png" alt="Gráfico" class="mb-2 w-12 h-12" />
                    <h3 class="text-xl font-bold text-[#009edb]">ESTADÍSTICAS</h3>
                </div>
            </div>
            <div class="relative flex-1 rounded-xl border-2 border-[#00b6e3] bg-white shadow-lg md:min-h-min p-6 mt-4">
                <h3 class="mb-4 text-lg font-semibold text-[#009edb] flex items-center gap-2">
                    <img src="https://img.icons8.com/fluency/32/000000/combo-chart.png" alt="Ventas" class="inline w-8 h-8" />
                    Ventas por Mes
                </h3>
                <div class="w-full flex justify-center">
                    <BarChart
                      :labels="ventasPorMesLabels"
                      :values="ventasPorMesData"
                      label="Ventas"
                      :height="220"
                      :width="900"
                      color="#00b6e3"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>