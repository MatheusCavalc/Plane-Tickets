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

            {{ flight }}

            {{ reserve }}


            //A RESERVADA

            //OUTRAS OPCOES
        </template>

    </MainLayout>
</template>