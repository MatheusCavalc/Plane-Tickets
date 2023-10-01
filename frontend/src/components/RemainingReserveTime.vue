<template>
    <div>
        <p>{{ minutesRemaining }}:{{ secondsRemaining }}</p>
    </div>
</template>
  
<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const props = defineProps(['expirationHour'])

const expirationHour = props.expirationHour;
let intervalId;
const minutesRemaining = ref('')
const secondsRemaining = ref('')

function calculateRemainingTime() {
    const now = new Date();
    const expiration = new Date(expirationHour);
    const differenceSeconds = Math.floor((expiration - now) / 1000);

    const minutes = Math.floor(differenceSeconds / 60);
    const seconds = differenceSeconds % 60;

    minutesRemaining.value = minutes >= 0 ? minutes : 0;
    secondsRemaining.value = seconds >= 0 ? seconds : 0;
}

onMounted(() => {
    intervalId = setInterval(() => {
        calculateRemainingTime();
    }, 1000);
});

onUnmounted(() => {
    clearInterval(intervalId);
});
</script>