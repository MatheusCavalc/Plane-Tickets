import { defineStore } from 'pinia'
import { ref } from 'vue'

export const departureStore = defineStore('departure', () => {
    const name = ref(localStorage.getItem('nameDeparture'))
    const slug = ref(localStorage.getItem('slugDeparture'))

    function setDepartureName(nameValue) {
        localStorage.setItem('nameDeparture', nameValue);
        name.value = nameValue;
    }

    function setDepartureSlug(slugValue) {
        localStorage.setItem('slugDeparture', slugValue);
        slug.value = slugValue;
    }

    return {
        name,
        slug,
        setDepartureName,
        setDepartureSlug
    }
})