<script setup>
import { departureStore } from "@/stores/flightDeparture.js";
import { RouterLink } from 'vue-router';
import http from '@/services/http.js';
import { ref } from "vue";

const departure = departureStore();

let swap = ref(false)

let airportsDeparture = ref([])
let airportsDestination = ref([])

let selectedDepartureDate = ref('')
let selectedDestinationDate = ref('')

let selectedDepartureSlug = ref(departure.slug)
let selectedDestinationSlug = ref('')

let selectedDepartureAirport = ref(departure.name)
let selectedDestinationAirport = ref('')

async function airportsDepartureList() {
    try {
        const { data } = await http.get('/airports/' + selectedDepartureAirport.value);
        airportsDeparture.value = data.data
    } catch (error) {
        console.log(error?.response?.data)
    }

    if (selectedDepartureAirport.value == '') {
        airportsDeparture.value = [];
    }
}

async function airportsDestinationList() {
    try {
        const { data } = await http.get('/airports/' + selectedDestinationAirport.value);
        airportsDestination.value = data.data
    } catch (error) {
        console.log(error?.response?.data)
    }

    if (selectedDestinationAirport.value == '') {
        airportsDestination.value = [];
    }
}

const selectDeparture = (airport) => {
    selectedDepartureAirport.value = airport.name;
    selectedDepartureSlug.value = airport.slug
    airportsDeparture.value = [];
    departure.setDepartureName(airport.name)
    departure.setDepartureSlug(airport.slug)
};

const selectDestination = (airport) => {
    selectedDestinationAirport.value = airport.name;
    selectedDestinationSlug.value = airport.slug
    airportsDestination.value = [];
};

const switchLocations = (departuree, destination) => {
    swap.value = !swap.value
    selectedDepartureAirport.value = destination
    selectedDestinationAirport.value = departuree

    departure.setDepartureName(selectedDepartureAirport.value)
    departure.setDepartureSlug(selectedDepartureSlug.value)
}
</script>

<template>
    <div class="p-8 border rounded-lg">
        <div>
            <p class="text-2xl font-bold uppercase">Plane Tickets</p>
        </div>

        <div class="flex gap-2 mt-4">
            <div>
                <p>Departure</p>
                <input class="p-2 text-lg border rounded-md w-60" v-model="selectedDepartureAirport"
                    @keyup="airportsDepartureList" placeholder="Pesquisar aeroportos" />
                <ul v-if="selectedDepartureAirport" class="absolute mt-1 bg-white border rounded-md w-60">
                    <li class="w-full px-4 my-3 cursor-pointer" v-for="airport in airportsDeparture" :key="airport.id"
                        @click="selectDeparture(airport)">
                        {{ airport.name }}
                    </li>
                </ul>
            </div>

            <button @click="switchLocations(selectedDepartureAirport, selectedDestinationAirport)"
                :class="{ 'rotate-180': swap }" class="p-2 mt-6 border rounded-full collapse-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                </svg>
            </button>


            <div>
                <p>Destination</p>
                <input class="p-2 text-lg border rounded-md w-60" v-model="selectedDestinationAirport"
                    @keyup="airportsDestinationList" placeholder="Pesquisar aeroportos" />
                <ul v-if="selectedDestinationAirport" class="absolute mt-1 bg-white border rounded-md w-60">
                    <li class="w-full px-4 my-3 cursor-pointer" v-for="airport in airportsDestination" :key="airport.id"
                        @click="selectDestination(airport)">
                        {{ airport.name }}
                    </li>
                </ul>
            </div>

            <div>
                <p>Choose Dates</p>
                <div class="flex gap-1">
                    <input class="w-40 p-2 text-lg border rounded-md" v-model="selectedDepartureDate"
                        placeholder="Departure Date" type="text" onfocus="(this.type='date')" onblur="(this.type='text')">

                    <input class="w-40 p-2 text-lg border rounded-md" v-model="selectedDestinationDate"
                        placeholder="Destination Date" type="text" onfocus="(this.type='date')" onblur="(this.type='text')">

                </div>
            </div>

            <div>
                <p>Passengers</p>
                <select class="p-3 text-lg bg-white border rounded-md">
                    <option selected class="p-4 text-lg bg-white border rounded-md" value="1">1 Passenger</option>
                </select>
            </div>

            <div class="ml-2">
                <RouterLink :to="{ path: 'flights/' + selectedDepartureSlug + '/' + selectedDestinationSlug }">
                    <button class="px-6 py-2 mt-6 text-lg border rounded-lg hover:text-black">Search Flight
                    </button>
                </RouterLink>
            </div>
        </div>
    </div>
</template>

<style scoped>
.collapse-icon {
    transition: 0.2s linear;
}
</style>