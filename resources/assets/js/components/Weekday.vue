<template>
    <div class="grid-item">
        <div class="weekday-title">
            <div>
                <h3 class="daytitle"> <strong> {{ this.day }} </strong></h3>
                <span class="daydate"> {{ this.date }} </span>
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

