<script setup>
import { onMounted, ref } from 'vue';
import MainLayout from '../layouts/MainLayout.vue';
import http from '@/services/http.js';
import { RouterLink } from 'vue-router';

const flights = ref('')

async function flightsHome() {
    console.log('hey')
    try {
        const { data } = await http.get('/home');
        console.log(data)
        flights.value = data.data
    } catch (error) {
        console.log(error?.response?.data)
    }
}

onMounted(() => {
    flightsHome()
})
</script>

<template>
    <MainLayout>
        <section class="mx-20 mt-20">
            <div>
                <h1 class="text-2xl font-bold">VOOS COM ATÉ 50% DE DESCONTO</h1>
                <p class="my-2">Saida: Fortaleza</p>
            </div>

            <div class="flex gap-4 mt-7">

                <RouterLink :to="{ path: 'flights/' + flight.departure_airport.slug + '/' + flight.destination_airport.slug }" v-for="flight in flights" :key="flight.id"
                    class="max-w-md w-80 rounded-lg text-white bg-cover bg-no-repeat group transition ease-in-out delay-100 hover:-translate-y-1 hover:scale-105 duration-200"
                    style="background-image: url('https://photo620x400.mnstatic.com/087dfd415e06b0651f4528fea6642818/rio-de-janeiro.jpg');">

                    <div class="flex justify-center mt-12">
                        <p class="font-bold text-2xl">{{ flight.destination_airport.name }}</p>
                    </div>

                    <p class="text-center mt-4">A PARTIR DE</p>
                    <p class="text-center text-3xl font-extrabold"><span class="text-xl mr-1 font-bold">R$</span>{{
                        flight.ticket_price }}</p>

                    <div class="flex justify-center mt-6 mb-16">
                        <button
                            class="px-20 py-2 border border-white rounded-full group-hover:bg-white group-hover:text-black transition ease-in-out delay-100 group-hover:-translate-y-1 group-hover:scale-105 duration-200">Look
                            More</button>
                    </div>

                </RouterLink>
                
            </div>

        </section>
    </MainLayout>
</template>
  