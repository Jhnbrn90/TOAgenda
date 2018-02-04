<template>
<div>
    <div v-for="appointment in appointments">
        {{ appointment }}
    </div>
</div>
</template>

<script>
    export default {

        props: ['appointments'],

        data() {
            return {

            }
        }
    }
</script>
