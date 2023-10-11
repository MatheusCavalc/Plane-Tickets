<script setup>
import { onMounted, ref } from 'vue';
import MainLayout from '../layouts/MainLayout.vue';
import http from '@/services/http.js';
import { RouterLink, useRoute } from 'vue-router';

const route = useRoute()

let departure = route.params.departure
let destination = route.params.destination

const flights = ref('')

async function flightsHome() {
    //console.log('hey')
    try {
        const { data } = await http.get('/flights/' + departure + '/' + destination);
        //console.log(data)
        flights.value = data.data
    } catch (error) {
        console.log(error?.response?.data)
    }
}

const formatDatetime = (datetime) => {
    const date = new Date(datetime);
    const options = { day: 'numeric', month: 'short', year: 'numeric' };
    return new Intl.DateTimeFormat('en', options).format(date);
};

const getMonthAbbreviation = (datetime) => {
  const date = new Date(datetime);
  return new Intl.DateTimeFormat('en', { month: 'short' }).format(date);
};

onMounted(() => {
    flightsHome()
})
</script>

<template>
    <MainLayout>
        <section class="mx-20 mt-20">
            <div>
                <h1 class="text-2xl font-bold">Nacional Destiny</h1>
                <p class="text-2xl my-2 capitalize">{{ destination }}</p>
            </div>


            <div class="relative overflow-x-auto mt-10">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase dark:text-gray-400 bg-purple-700">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Departure
                            </th>
                            <th scope="col" class="px-6 py-3">

                            </th>
                            <th scope="col" class="px-6 py-3">
                                Destination
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Month
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="flight in flights" :key="flight.id" class="bg-white dark:bg-gray-800">
                            <th scope="row" class="px-6 py-6">
                                {{ flight.departure_airport.name }}
                            </th>
                            <td class="px-6 py-4">
                                ->
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ flight.destination_airport.name }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="uppercase">
                                    {{ getMonthAbbreviation(flight.departure_time) }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                {{ formatDatetime(flight.departure_time) }}
                            </td>
                            <td class="px-6 py-4">
                                <RouterLink :to="{ path: '/flight/details/' + flight.id }" class="py-2 px-8 bg-purple-700 text-white font-bold text-lg rounded-lg">
                                    ${{ flight.ticket_price }}
                                </RouterLink>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </section>
    </MainLayout>
</template>
  