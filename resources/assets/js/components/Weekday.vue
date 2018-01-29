<template>
    <div class="grid-item">
        <div class="weekday-title">
            <h3> {{ this.day }} </h3>
            {{ this.date }}
        </div>

        <slot></slot>
        
    </div>  
</template>

<script>

export default {

    props: ['day', 'date'],
  
}
</script>

