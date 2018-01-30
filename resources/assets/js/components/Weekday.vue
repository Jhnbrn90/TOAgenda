<template>
    <div class="grid-item">
        <div class="weekday-title">
            <div v-if="this.today == 1">
                <h3> <strong> {{ this.day }} </strong></h3>
                <strong> {{ this.date }} </strong>
            </div>

            <div v-else>
                <h3> {{ this.day }} </h3>
                {{ this.date }}
            </div>

        </div>

        <slot></slot>
        
    </div>  
</template>

<script>

export default {

    props: ['day', 'date', 'today'],

}
</script>

