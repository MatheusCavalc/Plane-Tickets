<script setup>
import MainLayout from '../layouts/MainLayout.vue';
import { useRoute } from 'vue-router';
import http from '@/services/http.js';
import { onMounted, ref } from 'vue';
import router from '../router';
import RemainingReserveTime from '../components/RemainingReserveTime.vue';

const route = useRoute()

let flight_id = route.params.id
let flight = ref('')
let showPage = ref(false)
let reserve = ref('')

async function flightDetails() {
    try {
        const { data } = await http.get('/flight/details/' + flight_id);
        console.log(data)
        flight.value = data.data
    } catch (error) {
        console.log(error?.response?.data)
    }

    flightReserve()
}

async function flightReserve() {
    try {
        const { data } = await http.post('/flight/reserve', { flight_id: flight.value.id });
        if (data.message = 'Reserve Created') {
            reserve.value = data.data
            showPage.value = true
            //show page
        } else if (data.message = 'No Available Tickets') {
            router.push({ path: '/flights/' + flight.value.departure_airport.slug + '/' + flight.value.destination_airport.slug })
        }
    } catch (error) {
        console.log(error?.response?.data)
    }
}

onMounted(() => {
    flightDetails()
})
</script>

<template>
    <MainLayout>
        <template v-if="!showPage">
            Loading
        </template>

        <template v-else>

            <RemainingReserveTime :expirationHour="reserve.expiration" />

            <div class="mx-20 grid grid-cols-3 gap-2">
                <div class="col-span-2">
                    <p>{{ flight.company.name }}</p>

                    <div class="flex gap-3">
                        <p>{{ flight.departure_airport.name }}</p>
                        <p>-></p>
                        <p>{{ flight.destination_airport.name }}</p>
                    </div>

                    <div class="flex gap-3">
                        <p>{{ flight.departure_time }}</p>
                        <p>-></p>
                        <p>{{ flight.arrival_time }}</p>
                    </div>
                </div>

                <div>
                    <div
                        class="py-12 sm:py-12 md:py-6 lg:py-6 xl:py-6 px-8 w-full sm:w-full bg-purple-500 shadow-none sm:shadow-none md:shadow-xl lg:shadow-xl xl:shadow-xl">
                        <div class="text-center py-4 px-7">
                            <h1 class="text-white text-4xl font-black">${{ flight.ticket_price }}</h1>
                            <p class="text-white text-opacity-50 mt-2">For adults, without taxs</p>
                        </div>

                        <div class="flex justify-between mt-2 text-white">
                            <p>1 Adult</p>
                            <p>${{ flight.ticket_price }}</p>
                        </div>
                        <div class="flex justify-between mt-2 text-white">
                            <p>Embark</p>
                            <p>$0.00</p>
                        </div>
                        <div class="flex justify-between my-2 text-white">
                            <p>Services</p>
                            <p>$0.00</p>
                        </div>

                        <div class="h-px bg-purple-400"></div>

                        <div class="flex justify-between mt-2 text-black font-bold text-lg">
                            <p>Total</p>
                            <p>${{ flight.ticket_price }}</p>
                        </div>
                        <button
                            class="w-full mt-6 mb-3 py-2 text-white font-semibold bg-purple-400 hover:shadow-xl duration-200 hover:bg-purple-800">Buy
                            Now</button>
                    </div>

                </div>
            </div>

            //A RESERVADA

            //OUTRAS OPCOES
        </template>

    </MainLayout>
</template>